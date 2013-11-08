<?php

/*
 * This file is part of the Wid'op package.
 *
 * (c) Wid'op <contact@widop.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Widop\Twitter\OAuth;

/**
 * OAuth request.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OAuthRequest
{
    /** @var string */
    private $baseUrl;

    /** @var string */
    private $path;

    /** @var string */
    private $method;

    /** @var array */
    private $headers;

    /** @var array */
    private $oauthParameters;

    /** @var array */
    private $pathParameters;

    /** @var array */
    private $getParameters;

    /** @var array */
    private $postParameters;

    /** @var array */
    private $fileParameters;

    /**
     * Creates an OAuth request.
     */
    public function __construct()
    {
        $this->headers = array();
        $this->oauthParameters = array();
        $this->pathParameters = array();
        $this->getParameters = array();
        $this->postParameters = array();
        $this->fileParameters = array();
    }

    /**
     * Gets the request base url.
     *
     * @return string The request base url.
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Sets the request base url.
     *
     * @param string $baseUrl The request base url.
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * Gets the request path.
     *
     * @return string The request path.
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the request path.
     *
     * @param string $path The request path.
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Gets the request url (signature url + GET parameters).
     *
     * @return string The request url.
     */
    public function getUrl()
    {
        $url = $this->getSignatureUrl();

        if (!$this->hasGetParameters()) {
            return $url;
        }

        $query = array();
        foreach ($this->getGetParameters() as $name => $value) {
            $query[] = sprintf('%s=%s', $name, $value);
        }

        return $url.'?'.implode('&', $query);
    }

    /**
     * Gets the request signature url (base url + path + path parameters).
     *
     * @return string The request signature url.
     */
    public function getSignatureUrl()
    {
        return $this->getBaseUrl().str_replace(
            array_keys($this->getPathParameters()),
            array_values($this->getPathParameters()),
            $this->getPath()
        );
    }

    /**
     * Gets the method.
     *
     * @return string The method.
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Sets the method.
     *
     * @param string $method The method.
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * Checks if the request has headers.
     *
     * @return boolean TRUE if the request has headers else FALSE.
     */
    public function hasHeaders()
    {
        return !empty($this->headers);
    }

    /**
     * Gets the request headers.
     *
     * @return array The request headers.
     */
    public function getHeaders()
    {
        if (!$this->hasHeader('Authorization') && $this->hasOAuthParameters()) {
            $authorization = array();

            foreach ($this->getOAuthParameters() as $key => $value) {
                $authorization[] = sprintf('%s="%s"', $key, $value);
            }

            $this->setHeader('Authorization', sprintf('OAuth %s', implode(', ', $authorization)));
        }

        return $this->headers;
    }

    /**
     * Sets the request headers.
     *
     * @param array $headers The request headers.
     */
    public function setHeaders(array $headers)
    {
        foreach ($headers as $name => $value) {
            $this->setHeader($name, $value);
        }
    }

    /**
     * Checks if the request header name exists.
     *
     * @param string $name The request header name.
     *
     * @return boolean TRUE if the request header name exists else FALSE.
     */
    public function hasHeader($name)
    {
        return isset($this->headers[$name]);
    }

    /**
     * Gets a specific request header.
     *
     * @param string $name The request header name.
     *
     * @throws \InvalidArgumentException If the header name does not exist.
     *
     * @return string The request header value.
     */
    public function getHeader($name)
    {
        if (!$this->hasHeader($name)) {
            throw new \InvalidArgumentException(sprintf('The request header "%s" does not exist.', $name));
        }

        return $this->headers[$name];
    }

    /**
     * Sets a request header.
     *
     * @param string $name  The request header name.
     * @param string $value The request header value.
     */
    public function setHeader($name, $value)
    {
        $this->headers[$name] = $value;
    }

    /**
     * Removes a request header.
     *
     * @param string $name The request header name.
     *
     * @throws \InvalidArgumentException If the request header name does not exist.
     */
    public function removeHeader($name)
    {
        if (!$this->hasHeader($name)) {
            throw new \InvalidArgumentException(sprintf('The request header "%s" does not exist.', $name));
        }

        unset($this->headers[$name]);
    }

    /**
     * Checks if the request has OAuth parameters.
     *
     * @return boolean TRUE if the request has OAuth parameters else FALSE.
     */
    public function hasOAuthParameters()
    {
        return !empty($this->oauthParameters);
    }

    /**
     * Gets the request OAuth parameters.
     *
     * @return array The request OAuth parameters.
     */
    public function getOAuthParameters()
    {
        if (!$this->hasOAuthParameter('oauth_nonce')) {
            $this->setOAuthParameter('oauth_nonce', md5(uniqid('widop', true)));
        }

        if (!$this->hasOAuthParameter('oauth_timestamp')) {
            $this->setOAuthParameter('oauth_timestamp', time());
        }

        return $this->oauthParameters;
    }

    /**
     * Sets the request OAuth parameters.
     *
     * @param array $oauthParameters The request OAuth parameters.
     */
    public function setOAuthParameters(array $oauthParameters)
    {
        foreach ($oauthParameters as $name => $value) {
            $this->setOAuthParameter($name, $value);
        }
    }

    /**
     * Checks if there is a specific request OAuth parameter.
     *
     * @param string $name The request OAuth parameter name.
     *
     * @return boolean TRUE if there is the specific request OAuth parameter else FALSE.
     */
    public function hasOAuthParameter($name)
    {
        return isset($this->oauthParameters[rawurlencode($name)]);
    }

    /**
     * Gets a specific request OAuth parameter.
     *
     * @param string $name The request OAuth parameter name.
     *
     * @throws \InvalidArgumentException If the request OAuth parameter name does not exist.
     *
     * @return string The request OAuth parameter value.
     */
    public function getOAuthParameter($name)
    {
        if (!$this->hasOAuthParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The OAuth request parameter "%s" does not exist.', $name));
        }

        return $this->oauthParameters[rawurlencode($name)];
    }

    /**
     * Sets a request OAuth parameter.
     *
     * @param string $name  The request OAuth parameter name.
     * @param string $value The request OAuth parameter value.
     */
    public function setOAuthParameter($name, $value)
    {
        $this->oauthParameters[rawurlencode($name)] = rawurlencode($value);
    }

    /**
     * Removes a request OAuth parameter.
     *
     * @param string $name The request OAuth parameter name.
     *
     * @throws \InvalidArgumentException If the request OAuth parameter name does not exist.
     */
    public function removeOAuthParameter($name)
    {
        if (!$this->hasOAuthParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The OAuth request parameter "%s" does not exist.', $name));
        }

        unset($this->oauthParameters[rawurlencode($name)]);
    }

    /**
     * Checks if the request has path parameters.
     *
     * @return boolean TRUE if the request has path parameters.
     */
    public function hasPathParameters()
    {
        return !empty($this->pathParameters);
    }

    /**
     * Gets the request path parameters.
     *
     * @return array The request path parameters.
     */
    public function getPathParameters()
    {
        return $this->pathParameters;
    }

    /**
     * Sets the request path parameters.
     *
     * @param array $pathParameters The request path parameters.
     */
    public function setPathParameters(array $pathParameters)
    {
        foreach ($pathParameters as $name => $value) {
            $this->setPathParameter($name, $value);
        }
    }

    /**
     * Checks if the request has a specific path parameter.
     *
     * @param string $name The request path parameter name.
     *
     * @return boolean TRUE if the request has the specific path parameter else FALSE.
     */
    public function hasPathParameter($name)
    {
        return isset($this->pathParameters[$name]);
    }

    /**
     * Gets a specific request path parameter.
     *
     * @param string $name The request path parameter name.
     *
     * @throws \InvalidArgumentException If the request path parameter name does not exist.
     *
     * @return string The request path parameter value.
     */
    public function getPathParameter($name)
    {
        if (!$this->hasPathParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The path request parameter "%s" does not exist.', $name));
        }

        return $this->pathParameters[$name];
    }

    /**
     * Sets a request path parameter.
     *
     * @param string $name  The request path parameter name.
     * @param string $value The request path parameter value.
     */
    public function setPathParameter($name, $value)
    {
        $this->pathParameters[$name] = $value;
    }

    /**
     * Removes a specific request path parameter.
     *
     * @param string $name The request path parameter name.
     *
     * @throws \InvalidArgumentException If the request path parameter name does not exist.
     */
    public function removePathParameter($name)
    {
        if (!$this->hasPathParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The path request parameter "%s" does not exist.', $name));
        }

        unset($this->pathParameters[$name]);
    }

    /**
     * Checks if the request has GET parameters.
     *
     * @return boolean TRUE if the request has GET parameters else FALSE.
     */
    public function hasGetParameters()
    {
        return !empty($this->getParameters);
    }

    /**
     * Gets the GET request parameters.
     *
     * @return array The GET request parameters.
     */
    public function getGetParameters()
    {
        return $this->getParameters;
    }

    /**
     * Sets the GET request parameters.
     *
     * @param array $getParameters The GET request parameters.
     */
    public function setGetParameters($getParameters)
    {
        foreach ($getParameters as $name => $value) {
            $this->setGetParameter($name, $value);
        }
    }

    /**
     * Checks if the request has a specific GET parameter.
     *
     * @param string $name The GET request parameter name.
     *
     * @return boolean TRUE if the request has the specific GET parameter else FALSE.
     */
    public function hasGetParameter($name)
    {
        return isset($this->getParameters[rawurlencode($name)]);
    }

    /**
     * Gets a specific GET request parameter.
     *
     * @param string $name The GET request parameter name.
     *
     * @throws \InvalidArgumentException If the GET parameter does not exist.
     *
     * @return string The GET request parameter.
     */
    public function getGetParameter($name)
    {
        if (!$this->hasGetParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The GET request parameter "%s" does not exist.', $name));
        }

        return $this->getParameters[rawurlencode($name)];
    }

    /**
     * Sets a GET request parameter.
     *
     * @param string $name  The GET request parameter namme.
     * @param string $value The GET request parameter value.
     */
    public function setGetParameter($name, $value)
    {
        $this->getParameters[rawurlencode($name)] = rawurlencode($value);
    }

    /**
     * Removes a request GET parameter.
     *
     * @param string $name The request GET parameter.
     *
     * @throws \InvalidArgumentException If the GET parameter does not exist.
     */
    public function removeGetParameter($name)
    {
        if (!$this->hasGetParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The GET request parameter "%s" does not exist.', $name));
        }

        unset($this->getParameters[rawurlencode($name)]);
    }

    /**
     * Checks if the request has POST parameters.
     *
     * @return boolean TRUE if the request has POST parameters else FALSE.
     */
    public function hasPostParameters()
    {
        return !empty($this->postParameters);
    }

    /**
     * Gets the POST request parameters.
     *
     * @return array The POST request parameters.
     */
    public function getPostParameters()
    {
        return $this->postParameters;
    }

    /**
     * Sets the POST request parameters.
     *
     * @param array $postParameters The POST request parameters.
     */
    public function setPostParameters(array $postParameters)
    {
        foreach ($postParameters as $name => $value) {
            $this->setPostParameter($name, $value);
        }
    }

    /**
     * Checks if the request has a specific POST parameter.
     *
     * @param string $name The request POST parameter name.
     *
     * @return boolean TRUE if the request has the POST parameter else FALSE.
     */
    public function hasPostParameter($name)
    {
        return isset($this->postParameters[rawurlencode($name)]);
    }

    /**
     * Gets a request POST parameter.
     *
     * @param string $name The request POST parameter name.
     *
     * @throws \InvalidArgumentException If the request POST parameter does not exist.
     *
     * @return string The request POST parameter.
     */
    public function getPostParameter($name)
    {
        if (!$this->hasPostParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The POST request parameter "%s" does not exist.', $name));
        }

        return $this->postParameters[rawurlencode($name)];
    }

    /**
     * Sets a request POST parameter.
     *
     * @param string $name  The request POST parameter name.
     * @param string $value The request POST parameter value.
     */
    public function setPostParameter($name, $value)
    {
        $this->postParameters[rawurlencode($name)] = rawurlencode($value);
    }

    /**
     * Removes a request POST parameter.
     *
     * @param string $name The request POST parameter name.
     *
     * @throws \InvalidArgumentException If the request POST parameter does not exist.
     */
    public function removePostParameter($name)
    {
        if (!$this->hasPostParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The POST request parameter "%s" does not exist.', $name));
        }

        unset($this->postParameters[rawurlencode($name)]);
    }

    /**
     * Checks if the request has file parameters.
     *
     * @return boolean TRUE if the request has file parameters else FALSE.
     */
    public function hasFileParameters()
    {
        return !empty($this->fileParameters);
    }

    /**
     * Gets the file request parameters.
     *
     * @return array The file request parameters.
     */
    public function getFileParameters()
    {
        return $this->fileParameters;
    }

    /**
     * Sets the file request parameters.
     *
     * @param array $fileParameters The file request parameters.
     */
    public function setFileParameters(array $fileParameters)
    {
        foreach ($fileParameters as $name => $value) {
            $this->setFileParameter($name, $value);
        }
    }

    /**
     * Checks if the request has a specific file parameter.
     *
     * @param string $name The request file parameter name.
     *
     * @return boolean TRUE if the request has the file parameter else FALSE.
     */
    public function hasFileParameter($name)
    {
        return isset($this->fileParameters[$name]);
    }

    /**
     * Gets a request file parameter.
     *
     * @param string $name The request file parameter name.
     *
     * @throws \InvalidArgumentException If the request file parameter does not exist.
     *
     * @return string The request file parameter.
     */
    public function getFileParameter($name)
    {
        if (!$this->hasFileParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The file request parameter "%s" does not exist.', $name));
        }

        return $this->fileParameters[$name];
    }

    /**
     * Sets a request file parameter.
     *
     * @param string $name  The request file parameter name.
     * @param string $value The request file parameter value.
     */
    public function setFileParameter($name, $value)
    {
        $this->fileParameters[$name] = $value;
    }

    /**
     * Removes a request file parameter.
     *
     * @param string $name The request file parameter name.
     *
     * @throws \InvalidArgumentException If the request file parameter does not exist.
     */
    public function removeFileParameter($name)
    {
        if (!$this->hasFileParameter($name)) {
            throw new \InvalidArgumentException(sprintf('The file request parameter "%s" does not exist.', $name));
        }

        unset($this->fileParameters[$name]);
    }

    /**
     * Gets the request signature.
     *
     * @return string The request signature.
     */
    public function getSignature()
    {
        if ($this->hasFileParameters()) {
            $elements = $this->getOAuthParameters();
        } else {
            $elements = array_merge(
                $this->getOAuthParameters(),
                $this->getGetParameters(),
                $this->getPostParameters()
            );
        }

        ksort($elements);

        $stringSignature = array();
        foreach ($elements as $key => $value) {
            $stringSignature[] = sprintf('%s=%s', $key, $value);
        }

        $signature = array(
            $this->getMethod(),
            rawurlencode($this->getSignatureUrl()),
            rawurlencode(implode('&', $stringSignature)),
        );

        return implode('&', $signature);
    }
}
