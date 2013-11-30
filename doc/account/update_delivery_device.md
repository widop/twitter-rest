# Account Update Delivery Device Request

Sets which device Twitter delivers updates to for the authenticating user. Sending none as the device parameter will
disable SMS updates.

``` php
use Widop\Twitter\Rest\Account\AccountUpdateDeliveryDeviceRequest;

$request = new AccountUpdateDeliveryDeviceRequest();

$request->setDevice('sms');
$device = $request->getDevice();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/account/update_delivery_device).
