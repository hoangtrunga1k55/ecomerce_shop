<div class="header">
    <div class="container">
        <div class="navbar">
            <div class="logo">
                <a href="index"><img src="images/logo.png" width="125px" alt=""></a>
            </div>
            <nav>
                <ul id="MenuItems">
                    @foreach($menus as $menu)
                        @if($menu->idParent==0)
                    <li><a href="{{$menu->slug}}">{{$menu->name}}</a></li>
                        @endif
                        @endforeach
                </ul>
            </nav>
            <div class="cart">
                <div class="cart">
                    <a href="cart"><img src="images/cart.png" width="30px" height="30px" alt=""></a>
                    @if(sizeof(\Gloudemans\Shoppingcart\Facades\Cart::content()) >0)
                        <span class="number">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
                    @endif
                </div>
            </div>
            <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
        </div>
        @if(isset($banner))
            <div class="row">
                <div class="col-2">
                    <h1>{!! $banner['title'] !!}</h1>
                    <p>{!! $banner['description'] !!}</p>
                    <a href="" class="btn">Explore Now <span>&#8594;</span></a>
                </div>
                <div class="col-2">
                    <img src="{{$banner['img']}}" alt="">
                </div>
            </div>
        @endif
    </div>
</div>
