<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\SavedSearches;

use Widop\Twitter\Options\OptionBag;
use Widop\Twitter\Options\OptionInterface;
use Widop\Twitter\Rest\AbstractPostRequest;

/**
 * Saved searches create request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/saved_searches/create
 *
 * @method string getQuery()              Gets the query.
 * @method null   setQuery(string $query) Sets the query.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class SavedSearchesCreateRequest extends AbstractPostRequest
{
    /**
     * Creates a saved searches create request.
     *
     * @param string $query The saved search query.
     */
    public function __construct($query)
    {
        parent::__construct();

        $this->setQuery($query);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag->register('query', OptionInterface::TYPE_POST);
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['query'])) {
            throw new \RuntimeException('You must provide a query.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/saved_searches/create.json';
    }
}
