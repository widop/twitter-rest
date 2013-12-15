<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Lists;

use Widop\Twitter\Rest\AbstractPostRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Lists update request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/lists/update
 *
 * @method string|null getListId()                           Gets the list id.
 * @method null        setListId(string $listId)             Sets the list id.
 * @method string|null getSlug()                             Gets the list slug.
 * @method null        setSlug(string $slug)                 Sets the list slug.
 * @method string|null getOwnerScreenName()                  Gets the screen name of the user owning the list.
 * @method null        setOwnerScreenName(string $screeName) Sets the screen name of the user owning the list.
 * @method string|null getOwnerId()                          Gets the id of the user owning the list.
 * @method null        setOwnerId(string $ownerId)           Sets the id of the user owning the list.
 * @method string|null getName()                             Gets the name for the list.
 * @method null        setName(string $name)                 Sets the name for the list.
 * @method string|null getMode()                             Gets the visibility of your list (public|private).
 * @method null        setMode(string $mode)                 Sets the visibility of your list (public|private).
 * @method string|null getDescription()                      Gets the description for the list.
 * @method null        setDescription(string $description)   Sets the description for the list.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsUpdateRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('list_id', OptionInterface::TYPE_POST)
            ->register('slug', OptionInterface::TYPE_POST)
            ->register('owner_screen_name', OptionInterface::TYPE_POST)
            ->register('owner_id', OptionInterface::TYPE_POST)
            ->register('name', OptionInterface::TYPE_POST)
            ->register('mode', OptionInterface::TYPE_POST)
            ->register('description', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['list_id']) && !isset($optionBag['slug'])) {
            throw new \RuntimeException('You must provide a list id or slug.');
        }

        if (isset($optionBag['list_id'])) {
            unset($optionBag['slug']);
        }

        if (isset($optionBag['slug']) && !isset($optionBag['owner_screen_name']) && !isset($optionBag['owner_id'])) {
            throw new \RuntimeException(
                'You must provide the owner screen name or id in conjuction with the slug parameter.'
            );
        }

        if (!isset($optionBag['name']) && !isset($optionBag['mode']) && !isset($optionBag['description'])) {
            throw new \RuntimeException('You must provide at least one parameter to update (name, mode, descrition).');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/update.json';
    }
}
