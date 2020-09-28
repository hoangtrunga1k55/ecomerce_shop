@extends('layout.index')
@section('content')
    <div class="container">
        @include('layout.nav')
    </div>
    <div id="info">
        <div>
            <p>Làm ơn đăng ký hoặc đăng nhập để thanh toán và xem lại lịch sử mua hàng</p>
        </div>
        <div class="info">
            <p>Điền thông tin đơn hàng</p>
            <form action="checkout" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="name" placeholder="Name">
                <input type="text" name="address" placeholder="Address">
                <input type="text" name="phone" placeholder="Phone">
                <textarea name="note" cols="47" rows="18" placeholder="Note your Product Description"></textarea>
              <div style="display:flex">
                  <button class="btn" type="submit">Submit</button>
                  <a href="cart"class="btn">Cart</a>
              </div>
            </form>
        </div>
    </div>

@endsection

