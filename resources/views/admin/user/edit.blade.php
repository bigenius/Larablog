@extends('admin.layout')


@section('body-class'){{ 'user-edit' }}@endsection

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row">
                <div class="col-md-12 ">
                    <div class="alert alert-{{ session('status') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit user</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('lb-admin.user.update', $user->id)}}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Name</label>

                                        <div class="col-md-12">
                                            <input id="post-title" type="text" class="form-control" name="name"
                                                   value="{{ $user->name }}">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Email</label>

                                        <div class="col-md-12">

                                            <input class="form-control" name="email" value="{{ $user->email }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @unless( $user->trashed())
                                        <div class="row form-group">
                                            <div class="col-md-6">
                                                <a href="{{ route('changepass', [$user->id]) }}" class="changepass">Change Password
                                                </a>
                                            </div>
                                            <div class="col-md-6">

                                            </div>
                                        </div>
                                    @endunless
                                </div>
                                <aside class="col-md-3">
                                    <div class="">
                                        <div class="row form-group ">
                                            <div class="col-md-12 clearfix well well-sm">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-btn fa-check"></i>{{ trans('strings.save') }}
                                                </button>
                                                @if ($user->trashed())
                                                    <a href="{{ route('restoreuser', [$user->id]) }}" class="btn btn-danger pull-left confirmable"
                                                       data-confirm-title="{{ trans('strings.confirm_title') }}"
                                                       data-confirm-message="{{ trans('strings.confirm_restore') }}"
                                                       data-confirm-ok="{{ trans('strings.restore') }}"
                                                       data-confirm-cancel="{{ trans('strings.confirm_cancel') }}"
                                                       data-confirm-style="danger">
                                                        <i class="fa fa-btn fa-trash"></i>{{ trans('strings.restore') }}
                                                    </a>

                                                @else

                                                    <a href="{{ route('destroyuser', [$user->id]) }}" class="btn btn-danger pull-left confirmable"
                                                       data-confirm-title="{{ trans('strings.confirm_title') }}"
                                                       data-confirm-message="{{ trans('strings.confirm_delete') }}"
                                                       data-confirm-ok="{{ trans('strings.delete') }}"
                                                       data-confirm-cancel="{{ trans('strings.confirm_cancel') }}"
                                                       data-confirm-style="danger">
                                                        <i class="fa fa-btn fa-trash"></i>{{ trans('strings.delete') }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>


                                </aside>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
