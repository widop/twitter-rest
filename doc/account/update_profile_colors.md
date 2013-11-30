# Account Update Profile Colors Request

Sets one or more hex values that control the color scheme of the authenticating user's profile page on twitter.com.
Each parameter's value must be a valid hexidecimal value, and may be either three or six characters
(ex: #fff or #ffffff).

``` php
use Widop\Twitter\Account\AccountUpdateProfileColorsRequest;

$request = new AccountUpdateProfileColorsRequest();

$request->setProfileBackgroundColor('3D3D3D');
$color = $request->setProfileBackgroundColoretProfileBackgroundColor();

$request->setProfileLinkColor('00FF00');
$color = $request->getProfileLinkColor();

$request->setProfileSidebarBorderColor('0F0F0F');
$color = $request->getProfileSidebarBorderColor();

$request->setProfileSidebarFillColor('00FF00');
$color = $request->getProfileSidebarFillColor();

$request->setProfileTextColor('000');
$color = $request->getProfileTextColor();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$request->setSkipStatus(true);
$skipStatus = $request->getSkipStatus();

$accountSettings = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/update_profile_colors).
