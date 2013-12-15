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
 * Geo reverse geocode request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/geo/reverse_geocode
 *
 * @method string      getLat()                            Gets the latitude.
 * @method null        setLat(string $lat)                 Sets the latitude.
 * @method string      getLong()                           Gets the longitude.
 * @method null        setLong(string $long)               Sets the longitude.
 * @method string|null getAccuracy()                       Gets the accuracy.
 * @method null        setAccuracy(string $accuracy)       Sets the accuracy.
 * @method string|null getGranularity()                    Gets the granularity.
 * @method null        setGranularity(string $granularity) Sets the granularity.
 * @method string|null getMaxResults()                     Gets the number of results to return.
 * @method null        setMaxResults(string $maxResults)   Sets the number of results to return.
 * @method string|null getCallback()                       Gets the callback.
 * @method null        setCallback(string $callback)       Sets the callback.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoReverseGeocodeRequest extends AbstractGetRequest
{
    /**
     * Creates a geo reverse geocode request.
     *
     * @param string $latitude  The latitude.
     * @param string $longitude The longitude.
     */
    public function __construct($latitude, $longitude)
    {
        parent::__construct();

        $this->setLat($latitude);
        $this->setLong($longitude);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('lat')
            ->register('long')
            ->register('accuracy')
            ->register('granularity')
            ->register('max_results')
            ->register('callback');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['lat'])) {
            throw new \RuntimeException('You must provide a latitude.');
        }

        if (!isset($optionBag['long'])) {
            throw new \RuntimeException('You must provide a longitude.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/geo/reverse_geocode.json';
    }
}
