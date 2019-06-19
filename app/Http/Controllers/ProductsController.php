<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Http\Requests\StoreProductRequest;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        //dd($products->toArray());
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        return view('products.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // Handle File Upload
        $filenameToStore = '';
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('image')->move(public_path('product_images'), $filenameToStore);
        }

        // Create Product
        //Product::create($request->all());
        $product = new Product;
        $product->categoryId = $request->input('categoryId');
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->image = $filenameToStore;
        $product->save();

        return redirect()->route('products.index')->with(['message' => 'Product added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::All();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'))->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        // Create Product
        $product = Product::findOrFail($id);
        
        // Handle File Upload
        if($request->hasFile('image')){
            if(\File::exists(public_path('product_images/'.$product->image))){
                \File::delete(public_path('product_images/'.$product->image));
            }
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $filenameToStore = $filename.'_'.time().'.'.$extension;
            $request->file('image')->move(public_path('product_images'), $filenameToStore);
        }
        
        //$product->update($request->all());
        $product->categoryId = $request->input('categoryId');
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        if($request->hasFile('image')){
            $product->image = $filenameToStore;
        }
        $product->save();

        return redirect()->route('products.index')->with(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if(\File::exists(public_path('product_images/'.$product->image))){
            \File::delete(public_path('product_images/'.$product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with(['message' => 'Product deleted successfully']);
    }

    public function massDestroy(Request $request)
    {
        $products = explode(',', $request->input('ids'));
        foreach ($products as $product_id) {
            $product = Product::findOrFail($product_id);
            if(\File::exists(public_path('product_images/'.$product->image))){
                \File::delete(public_path('product_images/'.$product->image));
            }
            $product->delete();
        }
        return redirect()->route('products.index')->with(['message' => 'Products deleted successfully']);
    }
}
