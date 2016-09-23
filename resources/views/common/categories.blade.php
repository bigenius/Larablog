<div class="sidebar-widget">
    <h3>Categories</h3>
    <ul>
        @foreach( $categories as $category)
            <li><a href="{{ url('category', $category->slug) }}">{{ $category->title }}</a></li>
        @endforeach
    </ul>
</div>
