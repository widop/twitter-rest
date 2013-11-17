# Saved Searches Create Request

Create a new saved search for the authenticated user. A user may only have 25 saved searches.

``` php
use Widop\Twitter\SavedSearches\SavedSearchesCreateRequest;

$request = new SavedSearchesCreateRequest('123');

$request->setQuery('123');
$query = $request->getQuery();

$savedSearch = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/saved_searches/create).
