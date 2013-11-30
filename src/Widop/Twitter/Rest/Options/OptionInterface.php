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
 * Option interface.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
interface OptionInterface
{
    /** @const string */
    const TYPE_FILE = 'file';

    /** @const string */
    const TYPE_GET = 'get';

    /** @const string */
    const TYPE_PATH = 'path';

    /** @const string */
    const TYPE_POST = 'post';

    /**
     * Gets the option value.
     *
     * @return mixed The option value.
     */
    public function getValue();

    /**
     * Sets the option value.
     *
     * @param mixed $value The option value.
     */
    public function setValue($value);

    /**
     * Gets the option type.
     *
     * @return string The option type.
     */
    public function getType();

    /**
     * Gets the option name.
     *
     * @return string The option name.
     */
    public function getName();
}
