# Direct Messages Request

Returns the 20 most recent direct messages sent to the authenticating user. Includes detailed information about the
sender and recipient user.

``` php
use Widop\Twitter\DirectMessagesRequest;

$request = new DirectMessagesRequest();

$request->setSinceId('123546789');
$sinceId = $request->getSinceId();

$request->setMaxId('123465789');
$maxId = $request->getMaxId();

$request->setCount(200);
$count = $request->getCount();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$messages = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/direct_messages).
