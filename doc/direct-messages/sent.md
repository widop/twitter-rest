# Direct Messages New Request

Returns the 20 most recent direct messages sent to the authenticating user.

``` php
use Widop\Twitter\DirectMessages\DirectMessagesSentRequest;

$request = new DirectMessagesSentRequest();

$request->setSinceId('132456789');
$sinceId = $request->getSinceId();

$request->setCount(50);
$count = $request->getCount();

$request->setMaxId('123456789');
$maxId = $request->getMaxId();

$request->setPage(42);
$page = $request->getPage();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$messages = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/direct_messages/sent).
