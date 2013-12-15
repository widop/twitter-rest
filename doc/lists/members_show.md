# Lists Members Show Request

Check if the specified user is a member of the specified list.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id.

``` php
use Widop\Twitter\Rest\Lists\ListsMembersShowRequest;

$request = new ListsMembersShowRequest();

$request->setOwnerScreenName('noradio');
$ownerScreenName = $request->getOwnerScreenName();

$request->setOwnerId('123456789');
$ownerId = $request->getOwnerId();

$request->setListId('123456789');
$listId = $request->getListId();

$request->setSlug('mama-mia');
$listSlug = $request->getSlug();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$members = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/members/show).
