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

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Abstract lists members post request.
 *
 * @method string|null getListId()                           Gets the list id.
 * @method null        setListId(string $listId)             Sets the list id.
 * @method string|null getSlug()                             Gets the list slug.
 * @method null        setSlug(string $slug)                 Sets the list slug.
 * @method string|null getUserId()                           Gets the comma separated list of user IDs.
 * @method null        setUserId(string $userId)             Sets the comma separated list of user IDs.
 * @method string|null getScreenName()                       Gets the comma separated list of screen names.
 * @method null        setScreenName(string $screenName)     Sets the comma separated list of screen names.
 * @method string|null getOwnerScreenName()                  Gets the screen name of the user owning the list.
 * @method null        setOwnerScreenName(string $screeName) Sets the screen name of the user owning the list.
 * @method string|null getOwnerId()                          Gets the id of the user owning the list.
 * @method null        setOwnerId(string $ownerId)           Sets the id of the user owning the list.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractListsMembersPostRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('list_id', OptionInterface::TYPE_POST)
            ->register('slug', OptionInterface::TYPE_POST)
            ->register('user_id', OptionInterface::TYPE_POST)
            ->register('screen_name', OptionInterface::TYPE_POST)
            ->register('owner_screen_name', OptionInterface::TYPE_POST)
            ->register('owner_id', OptionInterface::TYPE_POST);
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

        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a user id or a screen name.');
        }

        if (isset($optionBag['user_id'])) {
            unset ($optionBag['screen_name']);
        }
    }
}
