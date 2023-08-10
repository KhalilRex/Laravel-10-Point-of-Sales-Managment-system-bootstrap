<nav class="active" id="sidebar">
    <ul class="list-unstyled lead">
      <li class="active">
         <a href=""> <i class="bi bi-house"></i>Mian Page</a>
      </li>
      <li>
        <a href="{{ route('products.index') }}"><i class="bi bi-cart bi-lg"></i>Products</a>
      </li>
      <li>
         <a href="{{ route('orders.index') }}"><i class="bi bi-cash-stack bi-lg"></i>Receipt</a>
      </li>
      <li>
         <a href="{{ route('sales.index') }}"><i class="bi bi-currency-dollar bi-lg"></i>Sales</a>
      </li>
      <li>
        <a href="{{ route('stocks.index') }}"><i class="bi bi-graph-up bi-lg"></i>Stocks</a>
     </li>
     <li>
        <a href="{{ route('customers.index') }}"><i class="bi bi-person-check bi-lg"></i>Customer</a>
     </li>
    </ul>
</nav>
 
<style>
    a {
        text-decoration: none;
      }
     #sidebar ul.lead{
         border-bottom: 1px solid #47748b;
         width: fit-content;
     }
     #sidebar ul li a{
         padding: 10px;
         font-size: 1.1em;
         display: block;
         width: 30vh;
         color:  #008b8b
     }
     #sidebar ul li a:hover{
         color: #fff;
         background:  #008b8b;
         text-decoration: none !important;
     }
     #sidebar ul li a:active{
         color: #fff;
         background:  #008b8b;
         text-decoration: none !important;
     }
     #sidebar ul li a i{
         margin-right: 10px;
     }
     #sidebar ul li.active > a,
     #sidebar ul li a[aria-expanded="true"] {
         color: #fff;
         background-color: #008b8b;
     }
</style>
 