@extends('admin.layout')

@push('scripts')
<script src="/vendor/midium/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'body', {
        extraPlugins: 'codesnippet'
    });
</script>
@endpush

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
                              action="{{route('lb-admin.post.store')}}">
                            {!! csrf_field() !!}

                            <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label class="col-md-12 control-label">Title</label>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <label class="col-md-12 control-label">Body</label>

                                <div class="col-md-12">

                                    <textarea class="form-control" rows="10" name="body" >{{ old('body') }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div id="selector" class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Tags</label>

                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="tags">
                                            <span id="status-icon" class="fa form-control-feedback" aria-hidden="true"></span>

                                            @if ($errors->has('tags'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('tags') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-12 control-label">Categories</label>
                                        <div class="col-md-12">
                                            @foreach($categories as $category)
                                                <div class="checkbox">
                                                    <label><input type="checkbox" name="categories[]" value="{{$category->id}}">{{$category->title}}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="row form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary pull-right">
                                        <i class="fa fa-btn fa-user"></i>Create
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
