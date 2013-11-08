# Statuses Update With Media Request

Updates the authenticating user's current status, also known as tweeting with a media.

``` php
use Widop\Twitter\Statuses\StatusesUpdateWithMediaRequest;

$request = new StatusesUpdateWithMediaRequest('Yeah, I\'m currently updating my status!', '/path/to/my/media.jpg');

$request->setStatus('Yeah, I\'m currently updating my status!');
$status = $request->getStatus();

$request->setMedia('/path/to/my/media.jpg');
$media = $request->getMedia();

$request->setInReplyToStatusId('123');
$inReplyToStatusId = $request->getInReplyToStatusId();

$request->setLatitude('37.7821120598956');
$latitude = $request->getLatitude();

$request->setLongitude('-122.400612831116');
$longitude = $request->getLongitude();

$request->setPlaceId('df51dec6f4ee2b2c');
$placeId = $request->getPlaceId();

$request->setDisplayCoordinates(true);
$displayCoordinates = $request->getDisplayCoordinates();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$tweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/statuses/update_with_media).
