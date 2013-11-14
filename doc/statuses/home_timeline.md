# Statuses Home Timeline Request

Returns the authenticated user's tweets and retweets.

If no count is provided, the request will return 20 tweets.

``` php
use Widop\Twitter\Statuses\StatusesHomeTimelineRequest;

$request = new StatusesHomeTimelineRequest();

$request->setCount(50);
$count = $request->getCount();

$request->setSinceId('132456789');
$sinceId = $request->getSinceId();

$request->setMaxId('123456789');
$maxId = $request->getMaxId();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$request->setExcludeReplies(true);
$excludeReplies = $request->getExcludeReplies();

$request->setContributorDetails(true);
$contributorDetails = $request->getContributorDetails();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$tweets = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/statuses/home_timeline).
