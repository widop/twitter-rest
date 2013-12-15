# Help Languages Request

Returns the list of languages supported by Twitter along with their ISO 639-1 code. The ISO 639-1 code is the two letter
value to use if you include lang with any of your requests.

``` php
use Widop\Twitter\Rest\Help\HelpLanguagesRequest;

$languages = $twitter->send(new HelpLanguagesRequest());
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/help/languages).
