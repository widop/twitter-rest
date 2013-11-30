# Users Spam Report Request

Report the specified user as a spam account to Twitter.
Additionally performs the equivalent of POST blocks/create on behalf of the authenticated user.

``` php
use Widop\Twitter\Rest\Users\UsersSpamReportRequest;

$request = new UsersSpamReportRequest();

$request->setUserId('132456789');
$userId = $request->getUserid();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$user = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/users/report_spam).
