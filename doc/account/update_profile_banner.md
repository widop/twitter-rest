# Account Update Profile Banner Request

Uploads a profile banner on behalf of the authenticating user. For best results, upload an <5MB image that is exactly
1252px by 626px. Images will be resized for a number of display options. Users with an uploaded profile banner will
have a profile_banner_url node in their Users objects.

Profile banner images are processed asynchronously. The profile_banner_url and its variant sizes will not necessary be
available directly after upload.

``` php
use Widop\Twitter\Account\AccountUpdateProfileBannerRequest;

$request = new AccountUpdateProfileBannerRequest();

$request->setBanner('SGVsbG8...gd29ybGQ=');
$banner = $request->getBanner();

$request->setWidth(400);
$width = $request->getWidth();

$request->setHeight(400);
$height = $request->getHeight();

$request->setOffsetLeft(100);
$offsetLeft = $request->getOffsetLeft();

$request->setOffsetTop(0);
$offsetTop = $request->getOffsetTop();

$twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/update_profile_banner) and
[here](https://dev.twitter.com/docs/user-profile-images-and-banners).
