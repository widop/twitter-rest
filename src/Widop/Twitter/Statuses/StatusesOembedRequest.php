<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Statuses;

use Widop\Twitter\AbstractRequest;

/**
 * Statuses oembed request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/oembed
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesOembedRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var string */
    private $url;

    /** @var integer */
    private $maxWidth;

    /** @var boolean */
    private $hideMedia;

    /** @var boolean */
    private $hideThread;

    /** @var boolean */
    private $omitScript;

    /** @var string */
    private $align;

    /** @var string */
    private $related;

    /** @var string */
    private $lang;

    /**
     * Creates a statuses oembed request.
     *
     * @param string $id  The tweet identifier.
     * @param string $url The URL of the Tweet/status to be embedded.
     */
    public function __construct($id, $url)
    {
        parent::__construct();

        $this->setPath('/statuses/oembed.json');
        $this->setMethod('GET');

        $this->setId($id);
        $this->setUrl($url);
    }

    /**
     * Gets the tweet identifier.
     *
     * @return string The tweet identifier.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the tweet identifier.
     *
     * @param string $id The tweet identifier.
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Gets the URL of the Tweet/status to be embedded.
     *
     * @return string The URL of the Tweet/status to be embedded.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the URL of the Tweet/status to be embedded.
     *
     * @param string $url The URL of the Tweet/status to be embedded.
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Gets the maximum width in pixels that the embed should be rendered at.
     *
     * @return integer The maximum width in pixels that the embed should be rendered at.
     */
    public function getMaxWidth()
    {
        return $this->maxWidth;
    }

    /**
     * Sets the maximum width in pixels that the embed should be rendered at.
     *
     * @param integer $maxWidth The maximum width in pixels that the embed should be rendered at.
     */
    public function setMaxWidth($maxWidth)
    {
        $this->maxWidth = $maxWidth;
    }

    /**
     * Gets whether the embedded Tweet should automatically expand images.
     *
     * @return boolean TRUE if the embedded Tweet expands images else FALSE.
     */
    public function getHideMedia()
    {
        return $this->hideMedia;
    }

    /**
     * Sets whether the embedded Tweet should automatically expand images.
     *
     * @param boolean $hideMedia TRUE if the embedded Tweet expands images else FALSE.
     */
    public function setHideMedia($hideMedia)
    {
        $this->hideMedia = $hideMedia;
    }

    /**
     * Gets whether the embedded Tweet should automatically show the original message in the case that the embedded Tweet
     * is a reply.
     *
     * @return boolean TRUE if the embedded Tweet should show the original message else FALSE.
     */
    public function getHideThread()
    {
        return $this->hideThread;
    }

    /**
     * Sets whether the embedded Tweet should automatically show the original message in the case that the embedded
     * Tweet is a reply.
     *
     * @param boolean $hideThread TRUE if the embedded Tweet should show the original message else FALSE.
     */
    public function setHideThread($hideThread)
    {
        $this->hideThread = $hideThread;
    }

    /**
     * Gets whether the embedded Tweet HTML should include a <script> element pointing to "widgets.js".
     *
     * @return boolean TRUE if the embedded Tweet HTML should include a <script> element, else FALSE.
     */
    public function getOmitScript()
    {
        return $this->omitScript;
    }

    /**
     * Sets whether the embedded Tweet HTML should include a <script> element pointing to "widgets.js".
     *
     * @param boolean $omitScript TRUE if the embedded Tweet HTML should include a <script> element, else FALSE.
     */
    public function setOmitScript($omitScript)
    {
        $this->omitScript = $omitScript;
    }

    /**
     * Gets the tweet alignement (center, right, none or left).
     *
     * @return string The tweet alignment.
     */
    public function getAlign()
    {
        return $this->align;
    }

    /**
     * Sets the tweet alignement (center, right, none or left).
     *
     * @param string $align The tweet alignment.
     */
    public function setAlign($align)
    {
        $this->align = $align;
    }

    /**
     * Gets the related parameter.
     *
     * @return string The related parameter.
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * Sets the related parameter.
     *
     * @param string $related The related parameter.
     */
    public function setRelated($related)
    {
        $this->related = $related;
    }

    /**
     * Gets the lang.
     *
     * @return string The lang.
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Sets the lang.
     *
     * @param string $lang The lang.
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
    }

    /**
     * {@inheritdoc}
     */
    public function getGetParameters()
    {
        if ($this->getId() === null) {
            throw new \RuntimeException('You must specify an id.');
        }

        if ($this->getUrl() === null) {
            throw new \RuntimeException('You must specify an url.');
        }

        $this->setGetParameter('id', $this->getId());
        $this->setGetParameter('url', $this->getUrl());

        if ($this->getMaxWidth() !== null) {
            $this->setGetParameter('maxwidth', $this->getMaxWidth());
        }

        if ($this->getHideMedia() !== null) {
            $this->setGetParameter('hide_media', $this->getHideMedia());
        }

        if ($this->getHideThread() !== null) {
            $this->setGetParameter('hide_thread', $this->getHideThread());
        }

        if ($this->getOmitScript() !== null) {
            $this->setGetParameter('omit_script', $this->getOmitScript());
        }

        if ($this->getAlign() !== null) {
            $this->setGetParameter('align', $this->getAlign());
        }

        if ($this->getRelated() !== null) {
            $this->setGetParameter('related', $this->getRelated());
        }

        if ($this->getLang() !== null) {
            $this->setGetParameter('lang', $this->getLang());
        }

        return parent::getGetParameters();
    }
}
