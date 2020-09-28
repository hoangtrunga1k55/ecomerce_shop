<div class="fnav">
    <ul class="active">
        @if(!Auth::check())
        <li class="default">
            <ul>
                <li>Default</li>
                <li><a href="login">Sign in</a></li>
                <li><a href="register">Create an account</a></li>
            </ul>
        </li>
        @else
        <li>Welcome {{Auth::user()->name}}
            <ul class="sub">
                <li><a href="myaccount">My Account</a></li>
                <li><a href="myorder">My Order</a></li>
                <li><a href="wishlist">My Wishlist</a></li>
                <li><a href="logout">Log out</a></li>
            </ul>
        </li>
        @endif
    </ul>
</div>
