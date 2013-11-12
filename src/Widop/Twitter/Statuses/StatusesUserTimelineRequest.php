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

use Widop\Twitter\AbstractRequest;

/**
 * Statuses user timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesUserTimelineRequest extends AbstractRequest
{
    /**@var string */
    private $userId;

    /**@var string */
    private $screenName;

    /**@var string */
    private $sinceId;

    /**@var integer */
    private $count;

    /**@var string */
    private $maxId;

    /**@var boolean */
    private $trimUser;

    /**@var boolean */
    private $excludeReplies;

    /**@var boolean */
    private $contributorDetails;

    /**@var boolean */
    private $includeRts;

    /**
     * Creates a statuses user timeline request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod('GET');
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
     * Gets the since id.
     *
     * @return string The since id.
     */
    public function getSinceId()
    {
        return $this->sinceId;
    }

    /**
     * Sets the since id.
     *
     * @param string $sinceId The since id.
     */
    public function setSinceId($sinceId)
    {
        $this->sinceId = $sinceId;
    }

    /**
     * Gets the number of tweets to try and retrieve.
     *
     * @return integer The number of tweets to try and retrieve.
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Sets the number of tweets to try and retrieve.
     *
     * @param integer $count The number of tweets to try and retrieve.
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * Gets the max id.
     *
     * @return string The max id.
     */
    public function getMaxId()
    {
        return $this->maxId;
    }

    /**
     * Sets the max id.
     *
     * @param string $maxId The max id.
     */
    public function setMaxId($maxId)
    {
        $this->maxId = $maxId;
    }

    /**
     * Checks if the request trim user.
     *
     * @return boolean TRUE if the request trim user else FALSE.
     */
    public function getTrimUser()
    {
        return $this->trimUser;
    }

    /**
     * Sets if the request trim user.
     *
     * @param boolean $trimUser TRUE if the request trim user else FALSE.
     */
    public function setTrimUser($trimUser)
    {
        $this->trimUser = $trimUser;
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

        if ($this->getSinceId() !== null) {
            $this->setGetParameter('since_id', $this->getSinceId());
        }

        if ($this->getCount() !== null) {
            $this->setGetParameter('count', $this->getCount());
        }

        if ($this->getMaxId() !== null) {
            $this->setGetParameter('max_id', $this->getMaxId());
        }

        if ($this->getTrimUser() !== null) {
            $this->setGetParameter('trim_user', $this->getTrimUser());
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
