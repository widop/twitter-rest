<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Lists;

use Widop\Twitter\Options\OptionBag;

/**
 * Lists subscribers request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/lists/subscribers
 *
 * @method string|null getCursor()              Gets the cursor.
 * @method null        setCursor(string $count) Sets the cursor.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsSubscribersRequest extends AbstractListsSubscribersGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        parent::configureOptionBag($optionBag);

        $optionBag->register('cursor');
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/subscribers.json';
    }
}
