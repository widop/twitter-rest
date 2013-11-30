# Blocks Destroy Request

Un-blocks the user specified in the ID parameter for the authenticating user. Returns the un-blocked user in the
requested format when successful. If relationships existed before the block was instated, they will not be restored.

``` php
use Widop\Twitter\Rest\Blocks\BlocksDestroyRequest;

$request = new BlocksDestroyRequest();

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

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/blocks/destroy).
