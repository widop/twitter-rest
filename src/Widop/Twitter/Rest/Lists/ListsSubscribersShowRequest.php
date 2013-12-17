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

/**
 * Lists subscribers show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/subscribers/show
 *
 * @method string|null  getUserId()                       Gets the user ID.
 * @method null         setUserId(string $userId)         Sets the user ID.
 * @method string|null  getScreenName()                   Gets the user screen name.
 * @method null         setScreenName(string $screenName) Sets the user screen name.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsSubscribersShowRequest extends AbstractListsSubscribersGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag
            ->register('user_id')
            ->register('screen_name');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        parent::validateOptionBag($optionBag);

        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a user id or screen name.');
        }

        if (isset($optionBag['user_id'])) {
            unset($optionBag['screen_name']);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/subscribers/show.json';
    }
}
