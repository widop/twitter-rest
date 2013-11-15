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
 * Target screen name option.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class TargetScreenNameOption extends AbstractOption
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'target_screen_name';
    }
}
