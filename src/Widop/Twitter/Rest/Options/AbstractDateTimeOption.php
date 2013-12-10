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
 * Abstract datetime option.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
abstract class AbstractDateTimeOption extends AbstractOption
{
    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        if (is_string($value)) {
            try {
               $value = new \DateTime($value);
            } catch (\Exception $e) {
                throw new \InvalidArgumentException($e->getMessage());
            }
        }

        if (!($value instanceof \DateTime) && ($value !== null)) {
            throw new \InvalidArgumentException(sprintf(
                'The option "%s" only accepts \DateTime objects or strings.',
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
        return $this->getValue()->format('Y-m-d');
    }
}
