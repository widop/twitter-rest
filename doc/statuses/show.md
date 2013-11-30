# Statuses Show Request

Returns a single Tweet, specified by the id parameter.

``` php
use Widop\Twitter\Rest\Statuses\StatusesShowRequest;

$request = new StatusesShowRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$request->setIncludeMyRetweet(true);
$includeMyRetweet = $request->getIncludeMyRetweet();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$tweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/statuses/show/%3Aid).
