# Blocks Ids Request

Returns an array of numeric user ids the authenticating user is blocking.

``` php
use Widop\Twitter\Blocks\BlocksIdsRequest;

$request = new BlocksIdsRequest();

$request->setStringifyIds(true);
$stringifyIds = $request->getStringifyIds();

$request->setCursor('123546789');
$cursor = $request->getCursor();

$usersBlockedIds = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/blocks/ids).
