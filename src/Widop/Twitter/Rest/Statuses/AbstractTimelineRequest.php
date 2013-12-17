<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Statuses;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Rest\AbstractGetRequest;

/**
 * Twitter timeline request.
 *
 * @method integer|null getCount()                     Gets the number of tweets to retrieve.
 * @method null         setCount(integer $count)       Sets the number of tweets to retrieve.
 * @method string|null  getSinceId()                   Gets the lower tweet ID.
 * @method null         setSinceId(string $sinceId)    Sets the lower tweet ID.
 * @method string|null  getMaxId()                     Gets the higher tweet ID.
 * @method null         setMaxId(string $maxId)        Sets the higher tweet ID.
 * @method boolean|null getTrimUser()                  Checks if the user should be trimmed.
 * @method null         setTrimUser(boolean $trimUser) Sets if the user should be trimmed.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
abstract class AbstractTimelineRequest extends AbstractGetRequest
{
    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('count')
            ->register('since_id')
            ->register('max_id')
            ->register('trim_user');
    }
}
