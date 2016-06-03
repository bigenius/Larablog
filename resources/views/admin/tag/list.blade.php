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
                        Categories
                        <a class="btn btn-success btn-sm btn-create pull-right" href="{{route('lb-admin.tag.create')}}">New</a><br>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Title</th>
                            <th>Posts</th>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td><a href="{{route('lb-admin.tag.edit', [$tag->id]) }}">{{$tag->title}}</a></td>
                                    <td>
                                        <a href="{{route('lb-admin.tag.show', [$tag->id]) }}">{{$tag->posts()->count()}}</a>
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
