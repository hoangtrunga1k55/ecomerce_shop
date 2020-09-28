<div class="small-container">
    <h2 class="title">Featured Products</h2>
    <div class="row">
        @foreach($feature->Product as $product)
        <div class="col-4">
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
    <h2 class="title">Latest Products</h2>
    <div class="row">
        @foreach($latest->Product as $productt)
        <div class="col-4">
            <div class="product">
                <a href="product/detail/{{$product->id}}"> <img src="{{$productt->img}}" alt=""></a>
                <form action="cart" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="idProduct" value="{{$product->id}}">
                    <div class="button">
                        <button type="submit">Add to Cart</button>
                    </div>
                </form>
            </div>
            <h4>{{$productt->name}}</h4>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <p>${{$productt->price}}</p>
        </div>
            @endforeach
    </div>
</div>
