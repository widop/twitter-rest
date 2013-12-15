<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Options;

/**
 * Filter to owned lists option.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FilterToOwnedListsOption extends AbstractBooleanOption
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'filter_to_owned_lists';
    }
}
