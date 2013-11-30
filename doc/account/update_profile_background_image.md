# Account Update Profile Background Image Request

Updates the authenticating user's profile background image. This method can also be used to enable or disable the
profile background image.

Although each parameter is marked as optional, at least one of image, tile or use must be provided when making this
request.

``` php
use Widop\Twitter\Rest\Account\AccountUpdateProfileBackgroundImageRequest;

$request = new AccountUpdateProfileBackgroundImageRequest();

$request->setImage('SGVsbG8...gd29ybGQ=');
$banner = $request->getImage();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$request->setUse(true);
$use = $request->getUse();

$accountSettings = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/update_profile_background_image).
