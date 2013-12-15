# Help Tos Request

Returns the Twitter Terms of Service in the requested format.
These are not the same as the Developer Rules of the Road.

``` php
use Widop\Twitter\Rest\Help\HelpTosRequest;

$languages = $twitter->send(new HelpTosRequest());
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/help/tos).
