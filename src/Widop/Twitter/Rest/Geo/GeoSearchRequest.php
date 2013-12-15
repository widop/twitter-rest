<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Geo;

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Geo search request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/geo/search
 *
 * @method string      getLat()                                      Gets the latitude.
 * @method null        setLat(string $lat)                           Sets the latitude.
 * @method string      getLong()                                     Gets the longitude.
 * @method null        setLong(string $long)                         Sets the longitude.
 * @method string      getQuery()                                    Gets the query.
 * @method null        setQuery(string $query)                       Sets the query.
 * @method string      getIp()                                       Gets the ip.
 * @method null        setIp(string $ip)                             Sets the ip.
 * @method string|null getGranularity()                              Gets the granularity.
 * @method null        setGranularity(string $granularity)           Sets the granularity.
 * @method string|null getAccuracy()                                 Gets the accuracy.
 * @method null        setAccuracy(string $accuracy)                 Sets the accuracy.
 * @method string|null getMaxResults()                               Gets the number of results to return.
 * @method null        setMaxResults(string $maxResults)             Sets the number of results to return.
 * @method string|null getContainedWithin()                          Gets the place_id which you would like to restrict the search results to.
 * @method null        setContainedWithin(string $containedWithin)   Sets the place_id which you would like to restrict the search results to.
 * @method string|null getAttribute_StreetAddress()                  Gets the number of results to return.
 * @method null        setAttribute_StreetAddress(string $attribute) Sets the number of results to return.
 * @method string|null getCallback()                                 Gets the callback.
 * @method null        setCallback(string $callback)                 Sets the callback.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoSearchRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('lat')
            ->register('long')
            ->register('query')
            ->register('ip')
            ->register('granularity')
            ->register('accuracy')
            ->register('max_results')
            ->register('contained_within')
            ->register('attribute:street_address')
            ->register('callback');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        $atLeastOneMandatoryOption = false;

        foreach (array('lat', 'long', 'query', 'ip') as $option) {
            if (isset($optionBag[$option])) {
                $atLeastOneMandatoryOption = true;
                break;
            }
        }

        if (!$atLeastOneMandatoryOption) {
            throw new \RuntimeException('You must provide a latitude and longitude pair, query and/or ip.');
        }

        if ((isset($optionBag['lat']) && !isset($optionBag['long']))
            || (isset($optionBag['long']) && !isset($optionBag['lat']))) {
            throw new \RuntimeException('You must provide both latitude and longitude parameters.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/geo/search.json';
    }
}
