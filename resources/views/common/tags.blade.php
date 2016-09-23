<div class="sidebar-widget">
    <h3>Tags</h3>
    <ul>
        @foreach( $tags as $tag)
            <li><a href="{{ url('tag', $tag->slug) }}">{{ $tag->title }}</a></li>
        @endforeach
    </ul>
</div>
