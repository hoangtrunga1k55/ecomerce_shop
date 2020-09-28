<div class="navbar">
    <div class="logo">
        <a href="index"> <img src="images/logo.png" width="125px" alt=""></a>
    </div>
    <nav>
        <ul id="MenuItems">
            @foreach($menus as $menu)
                @if($menu->idParent ==0)
                    <a href="{{asset("$menu->slug")}}">
                        <li>{{$menu->name}}
                            <?php $subMenu = \App\Menu::all()->where('idParent', '=', $menu->id) ?>
                            @if($subMenu->count() >0)
                                <ul class="sub">
                                    @foreach($subMenu as $sub)
                                        <a href="{{asset("$sub->slug/$sub->id")}}">
                                            <li>{{$sub->name}}
                                            <?php $subMenu = \App\Menu::all()->where('idParent', '=', $sub->id) ?>
                                            @if($subMenu->count() >0)
                                                <ul class="sub">
                                                    @foreach($subMenu as $sub)
                                                        <a href="{{asset("$sub->slug/$sub->id")}}">
                                                            <li>{{$sub->name}}
                                                                <?php $subMenu = \App\Menu::all()->where('idParent', '=', $sub->id) ?>
                                                                @if($subMenu->count()>0)
                                                                    <ul class="sub">
                                                                        @foreach($subMenu as $sub)
                                                                            <a href="{{asset("$sub->slug/$sub->id")}}">
                                                                                <li>{{$sub->name}}</li>
                                                                            </a>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>

                                                            </li>
                                                        </a>

                                                    @endforeach
                                                </ul>
                                                @endif
                                                </li>
                                        </a>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        @endif
                    </a>
                    @endforeach
        </ul>
    </nav>

        <div class="cart">
            <a href="cart"><img src="images/cart.png" width="30px" height="30px" alt=""></a>
            @if(sizeof(\Gloudemans\Shoppingcart\Facades\Cart::content()) >0)
            <span class="number">{{\Gloudemans\Shoppingcart\Facades\Cart::count()}}</span>
            @endif
        </div>
    <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
</div>
