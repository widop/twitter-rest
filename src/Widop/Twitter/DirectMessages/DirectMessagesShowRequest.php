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
 * Direct messages show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages/show
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesShowRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /**
     * Creates a direct messages show request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/direct_messages/show.json');
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
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getId() === null) {
            throw new \RuntimeException('You must specify an id.');
        }

        $this->setGetParameter('id', $this->getId());

        return parent::getGetParameters();
    }
}
