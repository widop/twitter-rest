# Statuses Show Request

Retweets a tweet. Returns the original tweet with retweet details embedded.

``` php
use Widop\Twitter\Statuses\StatusesRetweetRequest;

$request = new StatusesRetweetRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$tweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/statuses/retweet/%3Aid).
