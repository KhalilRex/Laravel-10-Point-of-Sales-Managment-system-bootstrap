<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;

class Order extends Component
{
    public $orders, $products = [],$product_code, $message='', $productIncart;
    
    public $pay_money = '', $balance = '';
    
    public function mount()
    {
        $this->products = Product::all();
        $this->productIncart = Cart::all();
    }

   public function InsertoCart()
    {
        $countProduct = Product::where('id',$this->product_code)->first();
         
         if (!$countProduct) {   
            return $this->message = 'Product Not fount';
          }

           $countCartProduct = Cart::where('product_id',$this->product_code)->count();
          
            if($countCartProduct > 0){
                  return $this->message = 'Product '. $countProduct->Title.' already exist in cart please add quantity';
            }
            $add_to_cart = new Cart;
            $add_to_cart->product_id = $countProduct->id;
            $add_to_cart->product_qty = 1;
            $add_to_cart->product_price = $countProduct->Price;
            $add_to_cart->user_id = auth()->user()->id;
            $add_to_cart->save();
            
            $this->productIncart->prepend($add_to_cart);

            $this->product_code = ' ';
            return $this->message = "Product added Successfully";
    } 

    public function IncrementQty($cartId)
    {
        $cart = Cart::find($cartId);
        $cart->increment('product_qty', 1);
        $updatePrice = $cart->product_qty * $cart->product->Price;
        $cart->update(['product_price' => $updatePrice]);
        $this->mount();
    }
    
     public function DecrementQty($cartId)
     {
        $cart = Cart::find($cartId);
        if($cart->product_qty == 1){
            return session()->flash('info','Product' .$cart->product->Title.' Quantity can not be less then 1 add quantity or remove product in cart');
        }
        $cart->decrement('product_qty', 1);
        $updatePrice = $cart->product_qty * $cart->product->Price;
        $cart->update(['product_price' => $updatePrice]);
        $this->mount(); 
    }
    public function removeProduct($cartId)
    {
        $deleteCart = Cart::find($cartId);
        $deleteCart->delete();

        $this->message = "Product Removed Successfully";

        $this->productIncart = $this->productIncart->except($cartId);
    }
    
    public function render()
    {
        if($this->pay_money != '')
        {
            $totalAmount = intval($this->pay_money) - $this->productIncart->sum('product_price');
            $this->balance = $totalAmount;
        }
        return view('livewire.order');
    }
}