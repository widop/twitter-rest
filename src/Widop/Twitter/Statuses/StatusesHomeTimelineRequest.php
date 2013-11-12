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
 * Statuses home timeline request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/home_timeline
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesHomeTimelineRequest extends StatusesMentionsTimelineRequest
{
    /** @var boolean */
    private $excludeReplies;

    /**
     * Creates a statuses user timeline request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPath('/statuses/home_timeline.json');
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
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getExcludeReplies() !== null) {
            $this->setGetParameter('exclude_replies', $this->getExcludeReplies());
        }

        return parent::getGetParameters();
    }
}
