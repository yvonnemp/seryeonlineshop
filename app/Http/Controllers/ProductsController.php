<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;
use DB;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = Product::orderBy('title','asc')->get();
        $products = Product::orderBy('created_at','asc')->paginate(10);
        return view('products.index')-> with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'product_img' => 'image|nullable|max:1999'

        ]);
        // Handle file upload
        if($request->hasFile('product_img')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('product_img')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension =  $request->file('product_img')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path =  $request->file('product_img')->storeAs('public/product_img', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.jpg';
        }


        // Create Products

        $product = new Product;
        $product->title = $request->input('title');
        $product->body = $request->input('body');
        $product->user_id =  auth()->user()->id;
        $product->product_img = $fileNameToStore;
        $product->save();

        return redirect('/products')->with('success', 'Product successfully posted!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        // Check for correct user
        if(auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Sorry, unauthorized access.');
        }

        return view('products.edit')->with('product', $product);
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
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'

        ]);

        // Handle file upload
        if($request->hasFile('product_img')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('product_img')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just ext
            $extension =  $request->file('product_img')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path =  $request->file('product_img')->storeAs('public/product_img', $fileNameToStore);

        } 

        // return 123;
        // Create Products

        $product = Product::find($id);
        $product->title = $request->input('title');
        $product->body = $request->input('body');
        if($request->hasFile('product_img')) {
            $product->product_img = $fileNameToStore;
        }

        $product->save();

        return redirect('/products')->with('success', 'Product successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if(auth()->user()->id !== $product->user_id) {
            return redirect('/products')->with('error', 'Sorry, unauthorized access.');
        }

        if($product->product_img != 'noimage.jpg') {
            // Delete image
            Storage::delete('public/product_img/'.$product->product_img);
        }
        
        $product->delete;
        return redirect('/products')->with('success', 'Product successfully removed!');

    }
}
