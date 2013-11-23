# Trends Closest Request

Returns the locations that Twitter has trending topic information for, closest to a specified location.

The response is an array of "locations" that encode the location's WOEID and some other human-readable information such
as a canonical name and country the location belongs in.

A WOEID is a [Yahoo! Where On Earth ID](http://developer.yahoo.com/geo/geoplanet/).

``` php
use Widop\Twitter\Trends\TrendsClosestRequest;

$request = new TrendsClosestRequest('122.3', '-10.2');

$request->setLat('42.42');
$latitude = $this->getLat();

$request->setLong('42.42');
$longitude = $this->getLong();

$trends = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/trends/closest) and
[here](http://developer.yahoo.com/geo/geoplanet/).
