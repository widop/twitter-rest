# Users Suggestions Request

Access to Twitter's suggested user list. This returns the list of suggested user categories. The category can be used in
[`users/suggestions/:slug`](suggestions_slug.md) to get the users in that category.

``` php
use Widop\Twitter\Users\UsersSuggestionsRequest;

$request = new UsersSuggestionsRequest();

$request->setLang('fr');
$lang = $request->getLang();

$suggestedCategories = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/users/suggestions).
