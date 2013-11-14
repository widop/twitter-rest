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
 * Favorites list request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/favorites/list
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FavoritesListRequest extends AbstractRequest
{
    /**@var string */
    private $userId;

    /**@var string */
    private $screenName;

    /**@var integer */
    private $count;

    /**@var string */
    private $sinceId;

    /**@var string */
    private $maxId;

    /**@var boolean */
    private $includeEntities;

    /**
     * Creates a favorites list request.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setMethod('GET');
        $this->setPath('/favorites/list.json');
    }

    /**
     * Gets the ID of the user for whom to return results for.
     *
     * @return string The ID of the user for whom to return results for.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Sets the ID of the user for whom to return results for.
     *
     * @param string $userId The ID of the user for whom to return results for.
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Gets the screen name of the user for whom to return results for.
     *
     * @return string The screen name of the user for whom to return results for.
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * Sets the screen name of the user for whom to return results for.
     *
     * @param string $screenName The screen name of the user for whom to return results for.
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;
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
        if ($this->getUserId() !== null) {
            $this->setGetParameter('user_id', $this->getUserId());
        } elseif ($this->getScreenName() !== null) {
            $this->setGetParameter('screen_name', $this->getScreenName());
        }

        if ($this->getCount() !== null) {
            $this->setGetParameter('count', $this->getCount());
        }

        if ($this->getSinceId() !== null) {
            $this->setGetParameter('since_id', $this->getSinceId());
        }

        if ($this->getMaxId() !== null) {
            $this->setGetParameter('max_id', $this->getMaxId());
        }

        if ($this->getIncludeEntities() !== null) {
            $this->setGetParameter('include_entities', $this->getIncludeEntities());
        }

        return parent::getGetParameters();
    }
}
