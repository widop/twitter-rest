# Trends Place Request

Returns the top 10 trending topics for a specific WOEID, if trending information is available for it.

The response is an array of "trend" objects that encode the name of the trending topic, the query parameter that can be
used to search for the topic on Twitter Search, and the Twitter Search URL.

This information is cached for 5 minutes. Requesting more frequently than that will not return any more data, and will
count against your rate limit usage.

``` php
use Widop\Twitter\Rest\Trends\TrendsPlaceRequest;

$request = new TrendsPlaceRequest('142');

$request->setId('42');
$id = $this->getId();

$request->setExclude(true);
$exclude = $this->getExclude();

$trends = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/trends/place).
