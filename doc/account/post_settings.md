# Account Settings Request (POST)

Updates the authenticating user's settings.

``` php
use Widop\Twitter\Account\AccountSettingsPostRequest;

$request = new AccountSettingsPostRequest();

$request->setTrendLocationWoeid('123');
$woeid = $request->getTrendLocationWoeid();

$request->setSleepTimeEnabled(true);
$sleepTimeEnabled = $request->getSleepTimeEnabled();

$request->setStartSleepTime('00');
$startSleepTime = $request->getStartSleepTime();

$request->setEndSleepTime('23');
$endSleepTime = $request->getStartSleepTime();

$request->setTimeZone('Europe/Paris');
$timeZone = $request->getTimeZone();

$request->setLang('fr');
$lang = $request->getLang();

$settings = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/settings).
