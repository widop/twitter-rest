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
use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;

/**
 * Statuses update request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/update
 *
 * @method string       getStatus()                                        Gets the tweet status.
 * @method null         setStatus(string $status)                          Sets the tweet status.
 * @method string|null  getInReplyToStatusId()                             Gets the reply tweet ID.
 * @method null         setInReplyToStatusId(string $inReplyToStatusId)    Sets the reply tweet ID.
 * @method string|null  getLat()                                           Gets the tweet latitude.
 * @method null         setLat(string $lat)                                Sets the tweet latitude.
 * @method string|null  getLong()                                          Gets the tweet longitude.
 * @method null         setLong(string $long)                              Sets the tweet longitude.
 * @method string|null  getPlaceId()                                       Gets the tweet place ID.
 * @method null         setPlaceId(string $placeId)                        Sets the tweet place ID.
 * @method boolean|null getDisplayCoordinates()                            Checks if the coordinates is be displayed.
 * @method null         setDisplayCoordinates(boolean $displayCoordinates) Sets if the coordinate shoudl be displayed.
 * @method boolean|null getTrimUser()                                      Checks if the user should be trimmed.
 * @method null         setTrimUser(boolean $trimUser)                     Sets if the user should be trimmed.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateRequest extends AbstractRequest
{
    /**
     * Creates a statuses update request.
     *
     * @param string $status The tweet status.
     */
    public function __construct($status)
    {
        parent::__construct();

        $this->setStatus($status);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('status', OptionInterface::TYPE_POST)
            ->register('in_reply_to_status_id', OptionInterface::TYPE_POST)
            ->register('lat', OptionInterface::TYPE_POST)
            ->register('long', OptionInterface::TYPE_POST)
            ->register('place_id', OptionInterface::TYPE_POST)
            ->register('display_coordinates', OptionInterface::TYPE_POST)
            ->register('trim_user', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['status'])) {
            throw new \RuntimeException('You must provide a status.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/update.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
