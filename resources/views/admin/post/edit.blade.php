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
@include('admin.post.slug-script')

@endpush

@section('body-class'){{ 'post-edit' }}@endsection

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
                    <div class="panel-heading">New post</div>
                    <div class="panel-body">
                        <form class="form" role="form" method="POST"
                              action="{{route('lb-admin.post.update', $post->id)}}">
                            {!! csrf_field() !!}

                            <input type="hidden" name="_method" value="PUT">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="row form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Title</label>

                                        <div class="col-md-12">
                                            <input id="post-title" type="text" class="form-control" name="title"
                                                   value="{{ $post->title }}">

                                            @if ($errors->has('title'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                            @endif
                                            <p class="text-muted small" id="slug"><em>Slug: <span
                                                            id="slug">{{$post->slug}}</span></em></p>
                                        </div>
                                    </div>

                                    <div class="row form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                        <label class="col-md-12 control-label">Body</label>

                                        <div class="col-md-12">

                                            <textarea class="form-control" rows="10"
                                                      name="body">{!! $post->body !!} </textarea>
                                            @if ($errors->has('body'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6">

                                        </div>
                                    </div>
                                </div>
                                <aside class="col-md-3">
                                    <div class="">

                                        <div class="row">
                                            <div class="col-md-12  well well-sm">
                                                @include('admin.post.publish-picker')
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 well well-sm">
                                                <div id="selector"
                                                     class="form-group{{ $errors->has('tags') ? ' has-error' : '' }}">
                                                    <label class="col-md-12 control-label">Tags</label>

                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control" name="tags"
                                                               value="{{$tags}}">
                                                    <span id="status-icon" class="fa form-control-feedback"
                                                          aria-hidden="true"></span>

                                                        @if ($errors->has('tags'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('tags') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 well well-sm">
                                                <div class="form-group">
                                                    <label class="col-md-12 control-label">Categories</label>
                                                    <div class="col-md-12">
                                                        @foreach($categories as $category)
                                                            <div class="checkbox">
                                                                <label><input type="checkbox" name="categories[]"
                                                                              {{ ($post->categories->contains($category->id)?'checked="checked"':'') }} value="{{$category->id}}">{{$category->title}}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group ">
                                            <div class="col-md-12  well well-sm">
                                                <button type="submit" class="btn btn-primary pull-right">
                                                    <i class="fa fa-btn fa-check"></i>Save
                                                </button>
                                                <a href="{{ route('destroypost', [$post->id]) }}" class="btn btn-danger pull-left confirmable"
                                                   data-confirm-title="{{ trans('strings.confirm_title') }}"
                                                   data-confirm-message="{{ trans('strings.confirm_delete') }}"
                                                   data-confirm-ok="{{ trans('strings.delete') }}"
                                                   data-confirm-cancel="{{ trans('strings.confirm_cancel') }}"
                                                   data-confirm-style="danger">
                                                    <i class="fa fa-btn fa-trash"></i>Delete
                                                </a>
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
