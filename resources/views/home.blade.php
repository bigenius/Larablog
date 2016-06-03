@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Latest articles</div>

                <div class="panel-body">
                    @foreach( $posts as $post)
                        {{$post->title}}

                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@endsection
