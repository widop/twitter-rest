# Lists Create Request

Creates a new list for the authenticated user.
Note that you can't create more than 20 lists per account.

``` php
use Widop\Twitter\Rest\Lists\ListsCreateRequest;

$request = new ListsCreateRequest('johnny bravo');

$request->setName('johnny bravo');
$name = $request->getName();

$request->setMode('private');
$mode = $request->getMode();

$request->setDescription('Dat animated series.');
$description = $request->getDescription();

$list = $twitter->send($request);
```

You can get more informations [here](https://dev.twitter.com/docs/api/1.1/post/lists/create).
