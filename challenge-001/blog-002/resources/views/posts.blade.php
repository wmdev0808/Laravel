<x-layout>
    @foreach ($posts as $post)
            
        <article class="{{ $loop->even ? 'foobar' : '' }}">
            <h1>
                <a href="/posts/{{ $post->id }}">
                    {!! $post->title !!}
                </a>
            </h1>

            <div>
                <!-- <?= $post->excerpt ?> -->
                <!-- <?php echo $post->excerpt ?> -->
                <!-- In Blade syntax -->
                {{ $post->excerpt }}
            </div>
        </article>
    @endforeach
</x-layout>