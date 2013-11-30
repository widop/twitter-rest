# Users Contributors Request

Returns a collection of users who can contribute to the specified account.

``` php
use Widop\Twitter\Rest\Users\UsersContributorsRequest;

$request = new UsersContributorsRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/contributors).
