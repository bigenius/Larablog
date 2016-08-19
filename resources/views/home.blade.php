@extends('layouts.app')
@push('scripts')

<script>
    hljs.initHighlightingOnLoad();
</script>
@endpush

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

        @foreach( $posts as $post)
            <article id="article-{{$post->id}}">
                <h2 class="post-title"><a href="{{url($post->slug)}}">{{$post->title}}</a></h2>
                <div class="post-body">
                    {!! $post->body !!}
                </div>
                <div class="post-meta">
                    <ul class="list-inline">
                        <li class="cp-date-single"><span class="fa fa-clock-o"></span>{{\App\Helpers\Helper::fancyDate($post->updated_at)}}</li>
                        <li class="category"><span class="fa fa-folder-o"></span>
                            @foreach($post->categories as $category)
                                <a href="cat/{{$category->title}}">{{$category->title}}</a>
                                {{Helper::appendComma($post->categories,$category)}}
                            @endforeach
                        </li>

                    </ul>
                </div>
            </article>
        @endforeach


        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @if(count($posts))
                {!! $posts->links() !!}
            @endif
        </div>
    </div>
</div>
@endsection
