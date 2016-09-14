@extends('admin.layout')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-{{ session('status') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading clearfix">
                        Menus
                        <a class="btn btn-success btn-sm btn-create pull-right" href="{{route('lb-admin.menu.create')}}">New</a><br>
                    </div>

                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Title</th>
                            <th>Pages</th>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td><a href="{{route('lb-admin.menu.edit', [$menu->id]) }}">{{$menu->title}}</a></td>
                                    <td>
                                        {{$menu->pages()->count()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
