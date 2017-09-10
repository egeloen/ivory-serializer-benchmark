<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace SerializerBenchmarks;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Ivory\Serializer\Mapping\Factory\CacheClassMetadataFactory;
use Ivory\Serializer\Mapping\Factory\ClassMetadataFactory;
use Ivory\Serializer\Navigator\Navigator;
use Ivory\Serializer\Registry\TypeRegistry;
use Ivory\Serializer\Serializer;
use Ivory\Serializer\Type\ObjectType;
use Ivory\Serializer\Type\Type;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Symfony\Component\Cache\Adapter\ApcuAdapter;

/**
 * Class JmsSerializerBench
 * @author mfris
 * @package SerializerBenchmarks
 */
final class IvorySerializerBench extends AbstractBench
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
            ClassMetadataFactory::create(),
            new ApcuAdapter('IvoryMetadata')
        );

        $typeRegistry = TypeRegistry::create([
            Type::OBJECT => new ObjectType($classMetadataFactory),
        ]);

        $this->serializer = new Serializer(new Navigator($typeRegistry));
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
}
