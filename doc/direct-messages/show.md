# Direct Messages Show Request

Returns a single direct message, specified by an id parameter.

``` php
use Widop\Twitter\Rest\DirectMessages\DirectMessagesShowRequest;

$request = new DirectMessagesShowRequest('123456789');

$request->setId('123456789');
$messageId = $request->getId();

$message = $twitter->send($request);
```

You can get more informations [here]https://dev.twitter.com/docs/api/1.1/get/direct_messages/show).
