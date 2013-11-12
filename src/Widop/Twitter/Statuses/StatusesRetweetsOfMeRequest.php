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
 * Statuses retweets of me request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweets_of_me
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetsOfMeRequest extends AbstractTimelineRequest
{
    /** @var boolean */
    private $includeEntities;

    /** @var boolean */
    private $includeUserEntities;

    /**
     * Creates a statuses retweets of me request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPath('/statuses/retweets_of_me.json');
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
     * Checks if the timeline will include the user 'entities' node.
     *
     * @return boolean TRUE if the timeline will include the use 'entities' node else FALSE.
     */
    public function getIncludeUserEntities()
    {
        return $this->includeUserEntities;
    }

    /**
     * Sets if the timeline will include the user 'entities' node.
     *
     * @param boolean $includeUserEntities TRUE if the timeline will include the user 'entities' node else FALSE.
     */
    public function setIncludeUserEntities($includeUserEntities)
    {
        $this->includeUserEntities = $includeUserEntities;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getIncludeEntities() !== null) {
            $this->setGetParameter('include_entities', $this->getIncludeEntities());
        }

        if ($this->getIncludeUserEntities() !== null) {
            $this->setGetParameter('include_user_entities', $this->getIncludeUserEntities());
        }

        return parent::getGetParameters();
    }
}
