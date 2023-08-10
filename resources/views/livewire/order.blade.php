<div class="container-fluid">
 <div class="col-lg-12">
    <div class="row">
      <div class="col-md-8" >
        <div class="card" style="background-color: aliceblue">              
           
          
          
          <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
            <h4 style="float: left;">Orders Products</h4>
            <a href="#" style="float:right" class="btn btn-dark text-end" data-bs-toggle="modal" data-bs-target="#addUser">
              <i class='bi bi-plus bi-lg me-2'></i>Add New Product</a>
          </div> 
          
       {{-- <formaction="route("orders.store") }}" method="POST">  
            @csrf  ----}}
            <div class="card-body">
              <div class="my-2">
                <form wire:submit.prevent="InsertoCart">
                <input type="text"  name="" wire:model="product_code" class="form-control" placeholder="Enter Product Code">
                </form>
              </div>
               <div class="alert alert-success">{{-- $message --}}</div>
                  @if(session()->has('success'))
                    <div class="alert alert-success">
                     {{ session('success') }}
                    </div>
                  @elseif(session()->has('info'))
                    <div class="alert alert-info">
                      {{ session('info') }}
                    </div>
                  @elseif(session()->has('eror'))
                    <div class="alert alert-danger">
                      {{ session('error') }}
                    </div>
                  @endif

              <table class="table table-bordered table-left">
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Discount(%)</th>
                    <th colspan="6">Total</th>
                  {{---  <th><a href="#" class="btn btn-sm btn-success add_more"  ><i class="bi bi-plus" style="font-size: 1rem;"></i> 
                    </a> </th>  ---}}
                </thead>
                <tbody class="addMoreProduct">
                  @foreach ($productIncart as $key=> $cart)
                      
                  
                 <tr>
                  <td class="no">{{ $key + 1 }}</td>
                    <td width="30%">
                        <input type="text" class="form-control" value="{{ $cart->product->Title }}">
                    </td>
                    <td width="14%">
                      {{-- Sales as quantity --}}
                      <div class="row">
                        <div class="col-md-2">
                          <button wire:click.prevent="IncrementQty({{ $cart->id }})" class="btn btn-sm btn-success">+</button>
                        </div>
                        <div class="col-md-1">
                          <label for="">&nbsp;&nbsp;{{ $cart->product_qty }}</label>
                        </div>
                        <div class="col-md-2">
                          <button wire:click.prevent="DecrementQty({{ $cart->id }})" class="btn btn-sm btn-danger">-</button>
                        </div>
                      </div>   
                     
                    </td>
                    <td>
                        <input type="number"
                        class="form-control" value="{{ $cart->product->Price }}">
                    </td>
                    <td>
                        <input type="number"  
                        class="form-control" placeholder="0" value="{{ $cart->product->discount }}">
                    </td>
                    <td>
                        <input type="number"   
                        class="form-control total_amount" value="{{  $cart->product_qty  * $cart->product->Price}}">
                    </td>
                    <td>
                      <a href="#" class="btn btn-sm btn-danger delete" wire:click="removeProduct({{ $cart->id }})">
                          <i class="bi bi-trash" style="font-size: 1rem;"></i> 
                      </a> 
                  </td>
                  
                 </tr>
                 @endforeach
                </tbody>
              </table>
            </div>
        </div> 
      </div>   
      <div class="col-md-4">
        <div class="card" style="background-color: aliceblue">
          <div class="card-header" style="background-color: rgb(63, 11, 112); color:white">
            <h4 >
              Total :<b class="total1">{{ $productIncart->sum('product_price') }}</b>
            </h4>
          </div>
      <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        @foreach ($productIncart as $key=> $cart)      
        
               <input type="hidden"  class="form-control" name="product_id[]" value="{{ $cart->product->id }}">
               <!--Sale as Quanitiy--->
               <input type="hidden" name="quantity[]" value="{{ $cart->product_qty }}">
                 
               
               <input type="hidden" name="Price[]"
               class="form-control Price" value="{{ $cart->product->Price }}">
               
               <input type="hidden" name="discount[]" 
               class="form-control discount" placeholder="0" >
               
               <input type="hidden" name="total_amount[]" 
               class="form-control total_amount" 
               value="{{  $cart->product_qty  * $cart->product->Price}}">
        @endforeach
  

 
            <div class="card-body">
              <div class="btn-group">
                <button type="button"
                  onclick="PrintReceiptContent('print')" 
                  class="btn btn-dark"><i class="bi bi-printer"></i> Print
                </button>
                <button type="button"
                  onclick="PrintReceiptContent('history')" 
                  class="btn btn-primary"><i class="bi bi-clock-history"></i> History
                </button>
                <button type="button"
                  onclick="PrintReceiptContent('report')" 
                  class="btn btn-danger"><i class="bi bi-file-earmark-bar-graph"></i> Report
                </button>
              </div>


            <div class="panel">
              <div class="row">
                <table class="table table-striped">
                  <tr>
                    <td>
                      <label for="customer_name" id="" >Customer Name </label>
                        <input type="text" name="customer_name" id="" class="form-control">
                    </td>
                    <td>
                      <label for="customer_phone" id="" >Customer Phone </label>
                        <input type="number" name="customer_phone" id="" class="form-control">
                    </td>
                  </tr>
                </table>

                <td >Payment Type <br>
                  <span class="radio_item">
                    <input type="radio" name="payment_method" id="payment_method"
                    class="true" value="cash" checked>
                    <label for="payment_method"><i class="bi bi-cash-coin text-success"></i>Cash</label>
                  </span>
                  <span class="radio_item">
                    <input type="radio" name="payment_method" id="payment_method"
                    class="true" value="bank tansfer" >
                    <label for="payment_method"><i class="bi bi-bank2 text-danger"></i>bank tansfer</label>
                  </span>
                  <span class="radio_item">
                    <input type="radio" name="payment_method" id="payment_method"
                    class="true" value="credit card" >
                    <label for="payment_method"><i class="bi bi-credit-card text-info"></i>credit card</label>
                  </span>
                </td>
                <br>
                <td>
                  Payment <input type="number" wire:model="pay_money" name="paid_amount" id="paid_amount" class="form-control" >
                </td>
                <td>
                  Returning Change <input type="number" wire:model="balance" name="balance" id="balance" class="form-control" readonly>
                </td>                
                <td>
                  <button class="btn btn-primary btn-lg btn-block mt-3">Save</button>
                </td>
                <td>
                  <button class="btn btn-danger btn-lg btn-block mt-1">Calculator</button>
                </td>
                <td>
                  <a href="#" class="text-center"><i class="bi bi-lock"></i>LOGOUT </a>
                </td>
                </div>
              </form>

              </div>
            </div>
          
          </div>
        </div>
      </div>
    </form> 
    </div>
  </div>
</div>

{{-- ------MODEL FOR ADDING NEW ------- --}}
<div class="modal right fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
        <label for="">Title</label>
        <input type="text" name="Title" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Description</label>
        <input type="text" name="Description" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Categories Id</label>
        <input type="text" name="categories_Id" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Image</label>
        <input type="file" name="Image" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Price</label>
        <input type="number" name="Price" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Quantity</label>
        <input type="number" name="Sale" id="" class="form-control">
        </div>
        <div class="form-group">
        <label for="">Alert Stock </label>
        <input type="number" name="alert_stock" id="" class="form-control">
        </div>  
  
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-block">Save</button>
        </div>
        </form>
        </div>
  
      </div>
    </div>
  </div><!---end of add model--->
  
