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
 * Statuses retweet request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/retweet/%3Aid
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var boolean */
    private $trimUser;

    /**
     * Creates a statuses retweet request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/statuses/retweet/:id.json');
        $this->setMethod('POST');

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
    public function getPostParameters()
    {
        if ($this->getTrimUser() !== null) {
            $this->setPostParameter('trim_user', $this->getTrimUser());
        }

        return parent::getPostParameters();
    }
}
