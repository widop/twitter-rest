# Help Configuration Request

Returns the current configuration used by Twitter including twitter.com slugs which are not usernames, maximum photo
resolutions, and t.co URL lengths.

It is recommended applications request this endpoint when they are loaded, but no more than once a day.

``` php
use Widop\Twitter\Rest\Help\HelpConfigurationRequest;

$config = $twitter->send(new HelpConfigurationRequest());
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/help/configuration).
