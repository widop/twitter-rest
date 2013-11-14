<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Favorites;

use Widop\Twitter\AbstractRequest;

/**
 * Favorites create request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/favorites/create
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FavoritesCreateRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var boolean */
    private $includeEntities;

    /**
     * Creates a favorites create request.
     *
     * @param string $id The Tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/favorites/create.json');
        $this->setMethod('POST');

        $this->setId($id);
    }

    /**
     * Gets the Tweet identifier.
     *
     * @return string The Tweet identifier.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the Tweet identifier.
     *
     * @param string $id The Tweet identifier.
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
