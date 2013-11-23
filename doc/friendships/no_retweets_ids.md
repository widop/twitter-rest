# Friendships No Retweets Ids Request

Returns a collection of user_ids that the currently authenticated user does not want to receive retweets from.

``` php
use Widop\Twitter\Friendships\FriendshipsNoRetweetsIdsRequest;

$request = new FriendshipsNoRetweetsIdsRequest();

$request->setStringifyIds(true);
$stringifyIds = $request->getStringifyIds();

$users = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/friendships/no_retweets/ids).
