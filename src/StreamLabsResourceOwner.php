<?php
namespace Jrodella\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Tool\ArrayAccessorTrait;

class StreamLabsResourceOwner implements ResourceOwnerInterface
{
    use ArrayAccessorTrait;

    /**
     * Raw response
     *
     * @var array
     */
    protected $response;

    /**
     * Creates new resource owner.
     *
     * @param array  $response
     */
    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * User’s ID.
     *
     * @return int
     */
    public function getId()
    {
        return (int) $this->getValueByKey($this->response['streamlabs'], 'id');
    }

    /**
     * User’s username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->getValueByKey($this->response['streamlabs'], 'username');
    }

    /**
     * User’s display name.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getValueByKey($this->response['streamlabs'], 'display_name');
    }

    /**
     * URL of the user’s thumbnail.
     *
     * @return string
     */
    public function getThumbnail()
    {
        return $this->getValueByKey($this->response['streamlabs'], 'thumbnail');
    }

    /**
     * User’s primary network.
     *
     * @return string
     */
    public function getPrimary()
    {
        return $this->getValueByKey($this->response['streamlabs'], 'primary');
    }

    /**
     * User’s twitch data.
     *
     * @return string
     */
    public function getTwitch()
    {
        return $this->getValueByKey($this->response, 'twitch');
    }

    /**
     * User’s youtube data.
     *
     * @return string
     */
    public function getYoutube()
    {
        return $this->getValueByKey($this->response, 'youtube');
    }

    /**
     * User’s facebook data.
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->getValueByKey($this->response, 'facebook');
    }

    /**
     * User’s mixer data.
     *
     * @return string
     */
    public function getMixer()
    {
        return $this->getValueByKey($this->response, 'mixer');
    }


    /**
     * Return all of the owner details available as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
