<x-layout>
    @foreach ($posts as $post)
            
        <article class="{{ $loop->even ? 'foobar' : '' }}">
            <h1>
                <a href="/posts/{{ $post->slug }}">
                    {!! $post->title !!}
                </a>
            </h1>

            <p>
                <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
            </p>

            <div>
                <!-- <?= $post->excerpt ?> -->
                <!-- <?php echo $post->excerpt ?> -->
                <!-- In Blade syntax -->
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach
</x-layout>