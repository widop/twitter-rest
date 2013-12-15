# Application Rate Limit Status Request

Returns the current rate limits for methods belonging to the specified resource families.

Each 1.1 API resource belongs to a "resource family" which is indicated in its method documentation. You can typically
determine a method's resource family from the first component of the path after the resource version.

This method responds with a map of methods belonging to the families specified by the resources parameter, the current
remaining uses for each of those resources within the current rate limiting window, and its expiration time in epoch
time. It also includes a rate_limit_context field that indicates the current access token or application-only
authentication context.

You may also issue requests to this method without any parameters to receive a map of all rate limited GET methods. If
your application only uses a few of methods, please explicitly provide a resources parameter with the specified resource
families you work with.

When using app-only auth, this method's response indicates the app-only auth rate limiting context.

``` php
use Widop\Twitter\Rest\Application\ApplicationRateLimitStatusRequest;

$request = new ApplicationRateLimitStatusRequest();

$request->setResources('friends,statuses');
$resources = $request->getResources();

$rateLimitStatuses = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/application/rate_limit_status).
