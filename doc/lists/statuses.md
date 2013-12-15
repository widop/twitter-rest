# Lists Statuses Request

Returns a timeline of tweets authored by members of the specified list. Retweets are included by default. Use the
include_rts=false parameter to omit retweets.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id.

``` php
use Widop\Twitter\Rest\Lists\ListsStatusesRequest;

$request = new ListsStatusesRequest();

$request->setOwnerScreenName('noradio');
$ownerScreenName = $request->getOwnerScreenName();

$request->setOwnerId('123456789');
$ownerId = $request->getOwnerId();

$request->setListId('123456789');
$listId = $request->getListId();

$request->setSlug('mama-mia');
$listSlug = $request->getSlug();

$request->setSinceId('132456789');
$sinceId = $request->getSinceId();

$request->setCount(50);
$count = $request->getCount();

$request->setMaxId('123456789');
$maxId = $request->getMaxId();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$request->setContributorDetails(true);
$contributorDetails = $request->getContributorDetails();

$request->setIncludeRts(true);
$includeRts = $request->getIncludeRts();

$tweets = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/lists/statuses).
