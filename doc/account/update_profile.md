# Account Update Profile Request

Sets values that users are able to set under the "Account" tab of their settings page. Only the parameters specified
will be updated.

``` php
use Widop\Twitter\Account\AccountUpdateProfileRequest;

$request = new AccountUpdateProfileRequest();

$request->setName('Marcel Molina');
$name = $request->getName();

$request->setUrl('http://project.ioni.st');
$url = $request->getUrl();

$request->setLocation('San Francisco, CA');
$location = $request->getLocation();

$request->setDescription('Flipped my wig at age 22 and it never grew back. Also: I work at Twitter.');
$description = $request->getDescription();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$accountSettings = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/update_profile).
