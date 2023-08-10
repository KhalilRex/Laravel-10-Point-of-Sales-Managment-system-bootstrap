<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Receipt;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::all();
        //last order detail
        $lastID = Receipt::max('order_id');
        $receipt_receipt = Receipt::where('order_id', $lastID)->get();
        return view('orders.index',[
        'products'=>$products,
        'orders'=>$orders,
        'receipt_receipt' => $receipt_receipt
         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
    {
   /*  return $request->all();
    $validatedData = $request->validate([
        'product_id' => 'required',
        'quantity' => 'required|array',
        'Price' => 'required|array',
        'customer_name' => 'nullable|string',
        'customer_phone' => 'nullable|string',
        'payment_method' => 'nullable|string',
        'paid_amount' => 'required|numeric',
    ], [
        'product_id.required' => 'Please select at least one product',
        'quantity.required' => 'Please enter quantity for each product',
        'Price.required' => 'Please enter price for each product',
        'paid_amount.required' => 'Please enter the paid amount',
        'paid_amount.numeric' => 'The paid amount must be a number',
    ]);*/
   // dd($request->product_id);
   DB::transaction(function () use ($request) {
        //Order Model 
        $orders = new Order;
        $orders->name = $request->customer_name;
        $orders->phone = $request->customer_phone;
        $orders->save();
        $order_id = $orders->id;

        //Receipt Model
        
        for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
            $receipt = new Receipt();
            $receipt->order_id = $order_id;
            $receipt->product_id = $request->product_id[$product_id];
            $receipt->unitprice = $request->Price[$product_id];
           // $receipt->unitprice = is_array($request->Price) ? $request->Price[$product_id] : $request->Price;
          //  $receipt->quantity = $request->quantity[$product_id];
          if(isset($request->quantity[$product_id])) {
            $receipt->quantity = $request->quantity[$product_id];
        }
            $receipt->discount = isset($request->discount[$product_id]) ? $request->discount[$product_id] : null;
            $receipt->amount = $request->total_amount[$product_id];
            $receipt->save();
        }

            //Transaction Model
            $transaction = new Transaction();
            $transaction->order_id= $order_id;
            $transaction->user_id = auth()->user()->id;
            $transaction->balance = $request->balance;
            $transaction->paid_amount = $request->paid_amount;
            $transaction->payment_method = $request->payment_method;
            $transaction->transac_amount = $receipt->amount;
            $transaction->transac_date = now()->toDateString();
            $transaction->save();
            
            // Clear the cart
           // Cart::where('user_id', auth()->user()->id)->delete();
            

        //Last order History
            $products = Product::all();
            $receipt = Receipt::where('order_id', $order_id)->get();
            $orderedBy = Order::where('id', $order_id)->get();

            return redirect()->route('orders.index')->with([
                'success' => 'Order created successfully!',
                'products' => $products,
                'receipt' => $receipt,
                'customer_orders'=> $orderedBy,
            ]);

    });
    
    //return redirect()->back()->withErrors($validatedData)->withInput(); 
    return redirect()->route('orders.index'); 
    } 


    /* 

    DB::beginTransaction();
    try {
        // Create a new order
        $order = new Order();
        $order->name = $request->input('customer_name');
        $order->phone = $request->input('customer_phone');
        $order->save();

        // Create a new receipt for each product in the order
        $totalAmount = 0;
        foreach ($request->input('product_id') as $index => $productId) {
            $receipt = new Receipt();
            $receipt->order_id = $order->id;
            $receipt->product_id = $productId;
            $receipt->unitprice = $request->input('Price')[$index];
            $receipt->quantity = $request->input('quantity')[$index];
            $receipt->discount = $request->input('discount')[$index] ?? null;
            $receipt->amount = $request->input('total_amount')[$index];
            $receipt->save();

            $totalAmount += $receipt->amount;
        }

        // Create a new transaction for the order
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->user_id = auth()->user()->id;
        $transaction->balance = $request->input('balance');
        $transaction->paid_amount = $request->input('paid_amount');
        $transaction->payment_method = $request->input('payment_method');
        $transaction->transac_amount = $totalAmount;
        $transaction->transac_date = now()->toDateString();
        $transaction->save();

        // Clear the cart
        Cart::truncate();

        DB::commit();
        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withInput()->withErrors([$e->getMessage()]);
    }
}
*/



    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
