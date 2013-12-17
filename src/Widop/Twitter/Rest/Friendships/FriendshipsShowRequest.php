<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Friendships;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Friendships show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/friendships/show
 *
 * @method string|null  getSourceId()                                 Gets the user_id of the subject user.
 * @method null         setSourceId(string $sourceId)                 Sets the user_id of the subject user.
 * @method string|null  getSourceScreenName()                         Gets the screen_name of the subject user
 * @method null         setSourceScreenName(string $sourceScreenName) Sets the screen_name of the subject user
 * @method string|null  getTargetId()                                 Gets the user_id of the target user.
 * @method null         setTargetId(string $targetId)                 Sets the user_id of the target user.
 * @method string|null  getTargetScreenName()                         Gets the screen_name of the target user.
 * @method null         setTargetScreenName(string $targetScreenName) Sets the screen_name of the target user.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FriendshipsShowRequest extends AbstractGetRequest
{
/**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('source_id')
            ->register('source_screen_name')
            ->register('target_id')
            ->register('target_screen_name');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['source_id']) && !isset($optionBag['source_screen_name'])) {
            throw new \RuntimeException('You must provide a source id or a source screen name.');
        }

        if (!isset($optionBag['target_id']) && !isset($optionBag['target_screen_name'])) {
            throw new \RuntimeException('You must provide a target id or a target screen name.');
        }

        if (isset($optionBag['source_id'])) {
            unset($optionBag['source_screen_name']);
        }

        if (isset($optionBag['target_id'])) {
            unset($optionBag['target_screen_name']);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/friendships/show.json';
    }
}
