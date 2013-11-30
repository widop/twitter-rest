# Statuses Retweets Of Me Request

Returns the most recent tweets authored by the authenticating user that have been retweeted by others.

If no count is provided, the request will return 20 tweets.

``` php
use Widop\Twitter\Rest\Statuses\StatusesRetweetsOfMeRequest;

$request = new StatusesRetweetsOfMeRequest();

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

$request->setIncludeUserEntities(true);
$includeUserEntities = $request->getIncludeUserEntities();

$tweets = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/statuses/retweets_of_me).
