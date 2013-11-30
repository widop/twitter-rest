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
 * Account update profile request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/update_profile
 *
 * @method string|null  getName()                                    Gets the full name associated with the profile.
 * @method null         setName(string $name)                        Sets the full name associated with the profile.
 * @method string|null  getUrl()                                     Gets the url associated with the profile.
 * @method null         setUrl(string $url)                          Sets the url associated with the profile.
 * @method string|null  getLocation()                                Gets the city/country of the account's location.
 * @method null         setLocation(string $location)                Sets the city/country of the account's location.
 * @method string|null  getDescription()                             Gets the account description.
 * @method null         setDescription(string $description)          Sets the account description.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateProfileRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('name', OptionInterface::TYPE_POST)
            ->register('url', OptionInterface::TYPE_POST)
            ->register('location', OptionInterface::TYPE_POST)
            ->register('description', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST)
            ->register('skip_status', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['name'])
            && !isset($optionBag['description'])
            && !isset($optionBag['url']) 
            && !isset($optionBag['location'])) {
            throw new \RuntimeException('You must provide a either a name, description, url or a location.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/update_profile.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
