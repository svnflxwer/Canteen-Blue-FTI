<?php

namespace App\Http\Controllers;

use Alert;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentHistory;
use App\Models\PaymentMethodHeader;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class OrderController extends Controller
{
    public function index(Request $request,$id){
        $product = Product::firstWhere('id',$id);
        $cek_pesanan = Order::where('user_id', Auth::user()->id)->where('status_order_id',1)->first();
        if(!empty($cek_pesanan)){
            $cek_order_detail = OrderDetail::where('product_id',$product->id)->where('order_id',$cek_pesanan->id)->first();
            if($cek_order_detail ){
                if($request->quantity + $cek_order_detail->quantity  > $product->stock){
                    alert()->error( 'Stock Kurang','Pesanan Gagal');
                    return back();
                }
            } else {
                if($request->quantity > $product->stock){
                    alert()->error( 'Stock Kurang','Pesanan Gagal');
                    return back();
                }
            }
        } 

        if(empty($cek_pesanan)) {
            $order = new Order;
            $order->invoice_id = mt_rand(000000,999999);
            $order->user_id = Auth::user()->id;
            $order->status_order_id = 1;
            $order->total_harga = $product->price * $request->quantity;
            $order->save();
        }

        $order_baru = Order::where('user_id', Auth::user()->id)->where('status_order_id',1)->first();
        $cek_orderDetail = OrderDetail::where('product_id',$product->id)->where('order_id',$order_baru->id)->first();

        if(empty($cek_orderDetail)){
            $order_detail = new OrderDetail;
            $order_detail->product_id = $product->id;
            $order_detail->order_id = $order_baru->id;
            $order_detail->quantity = $request->quantity;
            $order_detail->description = $request->keterangan;
            $order_detail->total_harga = $product->price * $request->quantity;
            $order_detail->save();
        } else {
            $cek_orderDetail->quantity += $request->quantity;
            $cek_orderDetail->total_harga += $product->price * $request->quantity;
            $cek_orderDetail->save();
        }

        if(!empty($cek_pesanan)){
            $order_baru->total_harga += $product->price * $request->quantity;
            $order_baru->save();
        }
        
        // alert()->success($product->name . ' berhasil dimasukkan kedalam keranjang','Pesanan Berhasil' )->persistent('Close');
        alert()->success($product->name . ' berhasil dimasukkan kedalam keranjang <br> <a href="/cart" class="btn btn-primary my-4">Lihat Halaman Keranjang</a>','Pesanan Berhasil' )->html();
        return back();
    }

    public function deleteCart(Request $request){
        $pesanan = Order::where('user_id',Auth::user()->id)->where('status_order_id',1)->first();
        if(empty($pesanan)){
            alert()->error('Pesanan Tidak ada !','Pesanan Error' );
            return  back();
        }
        $pesanan_delete = OrderDetail::where('order_id',$pesanan->id)->where('id',$request->userId)->first();
        if(empty($pesanan_delete)){
            alert()->error('Pesanan Tidak ada !','Pesanan Error' );
            return  back();
        }
        //Kurangi Jumlah Harga
        $pesanan->total_harga -= $pesanan_delete->total_harga;
        $pesanan->update();
        $pesanan_delete->delete();

        $pesanan_all = OrderDetail::where('order_id',$pesanan->id)->first();
        if(empty($pesanan_all)){
            $pesanan->delete();
            alert()->success($pesanan_delete->product->name . ' berhasil dihapus dari keranjang','Pesanan Berhasil Dihapus' );
            return redirect('/product');
        }
        
        alert()->success($pesanan_delete->product->name . ' berhasil dihapus dari keranjang','Pesanan Berhasil Dihapus' );
        return back();
    }

    public function cart(){
        $pesanan = Order::where('user_id',Auth::user()->id)->where('status_order_id',1)->first();
        if(empty($pesanan)){
            alert()->error('Cart Kosong','Gagal Memuat' );
            return back();
        }

        $pesanan_detail = OrderDetail::where('order_id', $pesanan->id)->get();
        if(empty($pesanan_detail)){
            alert()->error('Cart Kosong','Gagal Memuat' );
            return back();
        }

        return view('product.cart', [
            'title' => 'Cart',
            'active' =>'cart',
            'order' => $pesanan,
            'order_detail' => $pesanan_detail,
        ]);
    }

    public function editCart(Request $request,$id){
        $order_detail = OrderDetail::where('id', $id)->first();
        if(empty($order_detail)){
            alert()->error('Produk tidak ditemukan','Gagal Memuat' );
            return back();
        }
        $product = Product::where('id',$order_detail->product_id)->first();
        $order = Order::where('id', $order_detail->order_id)->where('user_id',Auth::user()->id)->where('status_order_id',1)->first();
        if(empty($order)){
            alert()->error('Produk tidak ditemukan','Gagal Memuat' );
            return back();
        }

        $order->total_harga -= $order_detail->total_harga;
        $order->update();
        $order->total_harga += $request->quantity * $product->price;

        $order_detail->quantity = $request->quantity;
        $order_detail->description = $request->keterangan;
        $order_detail->total_harga = $request->quantity * $product->price;
        $order_detail->update();
        $order->update();

        alert()->success('Produk Berhasil Diubah','Berhasil' );
        return back();
    }

    public function index_checkout(){
        $pesanan = Order::where('user_id',Auth::user()->id)->where('status_order_id',1)->first();
        if(empty($pesanan)){
            alert()->error('Cart Kosong','Gagal Memuat' );
            return back();
        }

        $pesanan_detail = OrderDetail::where('order_id', $pesanan->id)->get();
        if(empty($pesanan_detail)){
            alert()->error('Cart Kosong','Gagal Memuat' );
            return back();
        }

        return view('product.checkout', [
            'title' => 'Checkout',
            'active' =>'checkout',
            'payment_header' => PaymentMethodHeader::all(),
            'order' => $pesanan,
            'order_detail' => $pesanan_detail,
        ]);
    }

    public function method_id(Request $request){
        $methods = PaymentMethod::where('payment_method_header_id',$request->cat_id)->where('is_active',1)->get();
        return Response::json($methods);
    }

    public function getfees(Request $request){
        $methods = PaymentMethod::where('id',$request->cat_id)->get();
        return Response::json($methods);
    }

    public function checkout(Request $request){
        $order = Order::where('user_id',Auth::user()->id)->where('status_order_id',1)->first();
        if(empty($order)){
            alert()->error('Cart Kosong','Gagal Memuat' );
            return back();
        }

        $order_detail = OrderDetail::where('order_id',$order->id)->get();
        if(empty($order_detail)){
            alert()->error('Cart Kosong','Gagal Memuat' );
            return back();
        }

        $method = PaymentMethod::where('id',$request->method)->where('is_active',1)->first();
        if(empty($method)){
            alert()->error('Metode Pembayaran tidak ada atau sedang tidak aktif','Gagal Memuat' );
            return back();
        }

        $payment_history = new PaymentHistory;
        $payment_history->user_id = Auth::user()->id;
        $payment_history->order_id = $order->id;
        $payment_history->payment_method_id = $method->id;
        $payment_history->total_harga = $order->total_harga + $method->fee;
        $payment_history->holder_name = $request->name;
        $payment_history->holder_number = $request->numb;
        $payment_history->save();

        $order->status_order_id = 2;
        $order->update();
        alert()->success('Berhasil di tambahkan','Berhasil Order' );
        return redirect('/user/transaction');
    }

    public function invoice(Request $request,$id){
        $order = Order::where('invoice_id',$id)->first();
        if(empty($order)){
            alert()->error('Tidak ada barang','Gagal Memuat' );
            return back();
        }

        $payment = PaymentHistory::where('order_id',$order->id)->first();
        if(empty($payment)){
            alert()->error('Pesanan tidak ada','Gagal Memuat' );
            return back();
        }

        $paymentmethod = PaymentMethod::where('id', $payment->payment_method_id)->first();
        $order_detail = OrderDetail::where('order_id', $order->id)->get();
        return view('invoice_detail', [
            'title' => 'Invoice',
            'active' =>'invoice',
            'order' => $order,
            'order_detail' => $order_detail,
            'payment' => $payment,
            'payment_method' => $paymentmethod,
        ]);
    }
}