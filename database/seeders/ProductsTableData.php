<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => Str::random(4),
            'description' => Str::random(10),
            'price' => random_int(10,99),
            'product_image' => 'product_images/exZ9YVeUunzgryRnsAAwA4C5ogFxNJbM2DUuFQ0C.png'
        ]);

        Product::create([
            'title' => Str::random(4),
            'description' => Str::random(10),
            'price' => random_int(10,99),
            'product_image' => 'product_images/OdX6TLNQPtfyM33TgEfW2WxFnMwAGGw8JxyhiGZc.jpg'
        ]);
        
        for ($i=0; $i < 6; $i++) { 
	    	Product::create([
	            'title' => Str::random(4),
	            'description' => Str::random(10),
	            'price' => random_int(100,999)
	        ]);
    	}
    }
}
