<!--PRINT SECTION-->
<div id="invoice-POS">
  <div id="printed_content">
    <center id="logo">
      <div class="logo">AGS</div>
      <div class="info"></div>
      <h2>AGS Ltd</h2>
    </center>
  </div>
  
  <div class="mid">
    <div class="info">
      <h2>Contact Us</h2>
      <p>
        Address: FUUAST<br>
        Email: fuuast@abc.c<br>
        Phone: 12891420
      </p>
    </div>
  </div>
  
  <!--end of receipt-->
  <div class="bot">
    <div class="table">
      <table>
        <tr class="tabletitle">
          <td class="item"><h2>Item</h2></td>
          <td class="Hours"><h2>QTY</h2></td>
          <td class="Rate"><h2>Unit</h2></td>
          <td class="Rate"><h2>Discount</h2></td>
          <td class="Rate"><h2>Sub Total</h2></td>
        </tr>

        @foreach ( $receipt_receipt as $receipt)
        
        <tr>
          <td class="tableitem"><p class="itemtext">{{ $receipt->product->Title }}</p></td>
          <td class="tableitem"><p class="itemtext">{{ number_format($receipt->unitprice,2) }}</p></td>
          <td class="tableitem"><p class="itemtext">{{ $receipt->quantity }}</p></td>
          <td class="tableitem"><p class="itemtext">{{ $receipt->discount ? ' ' : '0' }}</p></td>
          <td class="tableitem"><p class="itemtext">{{ number_format($receipt->amount,2) }}</p></td>
        </tr>   
        @endforeach

        
        <tr class="tabletitle">
          <td></td>
          <td></td>
          <td></td>
          <td class="Rate"><p class="itemtext">Tax</p></td>
          <td class="Payment"><p class="itemtext">Sub Total ${{-- number_format($receipt->amount,2) --}}</p></td>
        </tr>
        <tr class="tabletitle">
          <td></td>
          <td></td>
          <td></td>
          <td class="Rate"><h2>Total</h2></td>
          <td class="Payment">{{ number_format($receipt_receipt->sum('amount'),2) }}<h2></h2></td>
        </tr>
      </table>
      <div class="legalcopy">
        <p class="legal"><strong>** Thank you for visiting **</strong><br>
        The goods which are subject to tax, prices include taxes.</p>
      </div>
      <div class="serial">M 
        Serial<span>423526623526</span>
        <span>24/12/2050 &nbsp; &nbsp; 00:45</span>
      </div>
    </div>
  </div>
</div>
<style>
  #invoice-POS{
    box-shadow: 0 0 1in -0.25in rgb(0,0,0.5);
    padding: 2mm;
    margin: 0 auto;
    width: 58mm;
    background: #fff;
  }
  #invoice-POS::selection{
    background: #34495E;
    color: #fff;
  }
  #invoice-POS ::-moz-selection{
    background: #34495E;
    color: #fff;
  }
  #invoice-POS h1{
    font-size: 1.5em;
    color: #222;

  }  
  #invoice-POS h2{
    font-size: 0.5em;
    
  } 
  #invoice-POS h3{
    font-size: 1.2em;
    font-weight: 300;
    line-height: 2em;
  } 

  #invoice-POS p{
    font-size: 0.7em;
    line-height: 1.2em;
    color: #666;
  } 
 
  #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot{
    border-bottom:1px solid #eee;
  }
  
  #invoice-POS #top{
    min-height: 100px;
  }
  
  #invoice-POS #mid{
    min-height: 80px;
  }
  
  #invoice-POS #bot{
    min-height: 50px;
  }
  
  #invoice-POS #top .logo{
    height: 60px;
    width: 60px;
    background-image: url() no-repeat;
    background-size: 60px 60px;
    border-radius: 59px;
  }

  #invoice-POS .info{
    display: block;
    margin-left: 0;
    text-align: center;
  }
  
  #invoice-POS .title{
    float: right;
  }

  #invoice-POS .title p{
    text-align: right;
  }

  #invoice-POS table{
    width: 100%;
    border-collapse: collapse;
  }
  
  #invoice-POS .tabletitle{
    font-size: 0.5em;
    background: #eee;
  }

  #invoice-POS .services{
    border-bottom: 1px solid #eee;
  }
  
  #invoice-POS .item{
    width: 24mm;
  }
  
  #invoice-POS .itemtext{
    font-size: 0.5em;
  }

  #invoice-POS #legalcopy{
    margin-top: 5mm;
  }

  #invoice-POS .serial{
    margin-top: 5mm;
    text-align: center;
    font-size: 0.6em;
  }

  #invoice-POS .serial span{
    margin-left: 5mm;
    font-weight: bold;
  }
</style>
