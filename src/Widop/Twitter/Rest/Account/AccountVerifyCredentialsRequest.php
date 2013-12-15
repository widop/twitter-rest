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

use Widop\Twitter\Rest\AbstractGetRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Account verify credentials request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/account/verify_credentials
 *
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 * @method boolean|null getSkipStatus()                              Checks if the statuses should be included.
 * @method null         setSkipStatus(boolean $skipStatus)           Sets if the statuses should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountVerifyCredentialsRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('include_entities')
            ->register('skip_status');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/verify_credentials.json';
    }
}
