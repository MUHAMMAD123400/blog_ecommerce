<div class="latest-products">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Latest Products</h2>
            <a href="products.html">view all products <i class="fa fa-angle-right"></i></a>
            <form action="{{url('search')}}" class="p-5 form-inline" style="float: right" method="get">
              @csrf
              <input type="search" class="form-control" name="search" placeholder="Search">&nbsp;
              <input type="submit" style="background-color: #28a745" value="Search" class="btn btn-success">
            </form>
          </div>
        </div>
        @foreach($data as $product)
        <div class="col-md-4">
          <div class="product-item">
            <a href="#"><img height="300" width="150" src=" {{asset('productimages/'.$product->image)}}" alt=""></a>
            <div class="down-content">
              <a href="#"><h4>{{$product->title}}</h4></a>
              <h6>${{$product->price}}</h6>
              <p>{{$product->description}}</p>
              <form action="{{url('addcart' , $product->id )}}" method="post">
                @csrf
                {{-- <input type="hidden" name="id" value="{{$product->id}}"> --}}
                <input type="number" value="1" min="1" name="quantity" class="form-control" style="width: 100px">
                <br>
                <input class="btn btn-primary bg-primary" type="submit" value="Add Cart" >
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @if(method_exists($data, 'links'))
      <div class="d-flex justify-content-center">
        {{-- {{ $data->links('pagination::bootstrap-4') }} --}}
        {{ $data->render('pagination::bootstrap-4'); }}
      </div>
      @endif
      
    </div>
  </div>