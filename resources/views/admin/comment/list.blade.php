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
                        Comments
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Comment</th>
                            <th>Author</th>
                            <th>Email</th>
                            <th>Post</th>
                            <th>Date</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>{{$comment->body}}</td>
                                    <td>{{$comment->author_name}}</td>
                                    <td>{{$comment->author_email}}</td>
                                    <td><a href="{{route('lb-admin.post.edit', [$comment->post->id]) }}">{{$comment->post->title}}</a></td>
                                    <td>{{$comment->created_at}}</td>
                                    <td>
                                        <a title="Approve" href="{{ route('approvecomment', $comment->id) }}" type="button" class="btn btn-{{($comment->approved?'default disabled':'success')}}"><i class="fa fa-thumbs-up"></i></a>
                                        <a title="Reject" href="{{ route('rejectcomment', [$comment->id]) }}" class="btn btn-danger pull-left confirmable"
                                           data-confirm-title="{{ trans('strings.confirm_title') }}"
                                           data-confirm-message="{{ trans('strings.confirm_delete') }}"
                                           data-confirm-ok="{{ trans('strings.delete') }}"
                                           data-confirm-cancel="{{ trans('strings.confirm_cancel') }}"
                                           data-confirm-style="danger">
                                            <i class="fa fa-thumbs-down"></i>
                                        </a>

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
