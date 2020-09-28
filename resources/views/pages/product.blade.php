@extends('layout.index')
@section('content')
<div class="container">
    @include('layout.nav')
</div>
<div class="small-container">
    <div class="row row-2">
        <h2>ALl Product</h2>
        <select>
            <option value="">Default Shorting</option>
            <option value="">SHort By Price</option>
            <option value="">Short By popularity</option>
            <option value="">Short By Rating</option>
            <option value="">Short By Sale</option>
        </select>
    </div>
    <div class="row">
        @foreach($products as $product)
   <div class="button">
                        <button type="submit">Add to Cart</button>
                    </div>          <div class="col-4">
                <div class="product">
                    <a href="product/detail/{{$product->id}}">
                        <img src="{{$product->img}}" alt="">
                    </a>
                    <form action="cart" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="idProduct" value="{{$product->id}}">
                        <div class="button">
                            <button type="submit">Add to Cart</button>
                        </div>
                    </form>
                </div>
                <h4>{{$product->name}}</h4>
                <div class="rating">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-o"></i>
                </div>
                <p>${{$product->price}}</p>
            </div>
        @endforeach
    </div>
    <div class="page-btn">
        <span>1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <span>&#8594;</span>
    </div>
</div>
@endsection
