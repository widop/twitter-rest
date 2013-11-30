# Saved Searches Destroy Request

Destroys a saved search for the authenticating user.
The authenticating user must be the owner of saved search id being destroyed.

``` php
use Widop\Twitter\Rest\SavedSearches\SavedSearchesDestroyRequest;

$request = new SavedSearchesDestroyRequest('123');

$request->setId('123');
$id = $request->getId();

$savedSearchDestroyed = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/saved_searches/destroy/%3Aid).
