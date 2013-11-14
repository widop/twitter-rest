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

/**
 * Direct messages new request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/direct_messages/new
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class DirectMessagesNewRequest extends AbstractRequest
{
    /** @var string */
    private $userId;

    /** @var string */
    private $screenName;

    /** @var string */
    private $text;

    /**
     * Creates a direct messages new request.
     *
     * @param string $text The text of the direct message.
     */
    public function __construct($text)
    {
        parent::__construct();

        $this->setPath('/direct_messages/new.json');
        $this->setMethod('POST');
        $this->setText($text);
    }

    /**
     * Gets the ID of the user for whom to return results for.
     *
     * @return string The ID of the user for whom to return results for.
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Sets the ID of the user for whom to return results for.
     *
     * @param string $userId The ID of the user for whom to return results for.
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Gets the screen name of the user for whom to return results for.
     *
     * @return string The screen name of the user for whom to return results for.
     */
    public function getScreenName()
    {
        return $this->screenName;
    }

    /**
     * Sets the screen name of the user for whom to return results for.
     *
     * @param string $screenName The screen name of the user for whom to return results for.
     */
    public function setScreenName($screenName)
    {
        $this->screenName = $screenName;
    }

    /**
     * Gets the text of the direct message.
     *
     * @return string The text of the direct message.
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Sets the text of the direct message.
     *
     * @param string $text The text of the direct message.
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * {@inheritdoc}
     */
    public function getPostParameters()
    {
        if ($this->getUserId() !== null) {
            $this->setPostParameter('user_id', $this->getUserId());
        } elseif ($this->getScreenName() !== null) {
            $this->setPostParameter('screen_name', $this->getScreenName());
        } else {
            throw new \RuntimeException('You must specify a user id or a screen name.');
        }

        if ($this->getText() !== null) {
            $this->setPostParameter('text', $this->getText());
        }

        return parent::getPostParameters();
    }
}
