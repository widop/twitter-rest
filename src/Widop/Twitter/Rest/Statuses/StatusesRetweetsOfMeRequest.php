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
 * Statuses retweets of me request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweets_of_me
 *
 * @method boolean|null getIncludeEntities()                                 Checks if the entities node should be
 *                                                                           included.
 * @method null         setIncludeEntities(boolean $includeEntities)         Sets if the entities node should be
 *                                                                           included.
 * @method boolean|null getIncludeUserEntities()                             Checks if the user entities node should be
 *                                                                           included.
 * @method null         setIncludeUserEntities(boolean $includeUserEntities) Sets if the user entities node should be
 *                                                                           included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetsOfMeRequest extends AbstractTimelineRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag
            ->register('include_entities')
            ->register('include_user_entities');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/retweets_of_me.json';
    }
}
