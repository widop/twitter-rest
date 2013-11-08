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

/**
 * Statuses update with media request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/update_with_media
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateWithMediaRequest extends StatusesUpdateRequest
{
    /** @var string */
    private $media;

    /**
     * Creates a statuses update with media request.
     *
     * @param string $status The status.
     * @param string $media  The media path.
     */
    public function __construct($status, $media)
    {
        parent::__construct($status);

        $this->setPath('/statuses/update_with_media.json');
        $this->setMedia($media);
    }

    /**
     * Gets the request media path.
     *
     * @return string The request media path.
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Sets the request media path.
     *
     * @param string $media The request media path.
     */
    public function setMedia($media)
    {
        if (!file_exists($media)) {
            throw new \InvalidArgumentException(sprintf('The media "%s" does not exist.', $media));
        }

        $this->media = $media;
    }

    /**
     * {@inheritdoc}
     */
    public function hasFileParameters()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getFileParameters()
    {
        $this->setFileParameter('media[]', $this->getMedia());

        return parent::getFileParameters();
    }
}
