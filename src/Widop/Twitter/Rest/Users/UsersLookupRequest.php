<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Users;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Users lookup request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/users/lookup
 *
 * @method string|null  getUserId()                                  Gets the comma separated list of user IDs.
 * @method null         setUserId(string $userId)                    Sets the comma separated list of user IDs (max: 100).
 * @method string|null  getScreenName()                              Gets the comma separated list of screen names.
 * @method null         setScreenName(string $screenName)            Sets the comma separated list of screen names (max: 100).
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
  *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersLookupRequest extends AbstractPostRequest
{
/**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id', OptionInterface::TYPE_POST)
            ->register('screen_name', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a series of user ids or screen names.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/users/lookup.json';
    }
}
