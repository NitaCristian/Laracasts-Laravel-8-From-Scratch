<!doctype html>

<title>My Blog</title>
<link rel="stylesheet" href="/css/app.css">

<body>
@foreach($posts as $post)
    <article>
        {!! $post !!}
    </article>
@endforeach
</body>
