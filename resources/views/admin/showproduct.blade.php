<!DOCTYPE html>
<html lang="en">
  <head>
    @include('admin.css')
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
      <div class="container-fluid page-body-wrapper">
        <div class="container text-center mt-5">
            @if(session()->has('message'))
                <div id="alert" class="alert alert-success">
                    <b>{{session()->get('message')}}</b>
                </div>
            @endif
            <table class="table">
                <thead>
                  <tr>
                    <th class="text-center">Title</th>
                    <th class="text-center">Price</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $product)
                  <tr>
                    <th>{{$product->title}}</th>
                    <th>{{$product->price}}</th>
                    <th>{{$product->description}}</th>
                    <th>{{$product->quantity}}</th>
                    <th>
                       <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$product->id}}">
                        <img src="{{asset('productimages/'.$product->image)}}" alt="" srcset="">
                       </button>
                    </th>
                    <th><a href="{{ url('update/'.$product->id)}}" class="btn btn-primary">update</a>&nbsp;<a href="{{ url('delete/'.$product->id)}}" onclick="return confirm('Are You sure you want to delete this product?')" class="btn btn-danger">delete</a></th>
                  </tr>
                  <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$product->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Image</h1>
                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <img src="{{asset('productimages/'.$product->image)}}" alt="" srcset="">
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                        </div>
                    </div>
                  @endforeach
                </tbody>
              </table>

  
  
  
        </div>
      </div>
      @include('admin.script')
      <script>
        $(document).ready(function () {
            var table = $('.table').DataTable();
            // alert('done')

            setTimeout(() => {
                $('#alert').fadeOut();
            }, 5000);
        });
      </script>
  </body>
</html>