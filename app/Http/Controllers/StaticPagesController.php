<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaticPages;
use App\Http\Requests\StoreStaticPageRequest;

class StaticPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = StaticPage::with('category')->paginate(10);
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
    public function store(StoreStaticPageRequest $request)
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

        // Create StaticPage
        //StaticPage::create($request->all());
        $product = new StaticPage;
        $product->categoryId = $request->input('categoryId');
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->image = $filenameToStore;
        $product->save();

        return redirect()->route('products.index')->with(['message' => 'Static page added successfully']);
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
        $product = StaticPage::findOrFail($id);
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
        // Create StaticPage
        $product = StaticPage::findOrFail($id);
        
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

        return redirect()->route('products.index')->with(['message' => 'Static page updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = StaticPage::findOrFail($id);
        if(\File::exists(public_path('product_images/'.$product->image))){
            \File::delete(public_path('product_images/'.$product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with(['message' => 'Static page deleted successfully']);
    }

    public function massDestroy(Request $request)
    {
        $products = explode(',', $request->input('ids'));
        foreach ($products as $product_id) {
            $product = StaticPage::findOrFail($product_id);
            if(\File::exists(public_path('product_images/'.$product->image))){
                \File::delete(public_path('product_images/'.$product->image));
            }
            $product->delete();
        }
        return redirect()->route('products.index')->with(['message' => 'Static pages deleted successfully']);
    }
}
