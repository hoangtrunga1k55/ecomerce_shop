<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RedStore| Ecommerce Website Design</title>
    <link rel="stylesheet" href="{{asset('css/styles-admin.css')}}">
    <link href="https://fonts.googleapis.com/css2?f amily=Alata&family=Oswald:wght@200;300;400;500&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
<div class="account-page">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="../images/image1.png" width="100%" alt="">
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
                        <hr id="Indicator">
                    </div>
                    <form action="login" id="Loginform" method="post">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="email" placeholder="Username" name="email">
                        <input type="password" placeholder="Password" name="password">
                        <button type="submit" class="btn">Login</button>
                        <a href="">Forget password</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
