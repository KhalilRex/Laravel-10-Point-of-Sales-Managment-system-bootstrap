<?php

namespace App\Http\Controllers;

use App\Models\Receipt;
use App\Models\Transaction;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        return $request->all();

  /*      $request = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|array',
          //  'price' => 'required|array',
            'customer_name' => 'nullable|string',
            'customer_phone' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'paid_amount' => 'required|numeric',
        ]);  */
       
        DB::transaction(function () use ($request) {
            $receipt = new Receipt();
            for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
                $receipt = new Receipt();
                $receipt->product_id = $request->product_id[$product_id];
                $receipt->quantity = $request->quantity[$product_id];
                $receipt->price = $request->Price[$product_id];
                $receipt->discount = $request->discount[$product_id];
                $receipt->amount = $request->amount[$product_id];
                $receipt->customer_name = $request->customer_name;
               // $receipt->customer_phone = $request->customer_phone;
                $receipt->save();
            }

            
        //Transaction Model
        $transaction = new Transaction();
        $transaction->receipt_id= $receipt_id;
        $transaction->staff_id = auth()->user()->id;
        $transaction->balance = $request->balance;
        $transaction->paid_amount = $request->paid_amount;
        $transaction->payment_method = $request->payment_method;
        $transaction->transac_amount = $receipt->amount;
        $transaction->transac_date = date('Y-m-d');
        $transaction->save();

            //Lat order History
        $products = Products::all();
        $receipt = Receipt::where('receipt_id', $receipt_id)->get();
        $orderedBy = Receipt::where('id', $receipt_id)->get();

        return view('orders.index',
        [
          'products' -> $products,
          'receipt' -> $receipt,
          'customer_orders'-> $orderedBy,
        ]);

        });
          return "Product Order Failed to Inserted! Check your input";
    
        

    }




    /**
     * Display the specified resource.
     */
    public function show(Receipt $receipt)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receipt $receipt)
    {
        //
    }

}
