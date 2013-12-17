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

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Account update profile image request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/update_profile_image
 *
 * @method string|null  getImage()                                   Gets the avatar image of the profile.
 * @method null         setImage(string $base64Image)                Sets the avatar image of the profile (base 64).
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileImageRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('image', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST)
            ->register('skip_status', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['image'])) {
            throw new \RuntimeException('You must provide an image.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/update_profile_image.json';
    }
}
