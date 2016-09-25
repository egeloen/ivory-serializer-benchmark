<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\ClassLoader\ApcClassLoader;

$loader = require __DIR__.'/vendor/autoload.php';
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

$apcLoader = new ApcClassLoader(sha1(__FILE__), $loader);
$loader->unregister();
$apcLoader->register(true);

return $apcLoader;
