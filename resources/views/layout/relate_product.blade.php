<div class="small-container">
    <div class="row row-2">
        <h2>Related Product</h2>
        <p>View More</p>
    </div>
</div>
<!-- ------Products------- -->
<div class="small-container">
    <div class="row">
        @foreach($relate->Product as $product)
        <div class="col-4">
            <img src="{{asset($product->img)}}" alt="">
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
</div>
