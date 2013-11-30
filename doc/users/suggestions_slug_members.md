# Users Suggestions Slug Members Request

Access the users in a given category of the Twitter suggested user list and return their most recent status if they are
not a protected user.

``` php
use Widop\Twitter\Rest\Users\UsersSuggestionsSlugMembersRequest;

$request = new UsersSuggestionsSlugMembersRequest('twitter');

$request->setSlug('twitter');
$slug = $request->getSlug();

$suggestedUsers = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/suggestions/%3Aslug/members).
