# Direct Messages Destroy Request

Destroys the direct message specified in the required ID parameter.

``` php
use Widop\Twitter\Rest\DirectMessages\DirectMessagesDestroyRequest;

$request = new DirectMessagesDestroyRequest('123456879');

$request->setId('123456789');
$messageId = $request->getId();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$message = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/direct_messages/destroy).
