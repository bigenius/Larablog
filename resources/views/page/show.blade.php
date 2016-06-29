@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <article id="article-{{$page->id}}">
                    <h2 class="post-title">{{$page->title}}</h2>
                    <div class="post-body">
                        {!! $page->body !!}
                    </div>
                    
                </article>
            </div>
        </div>
    </div>
@endsection
