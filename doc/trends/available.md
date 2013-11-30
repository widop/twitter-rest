# Trends Available Request

Returns the locations that Twitter has trending topic information for.

The response is an array of "locations" that encode the location's WOEID and some other human-readable information such
as a canonical name and country the location belongs in.

A WOEID is a [Yahoo! Where On Earth ID](http://developer.yahoo.com/geo/geoplanet/).

``` php
use Widop\Twitter\Rest\Trends\TrendsAvailableRequest;

$trends = $twitter->send($new TrendsAvailableRequest());
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/trends/available) and
[here](http://developer.yahoo.com/geo/geoplanet/).
