<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\CacheClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class SymfonyObjectNormalizerBenchmark extends AbstractBenchmark
{

    /**
     * @const string
     */
    protected const NAME = 'Symfony - ObjectNormalizer';

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * {@inheritdoc}
     * @throws \Doctrine\Common\Annotations\AnnotationException
     * @throws \InvalidArgumentException
     * @throws \Symfony\Component\Serializer\Exception\RuntimeException
     */
    public function setUp()
    {
        $classMetadataFactory = new CacheClassMetadataFactory(
            new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader())),
            new ApcuAdapter('SymfonyMetadata')
        );

        $propertyAccessor = PropertyAccess::createPropertyAccessorBuilder()
            ->setCacheItemPool(new ApcuAdapter('SymfonyPropertyAccessor'))
            ->getPropertyAccessor();

        $this->serializer = new Serializer(
            [new ObjectNormalizer($classMetadataFactory, null, $propertyAccessor)],
            [new JsonEncoder(), new XmlEncoder(), new YamlEncoder()]
        );
    }

    /**
     * {@inheritdoc}
     * @throws
     */
    public function execute($horizontalComplexity = 1, $verticalComplexity = 1)
    {
        return $this->serializer->serialize(
            $this->getData($horizontalComplexity, $verticalComplexity),
            $this->getFormat()
        );
    }
}
