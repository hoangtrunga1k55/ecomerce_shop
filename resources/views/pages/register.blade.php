@extends('layout.index')
@section('content')
<div class="container">
    @include('layout.nav')
</div>
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="images/image1.png" width="100%" alt="">
            </div>
            <div class="col-2">
                <div class="panel-body">
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}} <br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('messeage'))
                        <div class="alert alert-danger">
                            {{session('messeage')}}
                        </div>
                    @endif
                </div>
                <div class="form-container">
                    <div class="form-btn">
                        <span id="login">Login</span>
                        <span id="register">Register</span>
                        <hr id="Indicator">
                    </div>
                    <form action="login" id="Loginform" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="email" placeholder="Email" name="email">
                        <input type="password" placeholder="Password" name="password">
                        <button type="submit" class="btn">Login</button>
                        <a href="">Forget password</a>
                    </form>
                    <form action="register" id="RegForm" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="text" placeholder="Username" name="name">
                        <input type="email" placeholder="Email" name="email">
                        <input type="password" placeholder="Password" name="password">
                        <button type="submit" class="btn">Register</button>
                        <a href="">Forget password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- js for toggel menu -->
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

    <!-- js toogle Form -->
    <script>
        var LoginForm = document.getElementById('Loginform');
        var RegForm = document.getElementById('RegForm');
        var Indicator = document.getElementById('Indicator');
        $ ('#register').click(function () {
            RegForm.style.transform = "tranSlateX(0px)";
            LoginForm.style.transform = "tranSlateX(0px)";
            Indicator.style.transform = "tranSlateX(100px)";
        });
        $ ('#login').click(function () {
            RegForm.style.transform = "tranSlateX(300px)";
            LoginForm.style.transform = "tranSlateX(300px)";
            Indicator.style.transform = "tranSlateX(0px)";
        });
    </script>
@endsection
