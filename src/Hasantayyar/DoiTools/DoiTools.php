<?php

namespace Hasantayyar\DoiTools;

use GuzzleHttp\Event\ErrorEvent;
use GuzzleHttp\Client;

/**
 * @author Hasan Tayyar BEŞİK <tayyar.besik@gmail.com>
 * @package DoiTools 
 */
class DoiTools {

    private $baseUrl = 'http://dx.doi.org/';
    private $client;

//curl -i 'http://dx.doi.org/' -H 'Pragma: no-cache' -H 'Origin: http://dx.doi.org' --data 'hdl=10.1186%2F1752-0509-4-132' 

    public function __construct() {
        $this->client = new Client(array('defaults' => array('allow_redirects' => false)));
        $emitter = $this->client->getEmitter();
        $emitter->on('error', function (ErrorEvent $event) {
            $event->stopPropagation();
        });
    }

    /**
     * Check if given doi number registered by returning redirected url or false
     * @param string $doiNumber
     * @return boolean|string
     */
    public function isReal($doiNumber) {
        $url = $this->baseUrl . $doiNumber;
        $response = $this->client->get($url);
        if ($response->getStatusCode() === '303') {
            return $response->getHeader('Location');
        }
        return false;
    }

    /**
     *  Create a short doi
     * @param string $doiNumber
     * @param boolean $returnFullUrl
     * @return boolean|string  if  an error occured while getting response "false" will be returned
     */
    public function shorten($doiNumber, $returnFullUrl = false) {
        $url = 'http://shortdoi.org/' . urlencode($doiNumber) . '?format=xml';
        $response = $this->client->get($url);
        if ($response->getStatusCode() === '200') {
            $data = $response->json();
            $shortDoi = $data['ShortDOI'];
            return $returnFullUrl ? $this->baseUrl . $shortDoi : $shortDoi;
        }
        return false;
    }

}
