<?php

namespace App\Models;

use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post {

    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    /**
     * @param $title
     * @param $excerpt
     * @param $date
     * @param $body
     * @param $slug
     */
    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function find($slug)
    {
        // Get all the posts and find the first one with the matching slug
        return static::all()->firstWhere('slug', $slug);
    }

    public static function all()
    {
        // Cache forever all the posts with the key 'posts.all' and return them
        return cache()->rememberForever('posts.all', function () {
            // Create a collection of files from a given path
            return collect(File::files(resource_path("posts")))
                // Parse each file using YamlFrontMatter
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                // Create a new post out of each document
                ->map(fn($document) => new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
                ))
                // Sort the collection in descending order by date
                ->sortByDesc('date');
        });
    }
}
