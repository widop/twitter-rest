# Statuses Oembed Request

Returns information allowing the creation of an embedded representation of a Tweet on third party sites.

``` php
use Widop\Twitter\Rest\Statuses\StatusesOembedRequest;

$request = new StatusesOembedRequest('123', 'http://foo.com');

$request->setId('123');
$id = $request->getId();

$request->setUrl('123');
$url = $request->getUrl();

$request->setMaxWidth(400);
$maxWidth = $request->getMaxWidth();

$request->setHideMedia(true);
$hideMedia = $request->getHideMedia();

$request->setHideThread(true);
$hideThread = $request->getHideThread();

$request->setOmitScript(true);
$omitScript = $request->getOmitScript();

$request->setAlign('left');
$align = $request->getAlign();

$request->setRelated('foo');
$related = $request->getRelated();

$request->setLang('fr');
$lang = $request->getLang();

$oembedTweet = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/get/statuses/oembed) and
[here](http://oembed.com/).
