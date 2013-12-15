# Lists Subscribers Request

Returns the subscribers of the specified list. Private list subscribers will only be shown if the authenticated user
owns the specified list.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id.

``` php
use Widop\Twitter\Rest\Lists\ListsSubscribersRequest;

$request = new ListsSubscribersRequest();

$request->setOwnerScreenName('noradio');
$ownerScreenName = $request->getOwnerScreenName();

$request->setOwnerId('123456789');
$ownerId = $request->getOwnerId();

$request->setListId('123456789');
$listId = $request->getListId();

$request->setSlug('mama-mia');
$listSlug = $request->getSlug();

$request->setCursor('0123456789');
$cursor = $request->getScreenName();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$cursoredList = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/subscribers).
