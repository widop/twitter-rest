# Favorites Create Request

Favorites the status specified in the ID parameter as the authenticating user.
Returns the favorite status when successful.

``` php
use Widop\Twitter\Favorites\FavoritesCreateRequest;

$request = new FavoritesCreateRequest('123');

$request->setId('123');
$id = $request->getId();

$request->setIncludeEntities(true);
$includeEntities = $request->getIncludeEntities();

$tweetFavorited = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/favorites/create).
