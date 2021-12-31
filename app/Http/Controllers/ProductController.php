<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
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
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        return view('products.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $data = $request->all();
        if ($request->has('image')) {
            $image_path = $request->file('image')->store('medias');
            $data['featured_image_url'] = $image_path;
        }
        Product::create($data);
        return redirect()->route('products.index')->with(['status' => 'Success', 'color' => 'green', 'message' => 'Producto creado satisfactoriamente']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.create', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        if ($request->has('image')) {
            Storage::get($product->featured_image_url);
            $image_path = $request->file('image')->store('medias');
            $data['featured_image_url'] = $image_path;
        }
        $product->fill($data);
        $product->save();
        return redirect()->route('products.index')->with(['status' => 'Success', 'color' => 'blue', 'message' => 'Producto actualizado satisfactoriamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            $result = ['status' => 'Success', 'color' => 'red', 'message' => 'Producto eliminado satisfactoriamente'];
        } catch (\Exception $e) {
            $result = ['status' => 'Success', 'color' => 'red', 'message' => 'El producto no puede ser eliminado'];
        }
        return redirect()->route('products.index')->with($result);
    }
}
