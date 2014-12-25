<?php

namespace Hasantayyar\DoiTools;

use GuzzleHttp\Event\ErrorEvent;
use GuzzleHttp\Client;

/**
 * @author Hasan Tayyar BEŞİK <tayyar.besik@gmail.com>
 * @package DoiTools 
 */
class DoiTools extends ApiClient{

    private $baseUrl = 'http://dx.doi.org/';

    /**
     * Check if given doi number registered by returning redirected url or false
     * @param string $doiNumber
     * @return boolean|string
     */
    public function isReal($doiNumber) {
        $url = $this->baseUrl . $doiNumber;
        $response = $this->client->get($url, ['timeout' => 2,'connect_timeout'=>2]);
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
        $response = $this->client->get($url, ['timeout' => 2,'connect_timeout'=>2]);
        if ($response->getStatusCode() === '200') {
            $data = $response->json();
            $shortDoi = $data['ShortDOI'];
            return $returnFullUrl ? $this->baseUrl . $shortDoi : $shortDoi;
        }
        return false;
    }

}
