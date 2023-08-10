<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
//use vendor\Picqer;
use Picqer;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(50);
        return view('products.index',['products'=>$products]); 
       
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
        
       /**/ //product code section, $redColor
        $product_code = $request->product_code;
       
        $products = new Product;

            /*if ($request->hasFile('product_image')) {
                $filenameWithExt = $request->file('product_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $filenameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('product_image')->storeAs('product/images/', $filenameToStore);
                $products->product_image = $filenameToStore;

            } */
            if ($request->hasFile('product_image')) {
                $filenameWithExt = $request->file('product_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $filenameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('product_image')->storeAs('images', $filenameToStore);
                $products->product_image = 'product/images/' . $filenameToStore;
            }
            
       
                $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
                file_put_contents('product/barcodes/' .$product_code. '.jpg',
                $generator->getBarcode($product_code,
                $generator::TYPE_CODE_128, 3, 50));
        
        //   Product::create($request->all());
        $products->Title = $request->input('Title');
        $products->product_code = $product_code;
        $products->barcode = $product_code. '.jpg';
        $products->Description = $request->input('Description');
        $products->categories_Id = $request->input('categories_Id');
        $products->Image = $request->input('Image');
        $products->Price = $request->input('Price');
        $products->Sale = $request->input('Sale');
        $products->alert_stock = $request->input('alert_stock');
        if ($request->hasFile('Image')) {
            $filenameWithExt = $request->file('Image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('Image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('Image')->storeAs('public/images', $filenameToStore);
            $products->Image = $filenameToStore;
        } 
        $products->save();
        
        if($products){
            return redirect()->route('products.index')->with('success', 'User created successfully');
        }
        return redirect()->back()->with('error', 'Failed to create user'); 
        //dd($request->all());
    }  

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $product)
    { 
          $products = Product::find($product);
            //image section
            if ($request->hasFile('product_image')) {

                if($products->barcode != ''){
                    $proImage_path = public_path() . '/product/images/' .$products->barcode;
                    unlink($proImage_path);
                }
                
                $filenameWithExt = $request->file('product_image')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('product_image')->getClientOriginalExtension();
                $filenameToStore = $filename . '_' . time() . '.' . $extension;
                $path = $request->file('product_image')->storeAs('product/images', $filenameToStore);
                $products->product_image = $filenameToStore;
            } 
                //Barcode image Section
                 
                if($request->product_code != '' 
                && $request->product_code != $products->product_code){
                    
                    if($products->barcode != ''){
                       $barcode_path = public_path() . '/product/barcodes/' .$products->barcode;
                       unlink($barcode_path);
                    }
                    $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
                    file_put_contents('product/barcodes/' .$product_code. '.jpg',
                    $generator->getBarcode($product_code,
                    $generator::TYPE_CODE_128, 3, 50)); 

                    $products->barcode = $product_code. '.jpg';
                }
                
       
      /*  $product_code = rand(106890122, 100000000);

        $redColor = [255, 0, 0];
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcodes = $generator->getBarcode($product_code,
        $generator::TYPE_STANDARD_2_5, 2, 60);*/
        
        
       
        $products->Title = $request->input('Title');
        $products->product_code = $product_code;
        $products->barcode = $product_code. '.jpg';
        $products->Description = $request->input('Description');
        $products->categories_Id = $request->input('categories_Id');
        $products->Image = $request->input('Image');
        $products->Price = $request->input('Price');
        $products->Sale = $request->input('Sale');
        $products->alert_stock = $request->input('alert_stock');
        if ($request->hasFile('Image')) {
            $filenameWithExt = $request->file('Image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('Image')->getClientOriginalExtension();
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('Image')->storeAs('public/images', $filenameToStore);
            $products->Image = $filenameToStore;
        } 
        $products->save();
        

       // $product->update($request->all());
           return redirect()->route('products.index')->with('success', 'products updated successfully'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'User not found');
        }
           $product->delete($request->all());
           return redirect()->route('products.index')->with('success', 'products updated successfully'); 
    
    }
    public function GetProductBarcodes()
    {
         $productsBarcode = Product::select('barcode', 'product_code')->get();

        return view('products.barcode.index', compact('productsBarcode'));
    }
}
