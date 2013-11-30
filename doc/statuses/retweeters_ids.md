# Statuses Retweeter Ids Request

Returns a collection of up to 100 user IDs belonging to users who have retweeted the tweet specified by the id parameter.

``` php
use Widop\Twitter\Rest\Statuses\StatusesRetweetersIdsRequest;

$request = new StatusesRetweetersIdsRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setCursor('123456789');
$cursor = $request->getCursor();

$request->setStringifyIds(true);
$stringifyIds = $request->getStringifyIds();

$tweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/statuses/retweeters/ids).
