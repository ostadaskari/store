<?php

namespace Database\Seeders;

use App\Models\Shipping;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shipping::updateOrCreate(['slug'=>'post'], [
            'name'=>'ارسال با پست',
            'price'=>70000,
            'delivery_time'=>'3-7 روز کاری',
            'status'=>true,
            'sort_order'=>10
        ]);

        Shipping::updateOrCreate(['slug'=>'tipax'], [
            'name'=>'ارسال با تیپاکس',
            'price'=>100000,
            'delivery_time'=>'2-5 روز کاری',
            'status'=>true,
            'sort_order'=>20
        ]);

        Shipping::updateOrCreate(['slug'=>'local-shiraz'], [
            'name'=>'ارسال با پیک در شهر شیراز',
            'price'=>60000,
            'delivery_time'=>'1 روز کاری (شیراز)',
            'status'=>true,
            'sort_order'=>30
        ]);
    }
}
