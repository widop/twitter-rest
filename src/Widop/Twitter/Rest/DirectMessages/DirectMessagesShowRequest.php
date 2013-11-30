<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\DirectMessages;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Direct messages show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/direct_messages/show
 *
 * @method string getId()           Gets the direct message ID to show.
 * @method null   setId(string $id) Sets the direct message ID to show.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesShowRequest extends AbstractRequest
{
    /**
     * Creates a direct messages show request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setId($id);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('id');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['id'])) {
            throw new \RuntimeException('You must provide an id.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/direct_messages/show.json';
    }
}
