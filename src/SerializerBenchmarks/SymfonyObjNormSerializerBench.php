<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace SerializerBenchmarks;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use PhpBench\Serializer\XmlEncoder;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\CacheClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class JmsSerializerBench
 * @author mfris
 * @package SerializerBenchmarks
 */
final class SymfonyObjNormSerializerBench extends AbstractBench
{

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     *
     */
    public function init(): void
    {
        $loader = require __DIR__.'/../../vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);
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
     * @param array $params
     * @ParamProviders({"provideData"})
     * @Warmup(1)
     */
    public function bench(array $params): void
    {
        $this->serializer->serialize($this->getData($params), 'json');
    }

    /**
     * @return array
     */
    public function provideData(): array
    {
        return [
            [
                'vertical' => 1,
                'horizontal' => 1,
            ],
            [
                'vertical' => 2,
                'horizontal' => 2,
            ],
        ];
    }
}
