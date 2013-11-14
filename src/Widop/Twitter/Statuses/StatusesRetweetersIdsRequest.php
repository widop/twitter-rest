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
 * Statuses retweeters ids request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/retweeters/ids
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesRetweetersIdsRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var string */
    private $cursor;

    /** @var boolean */
    private $stringifyIds;

    /**
     * Creates a statuses retweeters ids request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/statuses/retweeters/ids.json');
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
     * Gets the cursor.
     *
     * @return string The cursor.
     */
    public function getCursor()
    {
        return $this->cursor;
    }

    /**
     * Sets the cursor.
     *
     * @param string $cursor The cursor.
     */
    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
    }

    /**
     * Checks if the ids will be "stringified".
     *
     * @return boolean TRUE if they will be "stringified" else FALSE.
     */
    public function getStringifyIds()
    {
        return $this->stringifyIds;
    }

    /**
     * Sets if the ids will be "stringified".
     *
     * @param boolean $stringifyIds TRUE if they will be "stringified" else FALSE.
     */
    public function setStringifyIds($stringifyIds)
    {
        $this->stringifyIds = $stringifyIds;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getId() === null) {
            throw new \RuntimeException('You must provide a user id.');
        }

        $this->setGetParameter('id', $this->getId());

        if ($this->getCursor() !== null) {
            $this->setGetParameter('cursor', $this->getCursor());
        }

        if ($this->getStringifyIds() !== null) {
            $this->setGetParameter('stringify_ids', $this->getStringifyIds());
        }

        return parent::getGetParameters();
    }
}
