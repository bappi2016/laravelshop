<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product ;

class ProductController extends Controller
{
    public function index()
    {
        # code...
        $products = Product::all();
        // create a view and pass a context variable products
        return view('admin.products.index',compact('products'));
    }

    public function create()
    {
        $product = new Product();
        return view('admin.products.create',compact('product'));
    }


    public function show($id)
    {
        $product = Product::find($id);
        return view('admin.products.details',compact('product'));
        // view('template_name',context variable)

    }

    public function store(Request $request)
    {
        
        // validate the input data

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'image|required', 
        ]);

        // upload image

        if($request->hasFile('image')){
            $image = $request->image;
            $image->move('uploads',$image->getClientOriginalName());
                
            } 

        // save data in database

        Product::create([
            'name'=> $request->name,
            'price'=> $request->price,
            'description' => $request->description,
            'image' => $request->image->getClientOriginalName()
        ]);

        // session message

        $request->session()->flash('msg','Your product has been added');

        // redirect 
        return redirect('admin/products');
        }

        public function destroy($id){
            // Destroy the product
            Product::destroy($id);

            // store a message
            session()->flash('msg','Product has been deleted');

            // Redirect back
            return redirect('admin/products');
        }

        public function edit($id)
        {
            # code...
            $product = Product::find($id);
            return view('admin.products.edit',compact('product'));
        }

        public function update(Request $request , $id)
        {
            // Find the product

            $product = Product::find($id);

            // Validate the form 
            $validatedData = $request->validate([
                'name' => 'required',
                'price' => 'required',
                'description' => 'required',
            ]);

            // Check if there is any image
            if ($request->hasFile('image')){
                // Check if the old image exists inside folder
                if(file_exists(public_path('uploads/') . $product->image)){
                    unlink(public_path('uploads/') . $product->image);
                }
                
                $image = $request->image;
                $image->move('uploads',$image->getClientOriginalName());

                $product->image = $request->image->getClientOriginalName();
            }


            // Updating the product
            $product->update([
            'name'=> $request->name,
            'price'=> $request->price,
            'description' => $request->description,
            'image' => $product->image
            ]);

            // Store a message in session
            $request->session()->flash('msg','Product has been updated');

            // Redirect
            return redirect('admin/products');
        }

        
    }
