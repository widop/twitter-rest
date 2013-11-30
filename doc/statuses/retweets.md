# Statuses Show Request

Returns a collection of the 100 most recent retweets of the tweet specified by the id parameter.

``` php
use Widop\Twitter\Rest\Statuses\StatusesRetweetsRequest;

$request = new StatusesRetweetsRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setCount(50);
$count = $request->getCount();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$tweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/statuses/retweets/%3Aid).
