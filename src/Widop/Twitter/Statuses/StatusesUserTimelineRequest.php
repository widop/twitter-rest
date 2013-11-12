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
 * Statuses user timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesUserTimelineRequest extends AbstractTimelineRequest
{
    /** @var string */
    private $userId;

    /** @var string */
    private $screenName;

    /** @var boolean */
    private $excludeReplies;

    /** @var boolean */
    private $contributorDetails;

    /** @var boolean */
    private $includeRts;

    /**
     * Creates a statuses user timeline request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPath('/statuses/user_timeline.json');
    }

    /**
     * Gets the ID of the user for whom to return results for.
     *
     * @return string The ID of the user for whom to return results for.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Sets the ID of the user for whom to return results for.
     *
     * @param string $userId The ID of the user for whom to return results for.
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Gets the screen name of the user for whom to return results for.
     *
     * @return string The screen name of the user for whom to return results for.
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * Sets the screen name of the user for whom to return results for.
     *
     * @param string $screenName The screen name of the user for whom to return results for.
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;
    }

    /**
     * Checks if the request will prevent replies from appearing in the returned timeline.
     *
     * @return boolean TRUE if the request will prevent replies from appearing in the returned timeline else FALSE.
     */
    public function getExcludeReplies()
    {
        return $this->excludeReplies;
    }

    /**
     * Sets if the request will prevent replies from appearing in the returned timeline.
     *
     * @param boolean $excludeReplies TRUE if the request will prevent replies from appearing in the returned timeline else FALSE.
     */
    public function setExcludeReplies($excludeReplies)
    {
        $this->excludeReplies = $excludeReplies;
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
     * Checks if the timeline will strip any native retweets.
     *
     * @return boolean FALSE if the timeline will strip any native retweets else TRUE.
     */
    public function getIncludeRts()
    {
        return $this->includeRts;
    }

    /**
     * Sets if the timeline will strip any native retweets.
     *
     * @param boolean $includeRts FALSE if the timeline will strip any native retweets else TRUE.
     */
    public function setIncludeRts($includeRts)
    {
        $this->includeRts = $includeRts;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getUserId() !== null) {
            $this->setGetParameter('user_id', $this->getUserId());
        } elseif ($this->getScreenName() !== null) {
            $this->setGetParameter('screen_name', $this->getScreenName());
        } else {
            throw new \RuntimeException('You must specify a user id or a screen name.');
        }

        if ($this->getExcludeReplies() !== null) {
            $this->setGetParameter('exclude_replies', $this->getExcludeReplies());
        }

        if ($this->getContributorDetails() !== null) {
            $this->setGetParameter('contributor_details', $this->getContributorDetails());
        }

        if ($this->getIncludeRts() !== null) {
            $this->setGetParameter('include_rts', $this->getIncludeRts());
        }

        return parent::getGetParameters();
    }
}
