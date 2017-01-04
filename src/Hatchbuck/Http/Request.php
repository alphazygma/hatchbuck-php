<?php /** @copyright Alejandro Salazar (c) 2017 */
namespace Hatchbuck\Http;

/**
 * The <kbd>Request</kbd>
 *
 * @author Alejandro Salazar (alphazygma@gmail.com)
 * @version 1.0
 * @package Hatchbuck.Http
 * @subpackage Http
 */
class Request
{
    /** @var string */
    private static $BASE_URI = 'https://api.hatchbuck.com/api';
    
    /** @var string */
    protected $_apiKey;
    /** @var \Hatchbuck\Auth\Auth */
    private $_auth;
    /** @var \GuzzleHttp\Client */
    protected $_httpClient;
    
    /**
     * Constructor.
     * @param string             $apiKey
     */
    public function __construct($apiKey, \Hatchbuck\Auth\Auth $auth)
    {
        $this->_auth   = $auth;
        $this->_apiKey = $apiKey;

        // Please note that the last `/` is very important so that the last section in the base URI
        // is not replaced by partial URI requests due to PSR7 standards.
        $baseUri = static::$BASE_URI . '/' . \Hatchbuck\Hatchbuck::VERSION . '/';

        $this->_httpClient = new \GuzzleHttp\Client(['base_uri' => $baseUri]);
    }
    
    /**
     * Makes a Post Request to the supplied URI with the given data and returns the resulting array
     * map response.
     * @param string $uri
     * @param array  $dataMap
     * @return array 
     */
    public function post($uri, $dataMap)
    {
        $clientOptions         = $this->_getDefaultOptions();
        $clientOptions['json'] = $dataMap;

        $authUri = $this->_getAuthUri($uri);
        
        $response     = $this->_httpClient->post($authUri, $clientOptions);
        $responseBody = (string) $response->getBody();
        $responseList = \GuzzleHttp\json_decode($responseBody, true);
        
        return $responseList;
    }
    
    /**
     * Takes the supplied URI to be sent and adds the API KEY to it.
     * @param string $uri
     * @return string
     */
    protected function _getAuthUri($uri)
    {
        // Separating the URI into the path and query string
        $parseUrlMap = parse_url($uri);
        
        $path        = $parseUrlMap['path'];
        $queryMap    = [];

        // If the Query string is present, then parse it into an associative array
        if (isset($parseUrlMap['query'])) {
            parse_str($parseUrlMap['query'], $queryMap);
        }
        
        // Set the API key on the query map.
        $queryMap['api_key'] = $this->_apiKey;
        
        // Reconstruct the URI with the Auth parameter
        $authUri = $path . '?' . http_build_query($queryMap);
        
        return $authUri;
    }
    
    /**
     * Return a map of default options to be passed on all Requests.
     * <p>Can also be used for debugging purposes.</p>
     * @return array
     */
    protected function _getDefaultOptions()
    {
        $optionsMap = [];
        
        $this->_setAuthOption($optionsMap, 'cert', $this->_auth->getCert());
        $this->_setAuthOption($optionsMap, 'ssl_key', $this->_auth->getKey());
        
        return $optionsMap;
    }
    
    /**
     * Helper method to parse an <kbd>AuthPair</kbd> object into the supplied options map.
     * @param array                    $optionsMap Array passed by reference to update with the 
     *      supplied auth pair data.
     * @param string                   $key        The key to use on the reference options map.
     * @param \Hatchbuck\Auth\AuthPair $authPair   (Optional)<br/>The Certificate or Private Key
     *      to set on the Options Map
     */
    private function _setAuthOption(&$optionsMap, $key, \Hatchbuck\Auth\AuthPair $authPair = null)
    {
        // If the Auth Pair is not set, no option needs to be added
        if (!isset($authPair)) {
            return;
        }
        
        // If the Auth pair requires a password, then set the option as an array
        if ($authPair->isRequiresPassword()) {
            $optionsMap[$key] = [$authPair->getFilePath(), $authPair->getPassword()];
            
        // otherwise, just as a string with the file path
        } else {
            $optionsMap[$key] = $authPair->getFilePath();
        }
    }
}
