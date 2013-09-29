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
 * Statuses show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/show/%3Aid
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesShowRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var string */
    private $trimUser;

    /** @var boolean */
    private $includeMyRetweet;

    /** @var boolean */
    private $includeEntities;

    /**
     * Creates a statuses show request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/statuses/show/:id.json');
        $this->setMethod('GET');

        $this->setId($id);
    }

    /**
     * Gets the tweet identifier.
     *
     * @return string The tweet identifier.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the tweet identifier.
     *
     * @param string $id The tweet identifier.
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Checks if the request includes retweets.
     *
     * @return boolean TRUE if the request includes retweets else FALSE.
     */
    public function getIncludeMyRetweet()
    {
        return $this->includeMyRetweet;
    }

    /**
     * Sets if the request includes retweets.
     *
     * @param boolean $includeMyRetweet TRUE if the request includes retweets else FALSE.
     */
    public function setIncludeMyRetweet($includeMyRetweet)
    {
        $this->includeMyRetweet = $includeMyRetweet;
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
    public function getSignatureUrl()
    {
        $this->setPathParameter(':id', $this->getId());

        return parent::getSignatureUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getTrimUser() !== null) {
            $this->setGetParameter('trim_user', $this->getTrimUser());
        }

        if ($this->getIncludeMyRetweet() !== null) {
            $this->setGetParameter('include_my_retweet', $this->getIncludeMyRetweet());
        }

        if ($this->getIncludeEntities() !== null) {
            $this->setGetParameter('include_entities', $this->getIncludeEntities());
        }

        return parent::getGetParameters();
    }
}
