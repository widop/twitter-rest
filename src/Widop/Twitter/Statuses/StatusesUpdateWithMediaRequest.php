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

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;

/**
 * Statuses update with media request.
 *
 * @method string|null getMedia()              Gets the tweet media.
 * @method null        setMedia(string $media) Sets the tweet media.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/update_with_media
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesUpdateWithMediaRequest extends StatusesUpdateRequest
{
    /**
     * Creates a statuses update with media request.
     *
     * @param string $status The status.
     * @param string $media  The media path.
     */
    public function __construct($status, $media)
    {
        parent::__construct($status);

        $this->setMedia($media);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag->register('media', OptionInterface::TYPE_FILE);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        parent::validateOptionBag($optionBag);

        if (!isset($optionBag['media'])) {
            throw new \RuntimeException('You must specify a media.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/update_with_media.json';
    }
}
