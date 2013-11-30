# Users Suggestions Slug Request

Access the users in a given category of the Twitter suggested user list.

It is recommended that applications cache this data for no more than one hour.

``` php
use Widop\Twitter\Rest\Users\UsersSuggestionsSlugRequest;

$request = new UsersSuggestionsSlugRequest('twitter');

$request->setSlug('twitter');
$slug = $request->getSlug();

$request->setLang('fr');
$lang = $request->getLang();

$suggestedUsers = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/suggestions/%3Aslug).
