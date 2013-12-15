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
 * Owner id option.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class OwnerIdOption extends AbstractScalarOption
{
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'owner_id';
    }
}
