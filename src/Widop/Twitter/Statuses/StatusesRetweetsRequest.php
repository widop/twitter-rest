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
 * Statuses retweets request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/retweets/%3Aid
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetsRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var integer */
    private $count;

    /** @var boolean */
    private $trimUser;

    /**
     * Creates a statuses retweets request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/statuses/retweets/:id.json');
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
     * Gets the count.
     *
     * @return integer The count.
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Sets the count.
     *
     * @param integer $count The count.
     */
    public function setCount($count)
    {
        $this->count = $count;
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
        if ($this->getCount() !== null) {
            $this->setGetParameter('count', $this->getCount());
        }

        if ($this->getTrimUser() !== null) {
            $this->setGetParameter('trim_user', $this->getTrimUser());
        }

        return parent::getGetParameters();
    }
}
