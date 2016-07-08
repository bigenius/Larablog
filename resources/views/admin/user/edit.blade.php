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
                    <div class="panel-heading">New post</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('lb-admin.user.pass')}}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="_method" value="PUT">

                            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-12 control-label">Title</label>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="title" value="">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>





                            <div class="row form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-user"></i>Save
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
