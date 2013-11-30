<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Statuses;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Statuses oembed request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/oembed
 *
 * @method string       getId()                            Gets the tweet ID to embed.
 * @method null         setId(string $id)                  Sets the tweet ID to embed.
 * @method string       getUrl()                           Gets the tweet url to embed.
 * @method null         setUrl(string $url)                Sets the tweet url to embed.
 * @method integer|null getMaxwidth()                      Gets the max width of the embed tweet.
 * @method null         setMaxwidth(integer $maxwidth)     Sets the max width of the embed tweet.
 * @method boolean|null getHideMedia()                     Checks if the media should be hidden.
 * @method null         setHideMedia(boolean $hideMedia)   Sets if if the media should be hidden.
 * @method boolean|null getHideThread()                    Checks if the thread should be hidden.
 * @method null         setHideThread(boolean $hideThread) Sets if the thread should be hidden.
 * @method boolean|null getOmitScript()                    Checks if the widgets.js should be omitted.
 * @method null         setOmitScip(boolean $omitScript)   Sets if the widgets.js should be omitted.
 * @method string|null  getAlign()                         Gets the embed tweets alignment.
 * @method null         setAlign(string $align)            Sets the embed tweets alignment.
 * @method string|null  getRelated()                       Gets the embed related web intents.
 * @method null         setRelated(string $related)        Sets the embed related web intents.
 * @method string|null  getLang()                          Gets the embed tweet language.
 * @method null         setLang(string $lang)              Sets the embed tweet language.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class StatusesOembedRequest extends AbstractRequest
{
    /**
     * Creates a statuses oembed request.
     *
     * @param string $id  The tweet identifier.
     * @param string $url The URL of the Tweet/status to be embedded.
     */
    public function __construct($id, $url)
    {
        parent::__construct();

        $this->setId($id);
        $this->setUrl($url);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('id')
            ->register('url')
            ->register('maxwidth')
            ->register('hide_media')
            ->register('hide_thread')
            ->register('omit_script')
            ->register('align')
            ->register('related')
            ->register('lang');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['id'])) {
            throw new \RuntimeException('You must provide an id.');
        }

        if (!isset($optionBag['url'])) {
            throw new \RuntimeException('You must provide an url.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/oembed.json';
    }
}
