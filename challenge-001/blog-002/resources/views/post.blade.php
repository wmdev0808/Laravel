<x-layout>
    <article>
        <h1> {{ $post->title }}</h1>
       
        <div>
            <!-- <?= $post->body; ?> -->
            <!-- {{ $post->body }} -->
            {!! $post->body !!}
        </div>
    </article>

    <a href="/">Go Back</a>
</x-layout>