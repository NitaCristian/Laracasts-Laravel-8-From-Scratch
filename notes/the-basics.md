# How a Route Loads a View

In the routes/web.php you declare every route that your application should respond to.

Declare a route and when the user makes a GET request to the /, run a function, which in this case, loads a view called
"welcome". This view is a blade.php file and can be found in resources/views/welcome.blade.php

# Include CSS and JavaScript

The CSS in the resources/css/app.css will be meant to be used with a bundling tool. They will compile down to the
public/css folder.

# Make a Route and Link to it

Changed the original / route to load a view called posts which shows a bunch of article posts.
Then created a new route called /post which loads a view called post and displays a single post.
For now all articles will link to that post.

# Route Wildcards

You can make a route accept a wildcard by wrapping that wildcard in braces. The value for will be passed as an
argument to the function.

```php
Route::get('/post/{wildcard}', function($slug) {
    // ...
});
```

## Constrains

Because that wildcard can be anything, it will accept values such as "!#?*&%$" and so on.
We can constrain our routes using the `where` method which accepts a slug and a regular expression.

```php
Route::get('/post/{wildcard}', function($slug) {
    // ...
})->where('post', '[A-z_\-]+');
```

Additionally, there are methods to simplify this process such as whereAlpha(), whereNumeric(), whereAlphaNumeric().

# Cache

Our posts are retrieved every time we refresh our page and if 10000 users do this at the same time it will slow down our
application. Instead, we can use caching.

The function needs a unique id for the cached file, how long should it cache it for and a function to return that
thing.

```php
$post = cache()->remember("post.{$slug}", now()->addMinutes(20), function() {
    return file_get_contents($path);
});
```

# Collections

To get all the posts we collect() all the files from a directory of posts and then apply some 
methods to each post. First we map() each post to its parsed version, and each parsed posts will be 
transformed into a Post object.
