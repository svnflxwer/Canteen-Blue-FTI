<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Product;
use App\Models\StatusOrder;
use App\Models\SubCategory;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethodHeader;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Product::factory(50)->create();
        Role::create([
            'role_name' => 'Member',
        ]);

        Role::create([
            'role_name' => 'Admin',
        ]);

        StatusOrder::create([
            'status_name' => 'On Cart',
            'type' => 'primary',
        ]);

        StatusOrder::create([
            'status_name' => 'Unpaid',
            'type' => 'warning',
        ]);

        StatusOrder::create([
            'status_name' => 'Waiting Confirmation',
            'type' => 'info',
        ]);

        StatusOrder::create([
            'status_name' => 'On Progress',
            'type' => 'info',
        ]);

        StatusOrder::create([
            'status_name' => 'Success',
            'type' => 'success',
        ]);

        StatusOrder::create([
            'status_name' => 'Canceled',
            'type' => 'danger',
        ]);

        User::create([
            'name' => 'User Yulius',
            'username' => 'yuliusius',
            'email' => 'yiyus49@gmail.com',
            'password' => bcrypt('1234'),
            'photo' => 'profile/default.jpg',
            'no_hp' => '089501784227',
            'role_id' => 1,
            'is_active' => 1,
        ]);

        User::create([
            'name' => 'Admin Yulius',
            'username' => 'yuliusius1',
            'email' => 'yiyus58@gmail.com',
            'password' => bcrypt('1234'),
            'photo' => 'profile/default.jpg',
            'no_hp' => '0895017842272',
            'role_id' => 2,
            'is_active' => 1,
        ]);

        SubCategory::create([
            'category_id' => 2,
            'sub_category_name' => 'Minuman',
            'slug' => 'minuman',
            'is_active' => 1,
        ]);

        SubCategory::create([
            'category_id' => 1,
            'sub_category_name' => 'Makanan',
            'slug' => 'makanan',
            'is_active' => 1,
        ]);

        SubCategory::create([
            'category_id' => 1,
            'sub_category_name' => 'Cemilan',
            'slug' => 'cemilan',
            'is_active' => 1,
        ]);

        PaymentMethodHeader::create([
            'name' => 'Bank Transfer',
            'is_active' => 1,
        ]);

        PaymentMethodHeader::create([
            'name' => 'E-Wallet',
            'is_active' => 1,
        ]);

        PaymentMethodHeader::create([
            'name' => 'Pulsa Transfer',
            'is_active' => 1,
        ]);

        PaymentMethodHeader::create([
            'name' => 'Other',
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '1',
            'name' => 'BCA (Bank Central Asia)',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '0980141208',
            'fee' => 0,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '1',
            'name' => 'BRI (Bank Rakyat Indonesia)',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '67201919247213',
            'fee' => 0,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '2',
            'name' => 'OVO',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '089501784227',
            'fee' => 1000,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '2',
            'name' => 'Gopay',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '089501784227',
            'fee' => 1000,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '2',
            'name' => 'DANA',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '089501784227',
            'fee' => 1000,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '3',
            'name' => 'Telkomsel',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '082329672134',
            'fee' => 0,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '3',
            'name' => '3',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '089501784227',
            'fee' => 0,
            'is_active' => 1,
        ]);

        PaymentMethod::create([
            'payment_method_header_id' => '4',
            'name' => 'COD (Cash on delivery)',
            'holder_name' => 'Admin BlueCanTeen',
            'holder_number' => '-',
            'fee' => 0,
            'is_active' => 1,
        ]);
    }
}