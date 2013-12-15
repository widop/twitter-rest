<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Blocks;

use Widop\Twitter\Rest\AbstractPostRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Blocks destroy request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/blocks/destroy
 *
 * @method string|null  getUserId()                                  Gets the user ID who will be blocked.
 * @method null         setUserId(string $userId)                    Sets the user ID who will be blocked
 * @method string|null  getScreenName()                              Gets the user screen name who will be blocked.
 * @method null         setScreenName(string $screenName)            Sets the user screen name who will be blocked.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class BlocksDestroyRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id', OptionInterface::TYPE_POST)
            ->register('screen_name', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST)
            ->register('skip_status', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a user id or a screen name.');
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
        return '/blocks/destroy.json';
    }
}
