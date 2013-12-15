<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Search;

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Search tweets request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/search/tweets
 *
 * @method string         getQ()                                       Gets the search query.
 * @method null           setQ(string $query)                          Sets the search query.
 * @method string|null    getGeocode()                                 Gets the geocode area.
 * @method null           setGeocode(string $geocode)                  Sets the geocode area.
 * @method string|null    getLang()                                    Gets the language.
 * @method null           setLang(string $lang)                        Sets the language.
 * @method string|null    getLocale()                                  Gets the locale.
 * @method null           setLocale(string $locale)                    Sets the locale.
 * @method string|null    getResultType()                              Gets the result type.
 * @method null           setResultType(string $resultType)            Sets the result type.
 * @method integer|null   getCount()                                   Gets the number of tweets to return.
 * @method null           setCount(integer $count)                     Sets the number of tweets to return.
 * @method \DateTime|null getUntil()                                   Gets the lower tweet date.
 * @method null           setUntil(string|\DateTime $until)            Sets the lower tweet date.
 * @method string|null    getSinceId()                                 Gets the lower tweet ID.
 * @method null           setSinceId(string $sinceId)                  Sets the lower tweet ID.
 * @method string|null    getMaxId()                                   Gets the higher tweet ID.
 * @method null           setMaxId(string $maxId)                      Sets the higher tweet ID.
 * @method boolean|null   getIncludeEntities()                         Checks if the entities node should be included.
 * @method null           setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method string|null    getCallback()                                Gets the JSONP callback name.
 * @method null           setCallback(string $callback)                Sets the JSONP callback name.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SearchTweetsRequest extends AbstractGetRequest
{
    /**
     * Creates a search tweets request.
     *
     * @param string $query The search query.
     */
    public function __construct($query)
    {
        parent::__construct();

        $this->setQ($query);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('q')
            ->register('geocode')
            ->register('lang')
            ->register('locale')
            ->register('result_type')
            ->register('count')
            ->register('until')
            ->register('since_id')
            ->register('max_id')
            ->register('include_entities')
            ->register('callback');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['q'])) {
            throw new \RuntimeException('You must provide a query.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/search/tweets.json';
    }
}
