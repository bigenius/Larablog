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
                        Deleted users
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Deleted</th>
                            <th>Restore</th>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td><a href="{{route('lb-admin.user.edit', [$user->id]) }}">{{$user->name}}</a></td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->deleted_at}}</td>
                                    <td>

                                        <a href="{{ route('restoreuser', [$user->id]) }}" class="confirmable"
                                           data-confirm-title="{{ trans('strings.confirm_title') }}"
                                           data-confirm-message="{{ trans('strings.confirm_restore') }}"
                                           data-confirm-ok="{{ trans('strings.restore') }}"
                                           data-confirm-cancel="{{ trans('strings.confirm_cancel') }}"
                                           data-confirm-style="danger">
                                            <i class="fa fa-undo"></i>
                                        </a>

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
