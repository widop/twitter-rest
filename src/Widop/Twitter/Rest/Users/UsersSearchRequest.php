<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\Rest\Users;

use Widop\Twitter\Rest\AbstractRequest;
use Widop\Twitter\Rest\Options\OptionBag;

/**
 * Users show request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/get/users/search
 *
 * @method string       getQ()                                       Gets the search query.
 * @method null         setQ(string $query)                          Sets the search query.
 * @method integer|null getPage()                                    Gets the page of results to retrieve.
 * @method null         setPage(integer $page)                       Sets the page of results to retrieve.
 * @method integer|null getCount()                                   Gets the number of users to return.
 * @method null         setCount(integer $count)                     Sets the number of users to return.
 * @method boolean|null getIncludeEntities()                         Checks if the entities node should be included.
 * @method null         setIncludeEntities(boolean $includeEntities) Sets if the entities node should be included.
 *
 * @author Geoffrey Brier <geoffrey.brier@gmail.com>
 */
class UsersSearchRequest extends AbstractRequest
{
    /**
     * Creates a search tweets request.
     *
     * @param string $query The search query.
     */
    public function __construct($query)
    {
        parent::__construct();

        $this->setQ($query);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptionBag(OptionBag $optionBag)
    {
        $optionBag
            ->register('q')
            ->register('page')
            ->register('count')
            ->register('include_entities');
    }

    /**
     * {@inheritdoc}
     */
    protected function validateOptionBag(OptionBag $optionBag)
    {
        if (!isset($optionBag['q'])) {
            throw new \RuntimeException('You must specify a query.');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getPath()
    {
        return '/users/search.json';
    }
}
