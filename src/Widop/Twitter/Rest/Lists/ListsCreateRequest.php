<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Lists;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Lists create request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/lists/create
 *
 * @method string      getName()                           Gets the name for the list.
 * @method null        setName(string $name)               Sets the name for the list.
 * @method string|null getMode()                           Gets the visibility of your list (public|private).
 * @method null        setMode(string $mode)               Sets the visibility of your list (public|private).
 * @method string|null getDescription()                    Gets the description for the list.
 * @method null        setDescription(string $description) Sets the description for the list.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class ListsCreateRequest extends AbstractRequest
{
    /**
     * Creates a lists create request.
     *
     * @param string $name The name for the list.
     */
    public function __construct($name)
    {
        parent::__construct();

        $this->setName($name);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('name', OptionInterface::TYPE_POST)
            ->register('mode', OptionInterface::TYPE_POST)
            ->register('description', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['name'])) {
            throw new \RuntimeException('You must provide a name.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/lists/create.json';
    }
}
