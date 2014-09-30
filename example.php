<?php

namespace Hasantayyar\DoiTools;

include __DIR__ . '/vendor/autoload.php';

$doiTools = new DoiTools();
echo $doiTools->isReal('10.1186%2F1752-0509-4-132');
