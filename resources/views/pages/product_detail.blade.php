@extends('layout.index')
@section('content')
<div class="container">
    @include('layout.nav')
</div>
<div class="small-container single-product">
    <div class="row">
        <div class="col-2">
            <img src="{{asset($product->img)}}" width="100%" alt="" id="product-img">
            <div class="small-img-row">
                <div class="small-img-col">
                    <img src="images/gallery-1.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="images/gallery-2.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="images/gallery-3.jpg" width="100%" class="small-img" alt="">
                </div>
                <div class="small-img-col">
                    <img src="images/gallery-4.jpg" width="100%" class="small-img" alt="">
                </div>
            </div>
        </div>
        <div class="col-2">
            <p>Home/ T-shirt</p>
            <h1>{{$product->name}}</h1>
            <h4>${{$product->price}}</h4>
            <select name="" id="">
                @foreach($product->Size as $size)
                    <option value="{{$size->id}}">{{$size->nameOfSize}}</option>
                    @endforeach
            </select>
            <input type="number" value="1">
            <form action="cart" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="idProduct" value="{{$product->id}}">
                <div class="button">
                    <button type="submit">Add to Cart</button>
                </div>
            </form>
            <h3>Product Details <i class="fa fa-indent"></i></h3>
            <br>
            <p>{{$product->description}}</p>
        </div>
    </div>
    @include('layout.relate_product')
</div>
    @endsection
@section('script')
        <script>
            var MenuItems = document.getElementById("MenuItems");
            MenuItems.style.maxHeight = "0px";
            function menutoggle() {
                if (MenuItems.style.maxHeight == "0px") {
                    MenuItems.style.maxHeight = "200px";
                }
                else {
                    MenuItems.style.maxHeight = "0px";
                }
            }
        </script>
        <!-- ----js for product gallary----- -->
        <script>
            var productImg = document.getElementById("product-img");
            var SmallImg = document.getElementsByClassName('small-img');
            SmallImg[0].onclick = function(){
                productImg.src = SmallImg[0].src;
            }
            SmallImg[1].onclick = function(){
                productImg.src = SmallImg[1].src;
            }
            SmallImg[2].onclick = function(){
                productImg.src = SmallImg[2].src;
            }
            SmallImg[3].onclick = function(){
                productImg.src = SmallImg[3].src;
            }
        </script>
@endsection
