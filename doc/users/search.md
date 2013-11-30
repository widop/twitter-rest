# Users Search Request

Provides a simple, relevance-based search interface to public user accounts on Twitter. Try querying by topical
interest, full name, company name, location, or other criteria. Exact match searches are not supported.

Only the first 1,000 matching results are available.

``` php
use Widop\Twitter\Rest\Users\UsersSearchRequest;

$request = new UsersSearchRequest();

$request->setQ('@noradio');
$query = $request->getQ();

$request->setPage(42);
$page = $request->getPage();

$request->setCount(100);
$count = $request->getCount();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/search).
