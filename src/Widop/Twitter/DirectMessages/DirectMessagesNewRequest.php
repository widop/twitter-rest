<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\DirectMessages;

use Widop\Twitter\AbstractRequest;
use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;

/**
 * Direct messages new request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/direct_messages/new
 *
 * @method string|null getUserId()                       Gets the user ID who will receive the direct message.
 * @method null        setUserId(string $userId)         Sets the user ID who will receive the direct message.
 * @method string|null getScreenName()                   Gets the user screen name who will receive the direct message.
 * @method null        setScreenName(string $screenName) Sets the user screen name who will receive the direct message.
 * @method string      getText()                         Gets the text of the direct message.
 * @method null        setText(string $text)             Sets the text of the direct message.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesNewRequest extends AbstractRequest
{
    /**
     * Creates a direct messages new request.
     *
     * @param string $text The text of the direct message.
     */
    public function __construct($text)
    {
        parent::__construct();

        $this->setText($text);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('user_id', OptionInterface::TYPE_POST)
            ->register('screen_name', OptionInterface::TYPE_POST)
            ->register('text', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['user_id']) && !isset($optionBag['screen_name'])) {
            throw new \RuntimeException('You must provide a user id or a screen name.');
        }

        if (!isset($optionBag['text'])) {
            throw new \RuntimeException('You must provide a text.');
        }

        if (isset($optionBag['user_id'])) {
            unset($optionBag['screen_name']);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/direct_messages/new.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
