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
 * Abstract boolean option.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
abstract class AbstractBooleanOption extends AbstractOption
{
    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        if (!is_bool($value) && ($value !== null)) {
            throw new \InvalidArgumentException(sprintf(
                'The option "%s" only accepts boolean value.',
                $this->getName()
            ));
        }

        parent::setValue($value);
    }

    /**
     * {@inheritdoc}
     */
    public function getNormalizedValue()
    {
        return json_encode($this->getValue());
    }
}
