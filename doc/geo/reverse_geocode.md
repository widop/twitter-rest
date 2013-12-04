# Geo Reverse Geocode Request

Given a latitude and a longitude, searches for up to 20 places that can be used as a place_id when updating a status.

``` php
use Widop\Twitter\Rest\Geo\GeoReverseGeocodeRequest;

$request = new GeoReverseGeocodeRequest('37.78', '-122.40');

$request->setLat('37.78');
$latitude = $request->getLat();

$request->setLong('-122.40');
$longitude = $request->getLong();

$request->setAccuracy('5ft');
$accuracy = $request->getAccuracy();

$request->setGranularity('city');
$granularity = $request->getGranularity();

$request->setMaxResults(200);
$maxResults = $request->getMaxResults();

$request->setCallback('myCallback');
$callback = $request->getCallback();

$place = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/geo/reverse_geocode).
