# Friendships Show Request

Returns detailed information about the relationship between two arbitrary users.

``` php
use Widop\Twitter\Rest\Friendships\FriendshipsShowRequest;

$request = new FriendshipsShowRequest();

$request->setSourceId('123546789');
$sourceId = $request->getSourceId();

$request->setSourceScreenName('raffi');
$sourceScreenName = $request->getSourceScreenName();

$request->setTargetId('1235467890');
$targetId = $request->getTargetId();

$request->setTargetScreenName('noradio');
$targetScreenName = $request->getTargetScreenName();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/friendships/show).
