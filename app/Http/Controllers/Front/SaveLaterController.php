<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SaveLaterController extends Controller
{
    public function destroy($id){
//        dd($id);
        Cart::instance('saveForLater')->remove($id);

        return redirect()->back()->with('msg','Item has been removed from save for Later');
    }


    public function moveToCart($id){

        Cart::setGlobalTax(0);

        $item = Cart::instance('saveForLater')->get($id);

        Cart::instance('saveForLater')->remove($id);


        // Avoide adding duplicate item-that is already exist in cart
        $duplicate = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id){
            return $cartItem->id === $id;
        });

        if( $duplicate->isNotEmpty()){
            return redirect()->back()->with('msg','Item is already exists in your cart');
        }


        Cart::instance('default')->add($item->id,$item->name,1,$item->price)->associate('App\Product');
        return redirect()->back()->with('msg','The item has been moved to cart');
    }
}
