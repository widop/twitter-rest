# Statuses User Timeline Request

Returns the tweets of a user's timeline, specified by a user id or a screen name.

If no count is provided, the `send` method will return up to 200 tweets.
You MUST also provide either a user id or a screen name. If both screen name and user id parameters are provided, the
user id is prefered and used.

``` php
use Widop\Twitter\Statuses\StatusesUserTimelineRequest;

$request = new StatusesUserTimelineRequest();

$request->setUserId('123465789');
$userId = $request->getUserId();

$request->setScreenName('widop');
$screenName = $request->getScreenName();

$request->setSinceId('132456789');
$sinceId = $request->getSinceId();

$request->setCount(50);
$count = $request->getCount();

$request->setMaxId('123456789');
$maxId = $request->getMaxId();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$request->setExcludeReplies(true);
$excludeReplies = $request->getExcludeReplies();

$request->setContributorDetails(true);
$contributorDetails = $request->getContributorDetails();

$request->setIncludeRts(true);
$includeRts = $request->getIncludeRts();

$tweets = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline).
