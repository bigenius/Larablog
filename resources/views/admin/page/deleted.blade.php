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
                        Deleted pages
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped table-responsive">
                            <thead>
                            <th>Title</th>
                            <th>Deleted</th>
                            <th>Restore</th>
                            </thead>
                            <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td><a href="{{route('lb-admin.page.edit', [$page->id]) }}">{{$page->title}}</a></td>
                                    <td>{{$page->deleted_at}}</td>
                                    <td>
                                        <a href="{{ route('restorepage', [$page->id]) }}" class="confirmable"
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
