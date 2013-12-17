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

use Widop\Twitter\Options\OptionBag;

/**
 * Statuses mentions timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/mentions_timeline
 *
 * @method boolean|null getContributorDetails()                            Checks if the contributor details should be
 *                                                                         included.
 * @method null         setContributorDetails(boolean $contributorDetails) Sets if the contributor details should be
 *                                                                         included.
 * @method boolean|null getIncludeEntities()                               Checks if the entities node should be
 *                                                                         included.
 * @method null         setIncludeEntities(boolean $includeEntities)       Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesMentionsTimelineRequest extends AbstractTimelineRequest
{
    /**
     * {@inheritdoc}
     */
    public function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag
            ->register('contributor_details')
            ->register('include_entities');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/mentions_timeline.json';
    }
}
