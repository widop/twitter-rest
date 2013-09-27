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
 * Statuses update request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/update
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateRequest extends AbstractRequest
{
    /** @var string */
    private $status;

    /** @var string */
    private $inReplyToStatusId;

    /** @var string */
    private $latitude;

    /** @var string */
    private $longitude;

    /** @var string */
    private $placeId;

    /** @var boolean */
    private $displayCoordinates;

    /** @var boolean */
    private $trimUser;

    /**
     * Creates a statuses update request.
     *
     * @param string $status The tweet status.
     */
    public function __construct($status)
    {
        parent::__construct();

        $this->setPath('/statuses/update.json');
        $this->setMethod('POST');

        $this->setStatus($status);
    }

    /**
     * Gets the tweet status.
     *
     * @return string The tweet status.
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the tweet status.
     *
     * @param string $status The tweet status.
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Gets the in reply tweet identifier.
     *
     * @return string The in reply tweet identifier.
     */
    public function getInReplyToStatusId()
    {
        return $this->inReplyToStatusId;
    }

    /**
     * Sets the in reply tweet identifier.
     *
     * @param string $inReplyToStatusId The in reply tweet identifier.
     */
    public function setInReplyToStatusId($inReplyToStatusId)
    {
        $this->inReplyToStatusId = $inReplyToStatusId;
    }

    /**
     * Gets the tweet latitude.
     *
     * @return string The tweet latitude.
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the tweet latitude.
     *
     * @param string $latitude The tweet latitude.
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Gets the tweet longitude.
     *
     * @return string The tweet longitude.
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the tweet longitude.
     *
     * @param string $longitude The tweet longitude.
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Gets the tweet place identifier.
     *
     * @return string The tweet place identifier.
     */
    public function getPlaceId()
    {
        return $this->placeId;
    }

    /**
     * Sets the tweet place identifier.
     *
     * @param string $placeId The tweet place identifier.
     */
    public function setPlaceId($placeId)
    {
        $this->placeId = $placeId;
    }

    /**
     * Checks if the tweet diplays coordinates.
     *
     * @return boolean TRUE if the tweet diplays coordinates else FALSE.
     */
    public function getDisplayCoordinates()
    {
        return $this->displayCoordinates;
    }

    /**
     * Sets if the tweet displays coordinates.
     *
     * @param boolean $displayCoordinates TRUE if the tweet diplays coordinates else FALSE.
     */
    public function setDisplayCoordinates($displayCoordinates)
    {
        $this->displayCoordinates = $displayCoordinates;
    }

    /**
     * Checks if the request trim user.
     *
     * @return boolean TRUE if the request trim user else FALSE.
     */
    public function getTrimUser()
    {
        return $this->trimUser;
    }

    /**
     * Sets if the request trim user.
     *
     * @param boolean $trimUser TRUE if the request trim user else FALSE.
     */
    public function setTrimUser($trimUser)
    {
        $this->trimUser = $trimUser;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostParameters()
    {
        $this->setPostParameter('status', $this->getStatus());

        if ($this->getInReplyToStatusId() !== null) {
            $this->setPostParameter('in_reply_to_status_id', $this->getInReplyToStatusId());
        }

        if ($this->getLatitude() !== null) {
            $this->setPostParameter('lat', $this->getLatitude());
        }

        if ($this->getLongitude() !== null) {
            $this->setPostParameter('long', $this->getLongitude());
        }

        if ($this->getPlaceId() !== null) {
            $this->setPostParameter('place_id', $this->getPlaceId());
        }

        if ($this->getDisplayCoordinates() !== null) {
            $this->setPostParameter('display_coordinates', $this->getDisplayCoordinates());
        }

        if ($this->getTrimUser() !== null) {
            $this->setPostParameter('trim_user', $this->getTrimUser());
        }

        return parent::getPostParameters();
    }
}
