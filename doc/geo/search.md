# Geo Search Request

Search for places that can be attached to a statuses/update. Given a latitude and a longitude pair, an IP address, or a name, this request will return a list of all the valid places that can be used as the place_id when updating a status.

``` php
use Widop\Twitter\Rest\Geo\GeoSeachRequest;

$request = new GeoSeachRequest();

$request->setLat('37.78');
$latitude = $request->getLat();

$request->setLong('-122.40');
$longitude = $request->getLong();

$request->setQuery('New York');
$query = $request->getQuery();

$request->setIp('10.10.10.10');
$ip = $request->getIp();

$request->setAccuracy('5ft');
$accuracy = $request->getAccuracy();

$request->setGranularity('city');
$granularity = $request->getGranularity();

$request->setMaxResults(200);
$maxResults = $request->getMaxResults();

$request->setContainedWithin('247f43d441defc03');
$maxResults = $request->getContainedWithin();

$request->setAttribute_StreetAddress('79 Folsom St');
$attribute = $request->getAttribute_StreetAddress();

$request->setCallback('myCallback');
$callback = $request->getCallback();

$place = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/geo/search).
