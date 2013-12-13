# Lists Members Destroy Request

Removes the specified member from the list. The authenticated user must be the list's owner to remove members from the
list.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id. You also have to provide a user id or a screen name.

``` php
use Widop\Twitter\Rest\Lists\ListsMembersDestroyRequest;

$request = new ListsMembersDestroyRequest();

$request->setOwnerScreenName('noradio');
$ownerScreenName = $request->getOwnerScreenName();

$request->setOwnerId('123456789');
$ownerId = $request->getOwnerId();

$request->setListId('123456789');
$listId = $request->getListId();

$request->setSlug('mama-mia');
$listSlug = $request->getSlug();

$request->setCursor('123465789');
$cursor = $request->getCursor();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/lists/members/destroy).
