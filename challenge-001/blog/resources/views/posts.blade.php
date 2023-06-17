<!DOCTYPE html>
<html>
    <head>
        <title>My Blog</title>
        <link rel="stylesheet" href="/app.css">
    </head>
    

    <body>
        <?php foreach ($posts as $post): ?>
            <article>
                <h1>
                    <a href="/posts/<?= $post->slug; ?>">
                        <?= $post->title ?>
                    </a>
                </h1>

                <div>
                    <?= $post->excerpt ?>
                </div>
            </article>
        <?php endforeach; ?>
    </body>
</html>