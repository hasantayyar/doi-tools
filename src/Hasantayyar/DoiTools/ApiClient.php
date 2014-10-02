<?php

namespace Hasantayyar\DoiTools;

use GuzzleHttp\Event\ErrorEvent;
use GuzzleHttp\Client;

/**
 * @author Hasan Tayyar BEŞİK <tayyar.besik@gmail.com>
 * @package DoiTools 
 */
class ApiClient {

    public $client;

    public function __construct() {
        $this->client = new Client(array('defaults' => array('allow_redirects' => false)));
        $emitter = $this->client->getEmitter();
        $emitter->on('error', function (ErrorEvent $event) {
            $event->stopPropagation();
        });
    }

}
