# Account Update Profile Image Request

Updates the authenticating user's profile image. Note that this method expects raw multipart data, not a URL to an
image.

This method asynchronously processes the uploaded file before updating the user's profile image URL.

``` php
use Widop\Twitter\Rest\Account\AccountUpdateProfileImageRequest;

$request = new AccountUpdateProfileImageRequest();

$request->setImage('SGVsbG8...gd29ybGQ=');
$banner = $request->getImage();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$accountSettings = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/update_profile_image).
