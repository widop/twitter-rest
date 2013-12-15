# Geo Id Place Id Request

Returns all the information about a known place.

``` php
use Widop\Twitter\Rest\Geo\GeoIdPlaceIdRequest;

$request = new GeoIdPlaceIdRequest('123456789');

$request->setPlaceId('123546789');
$userId = $request->getPlaceId();

$place = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/geo/id/%3Aplace_id).
