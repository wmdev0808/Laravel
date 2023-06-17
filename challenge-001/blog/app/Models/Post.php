<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public function __construct(public $title, public $excerpt, public $date, public $body, public $slug)
    {
    }

    public static function all()
    {
        return collect(File::files(resource_path('posts')))
                ->map(fn ($file) => YamlFrontMatter::parseFile($file))
                ->map(
                    fn ($document) => new Post(
                        $document->title,
                        $document->excerpt,
                        $document->date,
                        $document->body(),
                        $document->slug
                    )
                );
    }

    public static function find($slug)
    {
        // of all the blog posts, find the one with a slug that matches the one that was requested.
        return static::all()->firstWhere('slug', $slug);
    }
}
