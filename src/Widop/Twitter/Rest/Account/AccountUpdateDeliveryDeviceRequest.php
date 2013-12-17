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
 * Account update delivery device request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/update_delivery_device
 *
 * @method string|null  getDevice()                                  Gets the device Twitter should devlicer updates to.
 * @method null         setDevice(string $device)                    Sets the device Twitter should devlicer updates to.
 * @method boolean|null getIncludeEntities()                         Checks if entities node will be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if entities node will be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountUpdateDeliveryDeviceRequest extends AbstractPostRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('device', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['device'])) {
            throw new \RuntimeException('You must provide a device.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/update_delivery_device.json';
    }
}
