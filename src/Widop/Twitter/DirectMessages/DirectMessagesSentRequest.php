<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\DirectMessages;

use Widop\Twitter\AbstractRequest;

/**
 * Direct messages sent request.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesSentRequest extends AbstractRequest
{
    /** @var string */
    private $sinceId;

    /** @var string */
    private $maxId;

    /** @var integer */
    private $count;

    /** @var integer */
    private $page;

    /** @var boolean */
    private $includeEntities;

    /**
     * Creates a direct messages sent request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setPath('/direct_messages/sent.json');
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
     * Gets the page.
     *
     * @return integer The page.
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Sets the page.
     *
     * @param integer $page The page.
     */
    public function setPage($page)
    {
        $this->page = $page;
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

        if ($this->getPage() !== null) {
            $this->setGetParameter('page', $this->getPage());
        }

        if ($this->getIncludeEntities() !== null) {
            $this->setGetParameter('include_entities', $this->getIncludeEntities());
        }

        return parent::getGetParameters();
    }
}
