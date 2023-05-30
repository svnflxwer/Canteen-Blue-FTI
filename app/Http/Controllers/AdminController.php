<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\PaymentHistory;
use Illuminate\Validation\Rule;
use App\Models\PaymentMethodHeader;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(){
        $payment_history = PaymentHistory::all();
        return view('admin.index', [
            'title' => 'Edit Profile',
            'active' =>'user',
            'payment' => $payment_history,
        ]);
    }

    public function active_order(){
        $order = Order::where('status_order_id',4)->get();
        return view('admin.active_order', [
            'title' => 'Active Order',
            'active' =>'user',
            'order' => $order,
        ]);
    }

    public function transaction(){
        $payment_history = PaymentHistory::all();
        return view('admin.transaction_management', [
            'title' => 'Edit Profile',
            'active' =>'user',
            'payment' => $payment_history,
        ]);
    }

    public function cancel_order(Request $request){
        $order = order::where('id',$request->userId)->first();
        $order->status_order_id = 6;
        $order->update();
        alert()->success($order->invoice_id . ' berhasil dibatalkan','Pembatalan transaksi Berhasil' );
    }

    public function confirm_order(Request $request){
        $order = order::where('id',$request->userId)->first();
        $order->status_order_id = 4;
        $order->update();
        alert()->success($order->invoice_id . ' berhasil dikonfirmasi','Konfirmasi transaksi Berhasil' );
    }

    public function finish_order(Request $request){
        $order = order::where('id',$request->userId)->first();
        $order->status_order_id = 5;
        $order->update();
        alert()->success($order->invoice_id . ' berhasil selesai','transaksi Berhasil' );
    }

    public function payment(){
        $payment_method = PaymentMethod::all();
        $payment_header = PaymentMethodHeader::all();
        return view('admin.payment_management', [
            'title' => '',
            'active' =>'user',
            'payment' => $payment_method,
            'payment_header' => $payment_header,
        ]);
    }

    public function addpayment(Request $request){
        $validatedData = $request->validate([
            'payment_header' => 'required',
            'name' => ['required','unique:payment_methods'],
            'holder_name' => ['required','max:255'],
            'holder_number' => ['required','max:255'],
            'fee' => ['required'],
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => $request->payment_header,
            'name' => $request->name,
            'holder_name' => $request->holder_name,
            'holder_number' => $request->holder_number,
            'fee' => $request->fee,
            'is_active' => 1,
        ]);
        alert()->success($request->name . ' berhasil ditambahkan','Penambahan Payment Method Berhasil' );
        return back();
    }

    public function edit_payment(Request $request){
        $payment = PaymentMethod::where('id', $request->pay_id)->first();
        if(empty($payment)){
            alert()->error($request->name . ' Gagal Diubah','Pengubahan Payment Method Gagal' );
            return back();
        }
        $validatedData = $request->validate([
            'payment_header' => 'required',
            'name' => ['required',Rule::unique('payment_methods')->ignore($payment)],
            'holder_name' => ['required','max:255'],
            'holder_number' => ['required','max:255'],
            'fee' => ['required'],
        ]);
        $payment->payment_method_header_id = $request->payment_header;
        $payment->name = $request->name;
        $payment->holder_name = $request->holder_name;
        $payment->holder_number = $request->holder_number;
        $payment->fee = $request->fee;
        $payment->update();
        alert()->success($request->name . ' berhasil diubah','Perubahan Payment Method Berhasil' );
        return back();
    }

    public function check_payment(Request $request){
        $payment = PaymentMethod::where('id',$request->userId)->first();
        if($payment->is_active == 1){
            $payment->is_active = 0;
        } else {
            $payment->is_active = 1;
        }
        $payment->update();
        alert()->success($payment->name . ' berhasil diubah','Perubahan Payment Method Berhasil' );
    }

    public function category(){
        $category = Category::all();
        return view('admin.category_management', [
            'title' => '',
            'active' =>'user',
            'categories' => $category,
        ]);
    }

    public function addcategory(Request $request){
        $validatedData = $request->validate([
            'category_name' => ['required','unique:categories'],
        ]);

        Category::create([
            'category_name' => $request->category_name,
            'is_active' => 1,
        ]);
        alert()->success($request->category_name . ' berhasil ditambahkan','Penambahan Category Berhasil' );
        return back();
    }

    public function edit_category(Request $request){
        $category = Category::where('id', $request->cat_id)->first();
        if(empty($category)){
            alert()->error($request->category_name . ' Gagal Diubah','Pengubahan Category Gagal' );
            return back();
        }
        $validatedData = $request->validate([
            'category_name' => ['required',Rule::unique('categories')->ignore($category)],
        ]);
        
        $category->category_name = $request->category_name;
        $category->update();
        alert()->success($request->category_name . ' berhasil diubah','Perubahan Category Berhasil' );
        return back();
    }

    public function check_category(Request $request){
        $category = Category::where('id',$request->userId)->first();
        if($category->is_active == 1){
            $category->is_active = 0;
        } else {
            $category->is_active = 1;
        }
        $category->update();
        alert()->success($category->category_name . ' berhasil diubah','Perubahan Category Berhasil' );
    }

    public function delete_category(Request $request){
        $category = Category::where('id',$request->userId)->first();
        $category->delete();
        alert()->success($category->category_name . ' berhasil dihapus','Penghapusan Category Berhasil' );
    }

    public function subcategory(){
        $categories = Category::all();
        $subcategory = SubCategory::all();
        return view('admin.subcategory_management', [
            'title' => '',
            'active' =>'user',
            'subcategories' => $subcategory,
            'categories' => $categories,
        ]);
    }

    public function addsubcategory(Request $request){
        $validatedData = $request->validate([
            'category_id' => ['required'],
            'sub_category_name' => ['required','unique:sub_categories','max:255','min:6'],
            'slug' => ['required','max:255'],
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name,
            'slug' => $request->slug,
            'is_active' => 1,
        ]);
        alert()->success($request->name . ' berhasil ditambahkan','Penambahan Sub Category Berhasil' );
        return back();
    }

    public function edit_subcategory(Request $request){
        $subcategory = subcategory::where('id', $request->sc_id)->first();
        if(empty($subcategory)){
            alert()->error($request->sub_category_name . ' Gagal Diubah','Pengubahan Sub Category Gagal' );
            return back();
        }
        $validatedData = $request->validate([
            'category_id' => ['required'],
            'sub_category_name' => ['required',Rule::unique('sub_categories')->ignore($subcategory)],
            'slug' => ['required'],
        ]);
        
        $subcategory->category_id = $request->category_id;
        $subcategory->sub_category_name = $request->sub_category_name;
        $subcategory->slug = $request->slug;
        $subcategory->update();
        alert()->success($request->sub_category_name . ' berhasil diubah','Perubahan Sub Category Berhasil' );
        return back();
    }

    public function check_subcategory(Request $request){
        $subcategory = SubCategory::where('id',$request->userId)->first();
        if($subcategory->is_active == 1){
            $subcategory->is_active = 0;
        } else {
            $subcategory->is_active = 1;
        }
        $subcategory->update();
        alert()->success($subcategory->sub_category_name . ' berhasil diubah','Perubahan Sub Category Berhasil' );
    }

    public function delete_subcategory(Request $request){
        $subcategory = subcategory::where('id',$request->userId)->first();
        $subcategory->delete();
        alert()->success($subcategory->sub_category_name . ' berhasil dihapus','Penghapusan SubCategory Berhasil' );
    }

    public function product(){
        $products = Product::orderBy('created_at','DESC')->get();
        $categories = Category::all();
        return view('admin.product_management', [
            'title' => '',
            'active' =>'user',
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function addproduct(Request $request){
        $validatedData = $request->validate([
            'sub_category_id' => ['required'],
            'name' => ['required','unique:products','max:255','min:6'],
            'description' => ['required'],
            'slug' => ['required'],
            'price' => ['required'],
            'stock' => ['required'],
            'image' => 'required|image|file|max:4096',
        ]);
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('product');
        }

        Product::create([
            'sub_category_id' => $request->sub_category_id,
            'name' => $request->name,
            'description' => $request->description,
            'slug' => $request->slug,
            'price' => $request->price,
            'stock' => $request->stock,
            'photo' => $validatedData['image'],
            'is_active' => 1,
        ]);
        alert()->success($request->name . ' berhasil ditambahkan','Penambahan Product Berhasil' );
        return back();
    }

    public function edit_product(Request $request){
        $product = product::where('id', $request->prod_id)->first();
        if(empty($product)){
            alert()->error($request->name . ' Gagal Diubah','Pengubahan Product Gagal' );
            return back();
        }
        $validatedData = $request->validate([
            'sub_category_id' => ['required'],
            'name' => ['required','max:255','min:6',Rule::unique('products')->ignore($product)],
            'description' => ['required'],
            'slug' => ['required',Rule::unique('products')->ignore($product)],
            'price' => ['required'],
            'stock' => ['required'],
            'image' => 'image|file|max:4096',
        ]);
        if($request->file('image')){
            $imgs = $product->photo;
            $product->photo = $request->file('image')->store('product');
            if(strcmp($imgs,"product/default.jpg") != 0){
                unlink("storage/".$imgs);
            }
        }
        $product->name = $request->name;
        $product->sub_category_id = $request->sub_category_id;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->update();
        alert()->success($request->name . ' berhasil diubah','Perubahan Product Berhasil' );
        return back();
    }

    public function check_product(Request $request){
        $product = product::where('id',$request->userId)->first();
        if($product->is_active == 1){
            $product->is_active = 0;
        } else {
            $product->is_active = 1;
        }
        $product->update();
        alert()->success($product->name . ' berhasil diubah','Perubahan Product Berhasil' );
    }

    public function delete_product(Request $request){
        $product = product::where('id',$request->userId)->first();
        $product->delete();
        alert()->success($product->name . ' berhasil dihapus','Penghapusan product Berhasil' );
    }

    public function user(){
        $user = User::orderBy('created_at','DESC')->get();
        $role = Role::all();
        return view('admin.user_management', [
            'title' => '',
            'active' =>'user',
            'users' => $user,
            'role' => $role,
        ]);
    }

    public function adduser(Request $request){
        $validatedData = $request->validate([
            'name' => ['required','max:255','min:6'],
            'username' => ['required','unique:users'],
            'email' => ['required','unique:users'],
            'role_id' => ['required'],
            'password' => ['required','min:4'],
            'no_hp' => 'required|min:10|max:13',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['is_active'] = 1;
        $validatedData['photo'] = 'profile/default.jpg';
        User::create($validatedData);
        alert()->success($request->name . ' berhasil ditambahkan','Penambahan User Berhasil' );
        return back();
    }

    public function edit_user(Request $request){
        $user = user::where('id', $request->user_id)->first();
        if(empty($user)){
            alert()->error($request->name . ' Gagal Diubah','Pengubahan User Gagal' );
            return back();
        }
        $validatedData = $request->validate([
            'name' => ['required','max:255','min:6',Rule::unique('users')->ignore($user)],
            'role_id' => ['required'],
        ]);
        
        $user->name = $request->name;
        $user->role_id = $request->role_id;
        $user->update();
        alert()->success($request->name . ' berhasil diubah','Perubahan user Berhasil' );
        return back();
    }

    public function check_user(Request $request){
        $user = User::where('id',$request->userId)->first();
        if($user->is_active == 1){
            $user->is_active = 0;
        } else {
            $user->is_active = 1;
        }
        $user->update();
        alert()->success($user->name . ' berhasil diubah','Perubahan User Berhasil' );
    }

    public function delete_user(Request $request){
        $user = User::where('id',$request->userId)->first();
        
        $user->delete();
        alert()->success($user->name . ' berhasil dihapus','Penghapusan User Berhasil' );
    }

    public function subcat(Request $request){
        $sub_categories = SubCategory::where('category_id',$request->cat_id)->get();
        return Response::json($sub_categories);
    }
}