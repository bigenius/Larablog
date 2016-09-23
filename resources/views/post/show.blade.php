@extends('layouts.app')

@section('body-class'){{ 'post-show' }}@endsection
@push('scripts')

<script>
    hljs.initHighlightingOnLoad();
</script>
@endpush
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <article id="article-{{$post->id}}">
                    <h2 class="post-title">{{$post->title}}</h2>
                    <div class="post-body">
                        {!! $post->body !!}
                    </div>
                    <div class="post-meta">
                        <ul class="list-inline">
                            <li class="cp-date-single"><span class="fa fa-clock-o"></span>{{\App\Helpers\Helper::fancyDate($post->published_at)}}</li>
                            <li class="category"><span class="fa fa-folder-o"></span>
                                @foreach($post->categories as $category)
                                    <a href="{{ url('category',$category->slug)}}">{{$category->title}}</a>
                                    {{Helper::appendComma($post->categories,$category)}}
                                @endforeach
                            </li>

                        </ul>
                    </div>
                </article>
                @include('comment.list')
            </div>
        </div>
    </div>
@endsection
