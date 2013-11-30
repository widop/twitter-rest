# Saved Searches Show Request

Retrieve the information for the saved search represented by the given id.
The authenticating user must be the owner of saved search ID being requested.

``` php
use Widop\Twitter\Rest\SavedSearches\SavedSearchesShowRequest;

$request = new SavedSearchesShowRequest('123');

$request->setId('123');
$id = $request->getId();

$savedSearch = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/saved_searches/show/%3Aid).
