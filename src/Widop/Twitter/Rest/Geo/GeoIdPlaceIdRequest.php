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

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Geo id place id request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/geo/id/%3Aplace_id
 *
 * @method string getPlaceId()                Gets the place id.
 * @method null   setPlaceId(string $placeId) Sets the place id.
  *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class GeoIdPlaceIdRequest extends AbstractRequest
{
    /**
     * Creates a geo id place id request.
     *
     * @param string $placeId The place id.
     */
    public function __construct($placeId)
    {
        parent::__construct();

        $this->setPlaceId($placeId);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('place_id', OptionInterface::TYPE_PATH);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['place_id'])) {
            throw new \RuntimeException('You must provide a place id.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/geo/id/:place_id.json';
    }
}
