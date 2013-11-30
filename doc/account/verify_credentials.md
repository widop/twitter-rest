# Account Verify Credentials Request

Returns a representation of the requesting user if authentication was successful; Use this method to test if supplied
user credentials are valid.

``` php
use Widop\Twitter\Rest\Account\AccountVerifyCredentialsRequest;

$request = new AccountVerifyCredentialsRequest();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$userInfo = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/account/verify_credentials).
