# Direct Messages New Request

Sends a new direct message to the specified user from the authenticating user.

``` php
use Widop\Twitter\Rest\DirectMessages\DirectMessagesNewRequest;

$request = new DirectMessagesNewRequest('My direct message');

$request->setUserId('123456789');
$userId = $request->getText();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setText('My message');
$text = $request->getText();

$message = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/direct_messages/new).
