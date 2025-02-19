<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(){
        return view('front.cart.index');
    }

    public function store(Request $request){

        Cart::setGlobalTax(0);
        // Avoide adding duplicate item-that is already exist in cart
        $duplicate = Cart::search(function ($cartItem, $rowId) use ($request){
            return $cartItem->id === $request->id;
        });

        if( $duplicate->isNotEmpty()){
            return redirect()->back()->with('msg','Item is already exists in your cart');
        }
//        return dd($request->all());

        Cart::add($request->id,$request->name,1,$request->price)->associate('App\Product');
        return redirect()->back()->with('msg','Item has been added to cart');



    }

    public function destroy($id){
//        dd($id);
        Cart::remove($id);

        return redirect()->back()->with('msg','The item has been removed from your cart');
    }

    public function saveLater($id){

        Cart::setGlobalTax(0);

        $item = Cart::get($id);

        Cart::remove($id);

        // Avoide adding duplicate item-that is already exist in cart
        $duplicate = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $cartItem->id === $id;
        });

        if ($duplicate->isNotEmpty()) {
            return redirect()->back()->with('msg','Item is save for later');
        }





        Cart::instance('saveForLater')->add($item->id,$item->name,1,$item->price)->associate('App\Product');
        return redirect()->back()->with('msg','The item has been saved for later');
    }


    // Function for updating cart quantity

    public function update(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'quantity' => 'required|numeric|between:1,5'
        ]);
        if ($validator->fails()){
            session()->flash('errors','Quantity must be between 1 and 5');
            return response()->json(['success' => false]);
        }

        Cart::update($id,$request->quantity);

        // flash a session message
        session()->flash('msg','Quantity has been updated');

        return response()->json(['success' => true]);
    }


}
