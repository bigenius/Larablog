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
                        Users
                        <a class="btn btn-success btn-sm btn-create pull-right" href="{{route('lb-admin.user.create')}}"><i class="fa fa-btn fa-plus"></i>New</a><br>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Updated</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="{{route('lb-admin.user.edit', [$user->id]) }}">{{$user->name}}</a></td>
                                    <td><a href="{{route('lb-admin.user.edit', [$user->id]) }}">{{$user->email}}</a></td>
                                    <td>{{ $user->updated_at->diffForHumans() }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <p><a href="{{ route('deletedusers') }}">Deleted users</a></p>
            </div>
        </div>
    </div>
@endsection
