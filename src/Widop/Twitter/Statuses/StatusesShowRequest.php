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
use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;

/**
 * Statuses show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/statuses/show/%3Aid
 *
 * @method string       getId()                                        Gets the tweet ID to show.
 * @method null         setId(string $id)                              Sets the tweet ID to show.
 * @method boolean|null getTrimUser()                                  Checks if the user should be trimmed.
 * @method null         setTrimUser(boolean $trimUser)                 Sets if the user should be trimmed.
 * @method boolean|null getInclideMyRetweet()                          Checks if my retweet is included.
 * @method null         setIncludeMyRetweet(boolean $includeMyRetweet) Sets if my retweet is included.
 * @method boolean|null getIncludeEntities()                           Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities)   Sets if the entities node should be included.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesShowRequest extends AbstractRequest
{
    /**
     * Creates a statuses show request.
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
        $optionBag
            ->register('id', OptionInterface::TYPE_PATH)
            ->register('trim_user')
            ->register('include_my_retweet')
            ->register('include_entities');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['id'])) {
            throw new \RuntimeException('You must specify an id.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/statuses/show/:id.json';
    }
}
