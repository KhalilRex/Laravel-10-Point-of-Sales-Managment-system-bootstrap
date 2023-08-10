<nav class="navbar">
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline rounded-pill"><i class="bi bi-list-task bi-lg"></i></a>
    <a href="{{ route('home') }}" class="btn btn-outline rounded-pill"><i class="bi bi-house bi-lg"></i><span class="ms-2">Home</span></a>
    <a href="{{ route('products.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-cart bi-lg"></i><span class="ms-2">Product</span></a>
    <a href="{{ route('user.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-people bi-lg"></i><span class="ms-2">Staff</span></a>
    <a href="{{ route('orders.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-cash-stack bi-lg"></i><span class="ms-2">Receipt</span></a>
    <a href="{{ route('suppliers.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-truck bi-lg"></i><span class="ms-2">Suppliers</span></a>
    <a href="{{ route('category.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-grid bi-lg"></i><span class="ms-2">Categories</span></a>
    <a href="{{ route('stocks.index') }}" class="btn btn-outline rounded-pill"><i class="bi bi-graph-up bi-lg"></i><span class="ms-2">Stocks</span></a>
    <a href="{{ route('products.barcode') }}" class="btn btn-outline rounded-pill"><i class="bi bi-qr-code bi-lg"></i><span class="ms-2">Barcode</span></a>
    <!---a href="{{-- route('products.index') --}}" class="btn btn-outline rounded-pill"><i class="bi bi-file-earmark-bar-graph bi-lg"></i><span class="ms-2">Report</span></a--->

     {{---    <button class="navbar-toggler">
      <span class="navbar-toggler-icon"></span>
    </button>--}}
  </nav>
  
<style>
  .navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f8f9fa;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
  }
  
  .btn-outline {
    border-color: #008b8b;
    color: #008b8b;
    font-weight: bold;
    font-size: 18px;
  }
  .btn-outline:hover {
    background: #008b8b;
    color: #FFF;
    font-weight: bold;
    font-size: 24px;
  }
  
  .nav {
    display: flex;
    justify-content: center;
    align-items: center;
    list-style: none;
    margin: 0;
    padding: 0;
  }
  
  

  
  @media (max-width: 768px) {
    .nav {
      display: none;
    }
    .navbar-toggler {
      display: block;
      background-color: transparent;
      border: none;
    }
    .navbar-toggler-icon {
      display: block;
      width: 30px;
      height: 3px;
      background-color: #333;
      border-radius: 2px;
    }
  }
  </style>