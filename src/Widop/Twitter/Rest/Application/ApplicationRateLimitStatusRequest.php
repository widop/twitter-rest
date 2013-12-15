<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Application;

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Application rate limit status request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/application/rate_limit_status
 *
 * @method string|null getResources()                  Gets the comma-separated list of resources.
 * @method null        setResources(string $resources) Sets the comma-separated list of resources.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ApplicationRateLimitStatusRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('resources');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/application/rate_limit_status.json';
    }
}
