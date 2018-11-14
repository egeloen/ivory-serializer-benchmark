<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ApcuCache;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use Metadata\Cache\DoctrineCacheAdapter;

/**
 * @author Asmir Mustafic <goetas@gmail.com>
 */
class JmsMinimalBenchmark extends AbstractBenchmark
{
    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $cache = new ApcuCache();
        $this->serializer = SerializerBuilder::create()
            ->setAnnotationReader(new CachedReader(new AnnotationReader(), $cache, false))
            ->setMetadataCache(new DoctrineCacheAdapter(__CLASS__, $cache))
            ->configureListeners(function (){})
            ->configureHandlers(function (){})
            ->build();
    }

    /**
     * {@inheritdoc}
     */
    public function execute($horizontalComplexity = 1, $verticalComplexity = 1)
    {
        return $this->serializer->serialize(
            $this->getData($horizontalComplexity, $verticalComplexity),
            $this->getFormat()
        );
    }
}
