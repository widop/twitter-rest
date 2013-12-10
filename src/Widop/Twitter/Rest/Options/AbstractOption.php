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
 * Abstract option.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractOption implements OptionInterface
{
    /** @var mixed */
    private $value;

    /** @var string */
    private $type;

    /**
     * Creates an option.
     *
     * @param string $type The option type.
     */
    public function __construct($type = self::TYPE_GET)
    {
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function hasValue()
    {
        return $this->value !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }
}
