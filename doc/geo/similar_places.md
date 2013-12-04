# Geo Similar Places Request

Locates places near the given coordinates which are similar in name.

``` php
use Widop\Twitter\Rest\Geo\GeoSimilarPlacesRequest;

$request = new GeoSimilarPlacesRequest('37.78', '-122.40', 'Twitter HQ');

$request->setLat('37.78');
$latitude = $request->getLat();

$request->setLong('-122.40');
$longitude = $request->getLong();

$request->setName('Twitter HQ');
$name = $request->getName();

$request->setContainedWithin('247f43d441defc03');
$maxResults = $request->getContainedWithin();

$request->setAttribute_StreetAddress('79 Folsom St');
$attribute = $request->getAttribute_StreetAddress();

$request->setCallback('myCallback');
$callback = $request->getCallback();

$place = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/geo/similar_places).
