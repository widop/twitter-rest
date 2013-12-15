# Lists Destroy Request

Deletes the specified list.
The authenticated user must own the list to be able to destroy it.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id.

``` php
use Widop\Twitter\Rest\Lists\ListsDestroyRequest;

$request = new ListsDestroyRequest();

$request->setOwnerScreenName('noradio');
$ownerScreenName = $request->getOwnerScreenName();

$request->setOwnerId('123456789');
$ownerId = $request->getOwnerId();

$request->setListId('123456789');
$listId = $request->getListId();

$request->setSlug('mama-mia');
$listSlug = $request->getSlug();

$list = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/lists/destroy).
