<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/intern.css')}}">
    <title>Document</title>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css'>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>

</head>

<body>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-11 col-sm-9 col-md-7 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2">
            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                <h2 id="heading">Sign Up Your User Account</h2>
                <p>Fill all form field to go to next step</p>
                <form id="msform" action="{{route('post.Data')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Account</strong></li>
                        <li id="personal"><strong>Personal</strong></li>
                        <li id="payment"><strong>Image</strong></li>
                        <li id="confirm"><strong>Finish</strong></li>
                    </ul>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                    </div> <br> <!-- fieldsets -->
                    <fieldset class="fieldset active">
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Account Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 1 - 4</h2>
                                </div>
                            </div>
                            <p class="email_error" style="color:red"></p>
                            <label class="fieldlabels">Email: *</label>
                            <input type="email" name="email" placeholder="Email" class="required" id="email"  />
                            <p class="uname_error" style="color:red"></p>
                            <label class="fieldlabels">Username: *</label>
                            <input type="text" name="uname" placeholder="UserName" required id="uname" />
                            <label class="fieldlabels">Password: *</label>
                            <p class="password_error" style="color:red"></p>
                            <input type="password" name="pwd" placeholder="Password" required id="password" />
                            {{--<label class="fieldlabels">Confirm Password: *</label> --}}
                            {{--<input type="password" name="cpwd" placeholder="Confirm Password" />--}}
                        </div> <input type="button" name="next" class="next action-button" value="Next" />
                    </fieldset>
                    <fieldset class="fieldset">
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Personal Information:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 2 - 4</h2>
                                </div>
                            </div>
                            <p class="fname_error" style="color:red"></p>
                            <label class="fieldlabels">First Name: *</label>
                            <input type="text" name="fname" placeholder="First Name"id="fname" />
                            <p class="lname_error" style="color:red"></p>
                            <label class="fieldlabels">Last Name: *</label>
                            <input type="text" name="lname" placeholder="Last Name" id="lname" />
                            <p class="address_error" style="color:red"></p>
                            <label class="fieldlabels">Address: *</label>
                            <input type="text" name="address" placeholder="Please enter your address" id="address" />
                            <p class="colleges_error" style="color:red"></p>
                            <label class="fieldlabels">Colleges: *</label>
                            <input type="text" name="colleges" placeholder="Please enter your Colleges" id="colleges" />

                        </div> <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset class="fieldset">
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Image Upload:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 3 - 4</h2>
                                </div>
                            </div>
                            <p class="img_error" style="color:red"></p>
                            <label class="fieldlabels">Upload Your Photo:</label>
                            <input type="file" name="img" accept="image/*" id="img" required>
                        </div> <input type="submit" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    </fieldset>
                    <fieldset>
                        <div class="form-card">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="fs-title">Finish:</h2>
                                </div>
                                <div class="col-5">
                                    <h2 class="steps">Step 4 - 4</h2>
                                </div>
                            </div> <br><br>
                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                            <div class="row justify-content-center">
                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                            </div> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-7 text-center">
                                    <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/intern.js')}}"></script>

</html>