<?php

namespace Widop\Twitter\Statuses;

use Widop\Twitter\AbstractRequest;

/**
 * Statuses destroy request.
 *
 * @link https://dev.twitter.com/docs/api/1.1/post/statuses/destroy/%3Aid
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StatusesDestroyRequest extends AbstractRequest
{
    /** @var string */
    private $id;

    /** @var boolean */
    private $trimUser;

    /**
     * Creates a statuses destroy request.
     *
     * @param string $id The tweet identifier.
     */
    public function __construct($id)
    {
        parent::__construct();

        $this->setPath('/statuses/destroy/:id.json');
        $this->setMethod('POST');

        $this->setId($id);
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
     * Checks if the request trim user.
     *
     * @return boolean TRUE if the request trim user else FALSE.
     */
    public function getTrimUser()
    {
        return $this->trimUser;
    }

    /**
     * Sets if the request trim user.
     *
     * @param boolean $trimUser TRUE if the request trim user else FALSE.
     */
    public function setTrimUser($trimUser)
    {
        $this->trimUser = $trimUser;
    }

    /**
     * {@inheritdoc}
     */
    public function getSignatureUrl()
    {
        $this->setPathParameter(':id', $this->getId());

        return parent::getSignatureUrl();
    }

    /**
     * {@inheritdoc}
     */
    public function getPostParameters()
    {
        if ($this->getTrimUser() !== null) {
            $this->setPostParameter('trim_user', $this->getTrimUser());
        }

        return parent::getPostParameters();
    }
}
