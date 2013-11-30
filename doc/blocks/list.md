# Blocks List Request

Returns a collection of user objects that the authenticating user is blocking.

``` php
use Widop\Twitter\Blocks\BlocksListRequest;

$request = new BlocksListRequest();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$request->setCursor('123546789');
$cursor = $request->getCursor();

$usersBlocked = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/blocks/ids).
