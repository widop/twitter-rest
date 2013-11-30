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

use Widop\Twitter\Rest\AbstractRequest;

/**
 * Account remove profile banner request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/account/remove_profile_banner
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class AccountRemoveProfileBannerRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/account/remove_profile_banner.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
