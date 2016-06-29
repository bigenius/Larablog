@extends('admin.layout')

@push('scripts')
<script src="/vendor/midium/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('body', {
        extraPlugins: 'codesnippet',
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
        skin: 'minimalist'
    });
</script>
@include('admin.page.slug-script')

@endpush

@section('body-class'){{ 'post-create' }}@endsection

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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New page</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('lb-admin.page.store')}}">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Title</label>

                                        <div class="col-md-12">
                                            <input id="post-title" type="text" class="form-control" name="title"
                                                   value="{{ old('title') }}">

                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                            <p class="text-muted small"><em>Slug: <span id="slug"></span></em></p>
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Body</label>

                                        <div class="col-md-12">

                                            <textarea class="form-control" rows="10"
                                                      name="body">{{ old('body') }}</textarea>
                                            @if ($errors->has('body'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>



                                </div>
                                <aside class="col-md-3">
                                    <div class="">

                                        <div class="row form-group">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-btn fa-check"></i>Create
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
