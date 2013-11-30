# Saved Searches List Request

Returns the authenticated user's saved search queries.

``` php
use Widop\Twitter\Rest\SavedSearches\SavedSearchesListRequest;

$savedSearches = $twitter->send(new SavedSearchesListRequest());
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/saved_searches/list).
