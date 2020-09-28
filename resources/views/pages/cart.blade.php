@extends('layout.index')
@section('content')
    <div class="container">
        @include('layout.nav')
    </div>
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $cart)
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="{{$cart->options->image}}" alt="">
                        <div>
                            <p>{{$cart->name}}</p>
                            <small>Price:${{$cart->price}}</small>
                            <br>
                            <a href="cart/delete/{{$cart->rowId}}">Remove</a>
                        </div>
                    </div>
                </td>
                <td>
                        <form style="display: inline-flex;" action="cart/update/{{$cart->rowId}}" method="post">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <input type="number" value="{{$cart->qty}}" name="qty">
                            <input  class="btn" type="submit" value="Update">
                        </form>
                </td>
                <td>${{$cart->price}}</td>
            </tr>
            @endforeach

        </table>
        <div class="total-price">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>{{\Gloudemans\Shoppingcart\Facades\Cart::subtotal()}}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>{{\Gloudemans\Shoppingcart\Facades\Cart::tax()}}</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>{{\Gloudemans\Shoppingcart\Facades\Cart::total()}}</td>
                </tr>
               @if(sizeof(\Gloudemans\Shoppingcart\Facades\Cart::content())>0)
                    <tr>
                        <td><a href="checkout" class="btn">Checkout</a></td>
                    </tr>
                   @endif
            </table>
        </div>
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
    {{--<script>--}}
        {{--function changeQty() {--}}
            {{--<?php--}}
                {{--$a = '465e2130e99d1953014f5ea27007c7e2';--}}
            {{--\Gloudemans\Shoppingcart\Facades\Cart::update($a, 2);--}}
            {{--?>--}}
        {{--}--}}
    {{--</script>--}}
@endsection
