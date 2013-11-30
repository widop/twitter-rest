# Statuses Destroy Request

Destroys the status specified by the required ID parameter.

``` php
use Widop\Twitter\Rest\Statuses\StatusesDestroyRequest;

$request = new StatusesDestroyRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setTrimUser(true);
$trimUser = $request->getTrimUser();

$tweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/statuses/destroy/%3Aid).
