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
                    <div class="panel-heading">New user</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('lb-admin.user.store')}}">
                            {!! csrf_field() !!}

                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Name</label>

                                        <div class="col-md-6">
                                            <input id="post-title" type="text" class="form-control" name="name"
                                                   value="{{ old('name') }}">

                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Email</label>

                                        <div class="col-md-6">

                                            <input class="form-control" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">{{trans('strings.password') }}</label>

                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">{{trans('strings.repeat_password') }}</label>

                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password_confirmation">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                </div>
                                <aside class="col-md-3">
                                    <div class="">
                                        <div class="row form-group ">
                                            <div class="col-md-12 clearfix well well-sm">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-btn fa-check"></i>{{ trans('strings.save') }}
                                                </button>

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
