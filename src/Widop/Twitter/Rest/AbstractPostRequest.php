<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest;

use Widop\Twitter\OAuth\OAuthRequest;

/**
 * Abstract POST request.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractPostRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return OAuthRequest::METHOD_POST;
    }
}
