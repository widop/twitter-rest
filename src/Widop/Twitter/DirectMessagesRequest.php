<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter;

/**
 * Direct messages twitter request.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesRequest extends AbstractRequest
{
    /** @var string */
    private $sinceId;

    /** @var string */
    private $maxId;

    /** @var integer */
    private $count;

    /** @var boolean */
    private $includeEntities;

    /** @var boolean */
    private $skipStatus;

    /**
     * Creates a direct messages request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPath('/direct_messages.json');
        $this->setMethod('GET');
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
     * Checks if the request includes entities.
     *
     * @return boolean TRUE if the request includes entities else FALSE.
     */
    public function getIncludeEntities()
    {
        return $this->includeEntities;
    }

    /**
     * Sets the if the request includes entities.
     *
     * @param boolean $includeEntities TRUE if the request includes entities else FALSE.
     */
    public function setIncludeEntities($includeEntities)
    {
        $this->includeEntities = $includeEntities;
    }

    /**
     * Checks if statuses will be included the returned user objects.
     *
     * @return boolean TRUE if statuses will not be included in the returned user objects, else FALSE.
     */
    public function getSkipStatus()
    {
        return $this->skipStatus;
    }

    /**
     * Sets if statuses will be included the returned user objects.
     *
     * @param boolean $skipStatus TRUE if statuses will not be included in the returned user objects, else FALSE.
     */
    public function setSkipStatus($skipStatus)
    {
        $this->skipStatus = $skipStatus;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getSinceId() !== null) {
            $this->setGetParameter('since_id', $this->getSinceId());
        }

        if ($this->getMaxId() !== null) {
            $this->setGetParameter('max_id', $this->getMaxId());
        }

        if ($this->getCount() !== null) {
            $this->setGetParameter('count', $this->getCount());
        }

        if ($this->getIncludeEntities() !== null) {
            $this->setGetParameter('include_entities', $this->getIncludeEntities());
        }

        if ($this->getSkipStatus() !== null) {
            $this->setGetParameter('skip_status', $this->getSkipStatus());
        }

        return parent::getGetParameters();
    }
}
