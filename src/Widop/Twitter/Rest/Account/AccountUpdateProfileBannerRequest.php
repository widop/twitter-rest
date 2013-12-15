<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Account;

use Widop\Twitter\Rest\AbstractPostRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Account update profile banner request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/update_profile_banner
 *
 * @method string|null  getBanner()                        Gets the Base64-encoded or raw image data being uploaded as the user's new profile banner.
 * @method null         setBanner(string $base64Image)     Sets the Base64-encoded or raw image data being uploaded as the user's new profile banner.
 * @method integer|null getWidth()                         Gets the width of the preferred section of the image being uploaded in pixels.
 * @method null         setWidth(integer $width)           Sets the width of the preferred section of the image being uploaded in pixels.
 * @method integer|null getHeight()                        Gets the height of the preferred section of the image being uploaded in pixels.
 * @method null         setHeight(integer $height)         Sets the height of the preferred section of the image being uploaded in pixels.
 * @method integer|null getOffsetLeft()                    Gets the number of pixels by which to offset the uploaded image from the left.
 * @method null         setOffsetLeft(integer $offsetLeft) Sets the number of pixels by which to offset the uploaded image from the left.
 * @method integer|null getOffsetTop()                     Gets the number of pixels by which to offset the uploaded image from the top.
 * @method null         setOffsetTop(integer offsetRight)  Sets the number of pixels by which to offset the uploaded image from the top.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileBannerRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('banner', OptionInterface::TYPE_POST)
            ->register('width', OptionInterface::TYPE_POST)
            ->register('height', OptionInterface::TYPE_POST)
            ->register('offset_left', OptionInterface::TYPE_POST)
            ->register('offset_top', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['banner'])) {
            throw new \RuntimeException('You must provide a banner.');
        }

        $imageProperties = 0;
        foreach (array('width', 'height', 'offset_top', 'offset_left') as $option) {
            if (isset($optionBag[$option])) {
                $imageProperties++;
            }
        }

        if (($imageProperties > 0) && ($imageProperties !== 4)) {
            throw new \RuntimeException('You must provide all the image parameters.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/update_profile_banner.json';
    }
}
