<?php
namespace Jrodella\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use Jrodella\OAuth2\Client\Provider\Exception\StreamLabsIdentityProviderException;

class StreamLabs extends AbstractProvider
{
    use BearerAuthorizationTrait;

    const PATH_AUTHORIZE = '/api/v1.0/authorize';
    const PATH_TOKEN = '/api/v1.0/token';
    const USER_RESOURCE = '/api/v1.0/user';
    const SCOPE_SEPARATOR = ' ';

    protected $domain = 'https://streamlabs.com';
    protected $resourceDomain = 'https://streamlabs.com';

    private $scopes = ['donations.create', 'donations.read', 'alerts.write'];
    private $responseError = 'error';
    private $responseCode;

    public function __construct(array $options = [])
    {
        $possible = $this->getConfigurableOptions();
        $configured = array_intersect_key($options, array_flip($possible));

        foreach ($configured as $key => $value) {
            $this->$key = $value;
        }

        $options = array_diff_key($options, $configured);

        parent::__construct($options);
    }

    protected function getConfigurableOptions()
    {
        return [
            'accessTokenMethod',
            'accessTokenResourceOwnerId',
            'scopeSeparator',
            'responseError',
            'responseCode',
            'responseResourceOwnerId',
            'scopes',
        ];
    }

    public function getBaseAuthorizationUrl()
    {
        return $this->domain . self::PATH_AUTHORIZE;
    }

    public function getBaseAccessTokenUrl(array $params)
    {
        return $this->domain . self::PATH_TOKEN;
    }

    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $this->resourceDomain . self::USER_RESOURCE;
    }

    public function getDefaultScopes()
    {
        return $this->scopes;
    }

    protected function getScopeSeparator()
    {
        return self::SCOPE_SEPARATOR;
    }

    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (!empty($data[$this->responseError])) {
            $error = $data[$this->responseError];
            $code  = $this->responseCode ? $data[$this->responseCode] : 0;

            throw new StreamLabsIdentityProviderException($error, $code, $data);
        }
    }

    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new StreamLabsResourceOwner($response);
    }

    protected function getDefaultHeaders()
    {
        return [
            'Client-ID' => $this->clientId
        ];
    }

    protected function getAuthorizationHeaders($token = null)
    {
        if ($token === null) {
            return [];
        }

        return [
            'Authorization' => 'Bearer '. $token
        ];
    }
}
