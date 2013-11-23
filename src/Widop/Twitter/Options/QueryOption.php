<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Options;

/**
 * Query option.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class QueryOption extends AbstractOption
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'query';
    }
}
