<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/r/bs-3.3.5/jq-2.1.4,dt-1.10.8/datatables.min.css"/>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/r/bs-3.3.5/jqc-1.11.3,dt-1.10.8/datatables.min.js"></script>

</head>
<style>
    .alert-message {
        color: red;
    }
</style>
<body>

<div class="container">
    <h2 style="margin-top: 12px;" class="alert alert-success">Ajax CRUD with Laravel App -
        <a href="https://www.codingdriver.com" target="_blank">CodingDriver</a>
    </h2><br>
    <div class="row">
        <div class="col-12 text-right">
            <a href="javascript:void(0)" class="btn btn-success mb-3" id="create-new-post" onclick="addPost()">Add
                Post</a>
        </div>
    </div>
    <div class="row" style="clear: both;margin-top: 18px;">
        <div class="col-12">
            <table id="laravel_crud" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Img</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($responses as $response)
                    @foreach($response as $api)
                        <tr id="row_{{$api->id}}">
                            <td>{{ $api->id  }}</td>
                            <td><img src="{{$api->img}}" width="50px" height="50px" alt=""></td>
                            <td>{{ $api->name }}</td>
                            <td>{{ $api->email }}</td>
                            <td><a href="javascript:void(0)" data-id="{{ $api->id }}" onclick="editPost(event.target)"
                                   class="btn btn-info">Edit</a></td>
                            <td>
                                <a href="javascript:void(0)" data-id="{{ $api->id }}" class="btn btn-danger"
                                   onclick="deleteUser(event.target)">Delete</a></td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="post-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form name="userForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" id="post_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="title" placeholder="Enter Name">
                            <span id="titleError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Email</label>
                        <div class="col-sm-12">
                        <textarea class="form-control" id="email" name="description" placeholder="Enter Email" rows="4"
                                  cols="50">
                        </textarea>
                            <span id="descriptionError" class="alert-message"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2">Img</label>
                        <div class="col-sm-12">
                            <img width="50px" height="50px" src="" id="img" alt="your image">
                        </div>
                        <input type="file" id="file" name="file" onChange="img_pathUrl(this);">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="createPost()">Save</button>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function createPost() {
        var name = $('#name').val(),
             email = $('#email').val();
        var id = $('#post_id').val();
        var files = $("#file")[0].files[0];
        var _url = "post";
        var _token = $('meta[name="csrf-token"]').attr('content');
        var fd = new FormData();
        fd.append('id', id);
        fd.append('name', name);
        fd.append('email', email);
        fd.append('file', files);
        fd.append('_token',_token);
        $.ajax({
            url: _url,
            type: "post",
            cache:true,
            data: fd,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response==0) {
                    alert('cant upload');
                    $('#post-modal').modal('hide');
                }
                else if (response==1) {
                    alert('just allow file jpg png');
                    $('#post-modal').modal('hide');
                }
                else{
                    if (id != "") {
                        $("#row_" + id + " td:nth-child(2)").html('<img src="'+response.data.img+'"height="100px width="100px>');
                        $("#row_" + id + " td:nth-child(3)").html(response.data.name);
                        $("#row_" + id + " td:nth-child(4)").html(response.data.email);
                    } else {
                        $('table tbody').prepend('<tr id="row_' + response.data.id + '">' +
                            '<td>' + response.data.id + '</td>' +
                            '<td>'+'<img src="'+response.data.img+'"height="100px width="100px>'+
                            '<td>' + response.data.name + '</td><td>' + response.data.email + '</td>' +
                            '<td><a href="javascript:void(0)" data-id="' + response.data.id + '" onclick="editPost(event.target)" class="btn btn-info">Edit</a></td><td><a href="javascript:void(0)" data-id="' + response.data.id + '" class="btn btn-danger" onclick="deleteUser(event.target)">delete</a></td></tr>');
                    }
                    $('#name').val('');
                    $('#email').val('');
                    $('#post-modal').modal('hide');
                }
            }
            // error: function(response) {
            //     $('#titleError').text(response.responseJSON.errors.name);
            //     $('#descriptionError').text(response.responseJSON.errors.email);
            // }
        });
    }
    function img_pathUrl(input){
        $('#img')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
    }

    // function ChangeImg() {
    //     var _token = $('meta[name="csrf-token"]').attr('content');
    //     var fd = new FormData();
    //     var files = $("#file")[0].files[0];
    //     var _url = "xxx";
    //     fd.append('file', files);
    //     fd.append('_token',_token);
    //
    //     $.ajax({
    //         url: _url,
    //         type: 'post',
    //         data:fd,
    //         processData: false,
    //         contentType: false,
    //         success: function (response) {
    //             console.log(response);
    //             $("#img").attr("src",response);
    //         }
    //     });
    // }


    $('#laravel_crud').DataTable();

    function addPost() {
        $("#post_id").val('');
        $('#post-modal').modal('show');
    }

    function editPost(event) {
        var id = $(event).data("id");
        var _url = "edit/" + id;
        $('#titleError').text('');
        $('#descriptionError').text('');
        $.ajax({
            url: _url,
            type: "get",
            success: function (response) {
                if (response) {
                    $("#post_id").val(response.data.id);
                    $("#name").val(response.data.name);
                    $("#email").val(response.data.email);
                    // $("#img").attr('src', response.data.img);
                    $('#post-modal').modal('show');
                }
            }
        });
    }
    function deleteUser(event) {
        var id = $(event).data("id");
        var _url = "delete/" + id;
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: _url,
            type: 'delete',
            data: {
                _token: _token
            },
            success: function (response) {
                $("#row_" + id).remove();
            }
        });
    }
</script>
</html>