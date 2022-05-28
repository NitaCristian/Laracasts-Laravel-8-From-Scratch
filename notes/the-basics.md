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
