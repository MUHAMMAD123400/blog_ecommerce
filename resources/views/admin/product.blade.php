<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
    <style>
        .title{
            color:white; 
            font-size: 25px;
        }
        label{
            display: inline-block;
            width: 200px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
          <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
            <div class="ps-lg-1">
              <div class="d-flex align-items-center justify-content-between">
                <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
              <button id="bannerClose" class="btn border-0 p-0">
                <i class="mdi mdi-close text-white me-0"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      @include('admin.sidebar')

      @include('admin.navbar')
       
      {{-- @include('admin.body') --}}
            <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="container text-center">
            <h1 class="pt-5 title" >Add Product</h1>
                @if(session()->has('message'))
                    <div id="alert" class="alert alert-success">
                        {{session()->get('message')}}
                    </div>
                @endif
            <form action="{{url('uploadproduct')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div style="padding: 15px">
                    <label>Product Title</label>
                    <input class="text-black" type="text" name="title" placeholder="Give a product title" required>
                </div>
                <div style="padding: 15px">
                    <label>Price</label>
                    <input class="text-black" type="number" name="price" placeholder="Give a price" required>
                </div>
                <div style="padding: 15px">
                    <label>Description</label>
                    <input class="text-black" type="text" name="des" placeholder="Give a description" required>
                </div>
                <div style="padding: 15px">
                    <label>Quantity</label>
                    <input class="text-black" type="number" name="quantity" placeholder="Product Quantity" required>
                </div>
                <div style="padding: 15px">
                    <input type="file" name="file" required>
                </div>
                <div style="padding: 15px">
                    <input type="submit" class="btn btn-success">
                </div>
            </form>
            </div>
        </div>
     
      @include('admin.script')
      <script>
        $(document).ready(function () {
            setTimeout(() => {
                $('#alert').fadeOut();
            }, 5000);
        });
      </script>
  </body>
</html>