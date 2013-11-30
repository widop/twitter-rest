<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Statuses;

use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Statuses user timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
 *
 * @method string|null  getUserId()                                        Gets the user ID for whom to return results.
 * @method null         setUserId(string $userId)                          Sets the user ID for whom to return results.
 * @method string|null  getScreenName()                                    Gets the user screen name for whom to return
 *                                                                         results for.
 * @method null         setScreenName(string $screenName)                  Sets the user screen name for whom to return
 *                                                                         results for.
 * @method boolean|null getExcludeReplies()                                Checks if the replies should be excluded.
 * @method null         setExcludeReplies(boolean $excludeReplies)         Sets if the replies should be excluded.
 * @method boolean|null getContributorDetails()                            Checks if the contributor details should be
 *                                                                         included.
 * @method null         setContributorDetails(boolean $contributorDetails) Sets if the contributor details should be
 *                                                                         included.
 * @method boolean|null getIncludeRts()                                    Checks if the relative retweets is included.
 * @method null         setIncludeRts(boolean $includeRts)                 Sets if the relative retweets is included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesUserTimelineRequest extends AbstractTimelineRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag
            ->register('user_id')
            ->register('screen_name')
            ->register('exclude_replies')
            ->register('contributor_details')
            ->register('include_rts');
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
        return '/statuses/user_timeline.json';
    }
}
