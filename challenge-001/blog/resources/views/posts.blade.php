<!DOCTYPE html>
<html>
    <head>
        <title>My Blog</title>
        <link rel="stylesheet" href="/app.css">
    </head>
    

    <body>
        @foreach ($posts as $post)
            
            <article class="{{ $loop->even ? 'foobar' : '' }}">
                <h1>
                    <a href="/posts/{{ $post->slug }}">
                        {{ $post->title }}
                    </a>
                </h1>

                <div>
                    <!-- <?= $post->excerpt ?> -->
                    <!-- <?php echo $post->excerpt ?> -->
                    <!-- In Blade syntax -->
                    {{ $post->title }}
                </div>
            </article>
        @endforeach
    </body>
</html>