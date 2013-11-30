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
 * Option bag.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OptionBag implements \ArrayAccess, \IteratorAggregate
{
    /** @var \Widop\Twitter\Rest\Options\OptionFactory */
    private $factory;

    /** @var array */
    private $options;

    /**
     * Creates an option bag.
     */
    public function __construct()
    {
        $this->factory = new OptionFactory();
        $this->options = array();
    }

    /**
     * Registers an option.
     *
     * @param string|\Widop\Twitter\Rest\Options\OptionInterface $option The option.
     * @param string                                             $type   The option type.
     *
     * @throws \InvalidArgumentException If the option is not valid.
     *
     * @return \Widop\Twitter\Rest\Options\OptionBag The option bag.
     */
    public function register($option, $type = OptionInterface::TYPE_GET)
    {
        if (is_string($option)) {
            $option = $this->factory->create($option, $type);
        }

        if (!$option instanceof OptionInterface) {
            throw new \InvalidArgumentException(
                'The option should be either a string or a "Widop\Twitter\Rest\Options\OptionInterface".'
            );
        }

        $this->options[$option->getName()] = $option;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->offsetGet($offset) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->getOption($offset)->getValue();
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->getOption($offset)->setValue($value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->offsetSet($offset, null);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->options);
    }

    /**
     * Gets an option.
     *
     * @param string $name The option name.
     *
     * @throws \InvalidArgumentException If the option does not exist.
     *
     * @return \Widop\Twitter\Rest\Options\OptionInterface The option.
     */
    private function getOption($name)
    {
        if (!isset($this->options[$name])) {
            throw new \InvalidArgumentException(sprintf('The option "%s" does not exist.', $name));
        }

        return $this->options[$name];
    }
}
