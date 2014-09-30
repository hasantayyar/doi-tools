<?php

namespace Hasantayyar\DoiTools;

include __DIR__ . '/vendor/autoload.php';

$doiTools = new DoiTools();

var_dump($doiTools->isReal('10.1186%2F1752-0509-4-132'));

var_dump($doiTools->shorten('10.1186%2F1752-0509-4-132'));

