<?php

namespace Hasantayyar\DoiTools;

/**
 * @author Hasan Tayyar BEŞİK <tayyar.besik@gmail.com>
 * @package DoiTools 
 */
class Crossref extends ApiClient{

    private $baseUrl = 'http://dx.doi.org/';

    /**
     * Check if given doi number registered by returning redirected url or false
     * @param string $doiNumber
     * @return boolean|string
     */
    public function getAgency($doiNumber) {
        $url = 'http://api.crossref.org/works/'.$doiNumber.'/agency'
	$response = $this->client->get($url);
        if ($response->getStatusCode() === '303') {
            return $response->getBody();
        }
        return false;
    }
}
