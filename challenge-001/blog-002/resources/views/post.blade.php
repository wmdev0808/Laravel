<x-layout>
    <article>
        <h1> {{ $post->title }}</h1>

       <a href="/categories/{{ $post->category->slug }}">{{ $post->category->name }}</a>
       
        <div>
            <!-- <?= $post->body; ?> -->
            <!-- {{ $post->body }} -->
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>