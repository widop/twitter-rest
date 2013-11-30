<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Favorites;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;
use Widop\Twitter\Rest\Options\OptionInterface;

/**
 * Favorites create request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/favorites/create
 *
 * @method string       getId()                                      Gets the tweet ID to favorite.
 * @method null         setId(string $id)                            Sets the tweet ID to favorite.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class FavoritesCreateRequest extends AbstractRequest
{
    /**
     * Creates a favorites create request.
     *
     * @param string $id The Tweet identifier.
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
            ->register('id', OptionInterface::TYPE_POST)
            ->register('include_entities', OptionInterface::TYPE_POST);
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
        return '/favorites/create.json';
    }

    /**
     * {@inheritdoc}
     */
    protected function getMethod()
    {
        return 'POST';
    }
}
