# Lists Update Request

Updates the specified list. The authenticated user must own the list to be able to update it.

You MUST set either the list id or slug. If the list slug is set, then you MUST provide either the owner screen name
or id. You also have to provide at least one of the following parameters: name, mode or description.

``` php
use Widop\Twitter\Rest\Lists\ListsUpdateRequest;

$request = new ListsUpdateRequest();

$request->setOwnerScreenName('noradio');
$ownerScreenName = $request->getOwnerScreenName();

$request->setOwnerId('123456789');
$ownerId = $request->getOwnerId();

$request->setListId('123456789');
$listId = $request->getListId();

$request->setSlug('mama-mia');
$listSlug = $request->getSlug();

$request->setName('johnny bravo');
$name = $request->getName();

$request->setMode('private');
$mode = $request->getMode();

$request->setDescription('Dat animated series.');
$description = $request->getDescription();

$twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/lists/update).
