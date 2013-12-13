# Lists Members Create All Request

Adds multiple members to a list, by specifying a comma-separated list of member ids or screen names. The authenticated
user must own the list to be able to add members to it. Note that lists can't have more than 5,000 members, and you are
limited to adding up to 100 members to a list at a time with this method.

Please note that there can be issues with lists that rapidly remove and add memberships. Take care when using these
methods such that you are not too rapidly switching between removals and adds on the same list.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id. You also have to provide a list of user ids or screen names.

``` php
use Widop\Twitter\Rest\Lists\ListsMembersCreateAllRequest;

$request = new ListsMembersCreateAllRequest();

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

$request->setUserId('123546789,123456,987654321');
$userIds = $request->getUserId();

$request->setScreenName('noradio,twitter,twitterapi');
$screenNames = $request->getScreenName();

$twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/lists/members/create_all).
