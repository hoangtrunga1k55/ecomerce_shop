@extends('admin.layout.index')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Simple Tables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Simple Tables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="panel-body">
                            @if(count($errors)>0)
                                <div class="alert alert-danger">
                                    @foreach($errors->all() as $err)
                                        {{$err}} <br>
                                    @endforeach
                                </div>
                            @endif
                            @if(session('message'))
                                <div class="alert alert-success">
                                    {{session('message')}}
                                </div>
                            @endif
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Quick Example</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="admin/product/add" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Name</label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                               placeholder="Enter Title" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Price</label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                               placeholder="Enter Title" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName1">Stock</label>
                                        <input type="text" class="form-control" id="exampleInputName1"
                                               placeholder="Enter Title" name="stock">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                               placeholder="Enter Decription" name="description">
                                    </div>
                                    <input type="file" name="image">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Active</label>
                                        <input type="text" class="form-control" id="exampleInputEmail1"
                                               placeholder="Enter Decription" name="active">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <ul id="MenuItems" style="list-style-type: none;">
                                            @foreach($menus as $menu)
                                                @if($menu->idParent ==0)
                                                        <li><input type="checkbox" name="idMenu[]" value="{{$menu->id}}"> <span>{{$menu->name}}</span>
                                                            <?php $subMenu = \App\Menu::all()->where('idParent', '=', $menu->id) ?>
                                                            @if($subMenu->count() >0)
                                                                <ul class="sub" style="list-style-type: none;">
                                                                    @foreach($subMenu as $sub)
                                                                            <li><input type="checkbox" name="idMenu[]" value="{{$sub->id}}"> <span>{{$sub->name}}</span>
                                                                                <?php $subMenu = \App\Menu::all()->where('idParent', '=', $sub->id) ?>
                                                                                @if($subMenu->count() >0)
                                                                                    <ul class="sub" style="list-style-type: none;">
                                                                                        @foreach($subMenu as $sub)
                                                                                                <li><input type="checkbox" name="idMenu[]" value="{{$sub->id}}"> <span>{{$sub->name}}</span>
                                                                                                    <?php $subMenu = \App\Menu::all()->where('idParent', '=', $sub->id) ?>
                                                                                                    @if($subMenu->count()>0)
                                                                                                        <ul class="sub">
                                                                                                            @foreach($subMenu as $sub)
                                                                                                                    <li><input type="checkbox" name="idMenu[]" value="{{$sub->id}}" > <span>{{$sub->name}}</span></li>
                                                                                                            @endforeach
                                                                                                        </ul>
                                                                                                    @endif
                                                                                                </li>

                                                                                                </li>

                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </li>
                                                        @endif
                                                    @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
