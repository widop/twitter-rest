<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Statuses;

/**
 * Statuses mentions timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/mentions_timeline
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesMentionsTimelineRequest extends AbstractTimelineRequest
{
    /** @var boolean */
    private $contributorDetails;

    /** @var boolean */
    private $includeEntities;

    /**
     * Creates a statuses mentions timeline request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPath('/statuses/mentions_timeline.json');
    }

    /**
     * Checks if the request will include contributor screen name.
     *
     * @return boolean TRUE if the request will include contributor screen name else FALSE.
     */
    public function getContributorDetails()
    {
        return $this->contributorDetails;
    }

    /**
     * Sets if the request will include contributor screen name.
     *
     * @param boolean $contributorDetails TRUE if the request will include contributor screen name else FALSE.
     */
    public function setContributorDetails($contributorDetails)
    {
        $this->contributorDetails = $contributorDetails;
    }

    /**
     * Checks if the timeline will include the 'entities' node.
     *
     * @return boolean TRUE if the timeline will include the 'entities' node else FALSE.
     */
    public function getIncludeEntities()
    {
        return $this->includeEntities;
    }

    /**
     * Sets if the timeline will include the 'entities' node.
     *
     * @param boolean $includeEntities TRUE if the timeline will include the 'entities' node else FALSE.
     */
    public function setIncludeEntities($includeEntities)
    {
        $this->includeEntities = $includeEntities;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getContributorDetails() !== null) {
            $this->setGetParameter('contributor_details', $this->getContributorDetails());
        }

        if ($this->getIncludeEntities() !== null) {
            $this->setGetParameter('include_entities', $this->getIncludeEntities());
        }

        return parent::getGetParameters();
    }
}
