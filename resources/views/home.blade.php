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
            <article>
                <h2 class="post-title">{{$post->title}}</h2>
                <div class="post-body">
                    {!! $post->body !!}
                </div>
            </article>
        @endforeach


        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            {!! $posts->links() !!}
        </div>
    </div>
</div>
@endsection
