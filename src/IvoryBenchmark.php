<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Ivory\Serializer\Mapping\Factory\CacheClassMetadataFactory;
use Ivory\Serializer\Mapping\Factory\ClassMetadataFactory;
use Ivory\Serializer\Navigator\Navigator;
use Ivory\Serializer\Registry\TypeRegistry;
use Ivory\Serializer\Serializer;
use Ivory\Serializer\Type\ObjectType;
use Ivory\Serializer\Type\Type;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class IvoryBenchmark extends AbstractBenchmark
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
        $classMetadataFactory = new CacheClassMetadataFactory(
            ClassMetadataFactory::create(),
            new FilesystemAdapter('Ivory', 0, __DIR__.'/../cache')
        );

        $typeRegistry = TypeRegistry::create([
            Type::OBJECT => new ObjectType($classMetadataFactory),
        ]);

        $this->serializer = new Serializer(new Navigator($typeRegistry));
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
