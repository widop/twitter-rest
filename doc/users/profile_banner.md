# Users ProfileBanner Request

Returns a map of the available size variations of the specified user's profile banner. This method can be used
instead of string manipulation on the profile_banner_url returned in user objects as described in User Profile
Images and Banners.

The profile banner data available at each size variant's URL is in PNG format.

``` php
use Widop\Twitter\Users\UsersProfileBannerRequest;

$request = new UsersProfileBannerRequest();

$request->setUserId('123546789');
$userId = $request->getUserId();

$request->setScreenName('noradio');
$screenName = $request->getScreenName();

$banners = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/profile_banner).
