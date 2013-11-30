# Blocks Create Request

Blocks the specified user from following the authenticating user. In addition the blocked user will not show in the
authenticating users mentions or timeline (unless retweeted by another user). If a follow or friend relationship exists
it is destroyed.

``` php
use Widop\Twitter\Rest\Blocks\BlocksCreateRequest;

$request = new BlocksCreateRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$request->setCursor('123546789');
$cursor = $request->getCursor();

$user = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/blocks/create).
