# Account Settings Request (GET)

Returns settings (including current trend, geo and sleep time information) for the authenticating user.

``` php
use Widop\Twitter\Account\AccountSettingsGetRequest;

$settings = $twitter->send(new AccountSettingsGetRequest());
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/account/settings).
