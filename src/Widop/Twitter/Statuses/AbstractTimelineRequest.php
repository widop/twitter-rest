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
 * Twitter timeline request.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
abstract class AbstractTimelineRequest extends AbstractRequest
{
    /** @var integer */
    private $count;

    /** @var string */
    private $sinceId;

    /** @var string */
    private $maxId;

    /** @var boolean */
    private $trimUser;

    /**
     * Creates a timeline request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod('GET');
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
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getCount() !== null) {
            $this->setGetParameter('count', $this->getCount());
        }

        if ($this->getSinceId() !== null) {
            $this->setGetParameter('since_id', $this->getSinceId());
        }

        if ($this->getMaxId() !== null) {
            $this->setGetParameter('max_id', $this->getMaxId());
        }

        if ($this->getTrimUser() !== null) {
            $this->setGetParameter('trim_user', $this->getTrimUser());
        }

        return parent::getGetParameters();
    }
}
