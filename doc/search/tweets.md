# Search Tweets Request

Returns a collection of relevant Tweets matching a specified query.

Note that Twitter's search service and, by extension, the Search API is not meant to be an exhaustive source of Tweets.
Not all Tweets will be indexed or made available via the search interface.

``` php
use Widop\Twitter\Rest\Search\SearchTweetsRequest;

$request = new SearchTweetsRequest('@noradio');

$request->setQuery('@noradio');
$query = $request->getQuery();

$request->setGeocode('37.781157,-122.398720,1mi');
$query = $request->getGeocode();

$request->setLang('eu');
$query = $request->getLang();

$request->setLocale('ja');
$query = $request->getLocale();

$request->setResultType('mixed');
$query = $request->getResultType();

$request->setCount(200);
$query = $request->getCount();

$request->setUntil(new \DateTime('2012-09-01'));
$query = $request->getUntil();

$request->setSinceId('123456789');
$query = $request->getSinceId();

$request->setMaxId('132465789');
$query = $request->getMaxId();

$request->setIncludeEntities(true);
$query = $request->getIncludeEntities();

$request->setCallback('processTweets');
$query = $request->getCallback();

$tweets = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/search/tweets).
