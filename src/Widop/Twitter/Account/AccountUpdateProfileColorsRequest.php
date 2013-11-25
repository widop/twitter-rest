<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Account;

use Widop\Twitter\AbstractRequest;
use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;

/**
 * Account update profile colors request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/update_profile_colors
 *
 * @method string|null  getProfileBackgroundColor()                  Gets the profile background color.
 * @method null         setProfileBackgroundColor(string $color)     Sets the profile background color (hexa).
 * @method string|null  getProfileLinkColor()                        Gets the profile link color.
 * @method null         setProfileLinkColor(string $color)           Sets the profile link color (hexa without #).
 * @method string|null  getProfileSidebarBorderColor()               Gets the profile sidebar border color.
 * @method null         setProfileSidebarBorderColor(string $color)  Sets the profile sidebar border color (hexa).
 * @method string|null  getProfileSidebarFillColor()                 Gets the profile sidebar fill color.
 * @method null         setProfileSidebarFillColor(string $color)    Sets the profile sidebar fill color (hexa).
 * @method string|null  getProfileTextColor()                        Gets the profile text color.
 * @method null         setProfileTextColor(string $color)           Sets the profile text color (hexa).
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileColorsRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('profile_background_color', OptionInterface::TYPE_POST)
            ->register('profile_link_color', OptionInterface::TYPE_POST)
            ->register('profile_sidebar_border_color', OptionInterface::TYPE_POST)
            ->register('profile_sidebar_fill_color', OptionInterface::TYPE_POST)
            ->register('profile_text_color', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST)
            ->register('skip_status', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['profile_background_color'])
            && !isset($optionBag['profile_link_color'])
            && !isset($optionBag['profile_sidebar_border_color'])
            && !isset($optionBag['profile_sidebar_fill_color'])
            && !isset($optionBag['profile_text_color'])) {
            throw new \RuntimeException('You must provide at least one color to update.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/update_profile_colors.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
