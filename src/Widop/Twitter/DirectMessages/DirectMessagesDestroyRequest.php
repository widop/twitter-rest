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
 * Direct messages destroy request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/direct_messages/destroy
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesDestroyRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var boolean */
    private $includeEntities;

    /**
     * Creates a direct messages destroy request.
     *
     * @param string $id The direct message identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/direct_messages/destroy.json');
        $this->setMethod('POST');

        $this->setId($id);
    }

    /**
     * Gets the direct message identifier.
     *
     * @return string The direct message identifier.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the direct message identifier.
     *
     * @param string $id The direct message identifier.
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPostParameters()
    {
        if ($this->getId() === null) {
            throw new \RuntimeException('You must specify an id.');
        }

        $this->setPostParameter('id', $this->getId());

        if ($this->getIncludeEntities() !== null) {
            $this->setPostParameter('include_entities', $this->getIncludeEntities());
        }

        return parent::getPostParameters();
    }
}
