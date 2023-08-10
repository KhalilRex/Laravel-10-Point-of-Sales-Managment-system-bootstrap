@extends('layouts.app')
@section('content')

   @livewire('order')


    {{-- ----PRINT MODAL-- --}}
 <div class="modal">
  <div id="print">
    @include('reports.receipt')
  </div>
 </div>





<style>
  .modal.right .modal-dialog{
  top:0%;
  right: 0%;
  margin-right: 20vh;
    }
  .modal.fade:not(.in).right .modal-dialog{
  -webkit-transform: translate3d(25%,0,0);
  transform: translate3d(25%,0,0)
    }
  .radio_item label {
      margin-left: 0px;
    }
    
    .radio_item input[type='radio'] {
      visibility: hidden;
      width: 20px;
      height: 20px;
      margin: 0 5px 0 5px;
      padding: 0;
      cursor: pointer;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
    }
    
    .radio_item input[type='radio']::before {
      position: relative;
      margin: 4px -25px -4px 0;
      display: inline-block;
      visibility: visible;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 2px inset rgb(150, 150, 150, 0.75);
      background: radial-gradient(
        ellipse at top left,
        rgb(225, 225, 225) 0%,
        rgb(250, 250, 250) 5%,
        rgb(230, 230, 230) 95%,
        rgb(225, 225, 225) 100%
      );
      content: '';
      cursor: pointer;
      display: inline-block;
      vertical-align: middle;
    }
    
    .radio_item input[type='radio']:checked::before {
      position: relative;
      margin: 4px -25px -4px 0;
      display: inline-block;
      visibility: visible;
      width: 20px;
      height: 20px;
      border-radius: 50%;
      border: 2px inset rgb(150, 150, 150, 0.75);
      background: radial-gradient(
        ellipse at top left,
        rgb(240, 225, 220) 0%,
        rgb(255, 250, 100) 5%,
        rgb(75, 75, 0) 95%,
        rgb(25, 100, 0) 100%
      );
      content: '';
      cursor: pointer;
      display: inline-block;
      vertical-align: middle;
    }
</style>
@endsection

@section('script')
    <script>

      $('.add_more').on('click',function(){
      var product = $('.product_id').html();
      var numberofrow = ($('.addMoreProduct tr').length - 0) + 1;
      var tr = '<tr><td class="no">' + numberofrow + '</td>' +
                '<td><select class="form-control product_id" name="product_id[]">'+product+
                '</select></td>' + 
                '<td> <input type="number"  name="quantity[]" class="form-control quantity"></td>'+
                '<td> <input type="number"  name="Price[]" class="form-control Price"></td>'+
                '<td> <input type="number"  name="discount[]" class="form-control discount" placeholder="0"></td>'+
                '<td> <input type="number"  name="total_amount[]" class="form-control total_amount"></td>'+
                '<td><a class="btn btn-sm btn-danger btn-sm delete rounded circle"><i class="bi bi-trash rounded-circle"></i></a> </td>';
      $('.addMoreProduct').append(tr);
      });
         //delete row
      $('.addMoreProduct').delegate('.delete','click',function(){
                $(this).parent().parent().remove();
      })

      function TotalAmount(){
        var total = 0;
        $('.total_amount').each(function(i, e){
             var amount = $(this).val()- 0;
             total +=amount;
        });

        $('.total').html(total);
      }

      $('.addMoreProduct').delegate('.product_id', 'change', function(){
    var tr = $(this).parent().parent();
    var Price = tr.find('.product_id option:selected').attr('data-price');
    tr.find('.Price').val(Price);
    var qty = tr.find('.quantity').val() - 0;
    var disc = tr.find('.discount').val() - 0;
    var Price = tr.find('.Price').val() - 0;
    var total_amount = (qty * Price) - ((qty * Price * disc) / 100);
    tr.find('.total_amount').val(total_amount);
    TotalAmount()  
   });

   $('.addMoreProduct').delegate('.quantity , .discount', 'keyup', function(){
    var tr = $(this).parent().parent();
    var qty = tr.find('.quantity').val() - 0;
    var disc = tr.find('.discount').val() - 0;
    var Price = tr.find('.Price').val() - 0;
    var total_amount = (qty * Price) - ((qty * Price * disc) / 100);
    tr.find('.total_amount').val(total_amount);
    TotalAmount()  
   });
   
   $('#paid_amount').keyup(function(){
    var total = $('.total').html();
    var paid_amount = $(this).val();
    var tot = paid_amount - total;
    $('#balance').val(tot).toFixed(2);
   })
    

   //Print Section
   function PrintReceiptContent(el) {
  var data = '<button type="button" id="printPageButton"' +
    ' class="printPageButton btn btn-primary" style="display:block;' +
    ' width:100%; border:none; background-color:#008B8B; color:#fff;' +
    ' padding:14px 28px; font-size:16px; cursor:pointer; text-align:center;' +
    ' value="Print Receipt" onClick="window.print()">Print Receipt</button>';
  data += document.getElementById(el).innerHTML;
  var myReceipt = window.open("", "myWin", "left=150, top=130, width=400, height=400");
  myReceipt.screenX = 0;
  myReceipt.screenY = 0;
  myReceipt.document.write(data);
  myReceipt.document.title = "Print Receipt";
  myReceipt.focus();
  setTimeout(() => {
    myReceipt.close();
  }, 800000);
}

  
   
    </script>

@endsection


