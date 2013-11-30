<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Users;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Users suggestions request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/users/suggestions
 *
 * @method string|null getLang()             Gets the language.
 * @method null        setLang(string $lang) Sets the language.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSuggestionsRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('lang');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/users/suggestions.json';
    }
}
