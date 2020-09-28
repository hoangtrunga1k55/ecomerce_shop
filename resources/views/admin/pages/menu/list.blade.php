@extends('admin.layout.index')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>menu</h1>
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
                <ul id="MenuItems">
                    @foreach($menus as $menu)
                        @if($menu->idParent ==0)
                            <a href="admin/menu/edit/{{$menu->id}}">
                                <li>{{$menu->name}}
                                    <?php $subMenu = \App\Menu::all()->where('idParent', '=', $menu->id) ?>
                                    @if(isset($subMenu))
                                        <ul class="sub">
                                            @foreach($subMenu as $sub)
                                                <a href="admin/menu/edit/{{$sub->id}}">
                                                    <li>{{$sub->name}}</li>
                                                    <?php $subMenu = \App\Menu::all()->where('idParent', '=', $sub->id) ?>
                                                    @if(isset($subMenu))
                                                        <ul class="sub">
                                                            @foreach($subMenu as $sub)
                                                                <a href="admin/menu/edit/{{$sub->id}}">
                                                                    <li>{{$sub->name}}
                                                                        <?php $subMenu = \App\Menu::all()->where('idParent', '=', $sub->id) ?>
                                                                        @if(isset($subMenu))
                                                                            <ul class="sub">
                                                                                @foreach($subMenu as $sub)
                                                                                    <a href="admin/menu/edit/{{$sub->id}}">
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
            </div>
        </section>
    </div>
    </div>
@endsection

