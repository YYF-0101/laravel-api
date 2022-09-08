<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'product_image' => 'mimes:png,jpg,jpeg'
        ]);

        if($request->has('product_image')){
        $imageName = time().'.'.$request->product_image->extension();

        $image_path = $request -> file('product_image') -> store('product_images','public');

        return Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'product_image' => $image_path,
        ]);
    }else{
        return Product::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product->product_image != ''  && $product->product_image != null&&$request->product_image){
            Storage::disk('public')->delete($product->product_image);
            $imageName = time().'.'.$request->product_image->extension();

        $image_path = $request -> file('product_image') -> store('product_images','public');

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'product_image' => $image_path,
        ]);
        }elseif ($request->product_image != '') {
            $imageName = time().'.'.$request->product_image->extension();

            $image_path = $request -> file('product_image') -> store('product_images','public');
    
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
                'product_image' => $image_path,
            ]);
        }else{
            $product->update([
                'title' => $request->title,
                'description' => $request->description,
                'price' => $request->price,
            ]);
        }
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Product::destroy($id);
        return $request;
    }

}
