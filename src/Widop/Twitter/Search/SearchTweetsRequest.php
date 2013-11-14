<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Search;

use Widop\Twitter\AbstractRequest;

/**
 * Statuses show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/search/tweets
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SearchTweetsRequest extends AbstractRequest
{
    /** @var string */
    private $query;

    /** @var string */
    private $geocode;

    /** @var string */
    private $lang;

    /** @var string */
    private $locale;

    /** @var string */
    private $resultType;

    /** @var integer */
    private $count;

    /** @var \DateTime */
    private $until;

    /** @var string */
    private $sinceId;

    /** @var string */
    private $maxId;

    /** @var boolean */
    private $includeEntities;

    /** @var string */
    private $callback;

    /**
     * Creates a search tweets request.
     *
     * @param string $query The search query.
     */
    public function __construct($query)
    {
        parent::__construct();

        $this->setPath('/search/tweets.json');
        $this->setMethod('GET');

        $this->setQuery($query);
    }

    /**
     * Gets the query.
     *
     * @return string The search query.
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Sets the query.
     *
     * @param string $query The search query.
     */
    public function setQuery($query)
    {
        $this->query = $query;
    }

    /**
     * Gets the geocode information (format: "latitude,longitude,radius").
     *
     * @return string The geocode information.
     */
    public function getGeocode()
    {
        return $this->geocode;
    }

    /**
     * Sets the geocode information.
     *
     * @param string $geocode The geocode information (format: "latitude,longitude,radius").
     */
    public function setGeocode($geocode)
    {
        $this->geocode = $geocode;
    }

    /**
     * Gets the lang.
     *
     * @return string The lang.
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Sets the lang.
     *
     * @param string $lang The lang.
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Gets the locale.
     *
     * @return string The locale.
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Sets the locale.
     *
     * @param string $locale The locale.
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Gets the type of search (mixed, recent or popular).
     *
     * @return string The type of search.
     */
    public function getResultType()
    {
        return $this->resultType;
    }

    /**
     * Sets the result type.
     *
     * @param string $resultType The result type (mixed, recent or popular).
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;
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
     * Gets the "until" date.
     *
     * @return \DateTime The "until" date.
     */
    public function getUntil()
    {
        return $this->until;
    }

    /**
     * Sets the untile date.
     *
     * @param \DateTime $until The until date.
     */
    public function setUntil(\DateTime $until)
    {
        $this->until = $until;
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
     * Checks if "entities" node will be included.
     *
     * @return boolean TRUE if "entities" node will be included else FALSE.
     */
    public function getIncludeEntities()
    {
        return $this->includeEntities;
    }

    /**
     * Sets if "entities" node will be included.
     *
     * @param boolean $includeEntities TRUE if "entities" node will be included else FALSE.
     */
    public function setIncludeEntities($includeEntities)
    {
        $this->includeEntities = $includeEntities;
    }

    /**
     * Gets the callback.
     *
     * @return string The callback.
     */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
     * Sets the callback.
     *
     * @param string $callback The callback.
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getQuery() === null) {
            throw new \RuntimeException('You must provide a query.');
        }

        $this->setGetParameter('q', $this->getQuery());

        if ($this->getGeocode() !== null) {
            $this->setGetParameter('geocode', $this->getGeocode());
        }

        if ($this->getLang() !== null) {
            $this->setGetParameter('lang', $this->getLang());
        }

        if ($this->getLocale() !== null) {
            $this->setGetParameter('locale', $this->getLocale());
        }

        if ($this->getResultType() !== null) {
            $this->setGetParameter('result_type', $this->getResultType());
        }

        if ($this->getCount() !== null) {
            $this->setGetParameter('count', $this->getCount());
        }

        if ($this->getUntil() !== null) {
            $this->setGetParameter('until', $this->getUntil()->format('Y-m-d'));
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

        if ($this->getCallback() !== null) {
            $this->setGetParameter('callback', $this->getCallback());
        }

        return parent::getGetParameters();
    }
}
