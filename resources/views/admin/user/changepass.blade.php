@extends('admin.layout')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="alert alert-{{ session('status') }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        {{ session('info') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('strings.enter_new_pass') }}</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('updatepass')}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$id or old('id')}}">

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





                            <div class="row form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-user"></i>{{ trans('strings.save') }}
                                    </button>



                                </div>
                            </div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
