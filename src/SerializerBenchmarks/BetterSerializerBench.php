<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace SerializerBenchmarks;

use BetterSerializer\Builder;
use BetterSerializer\Common\SerializationType;
use BetterSerializer\Serializer;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;
use Pimple\Exception\UnknownIdentifierException;
use LogicException;
use ReflectionException;
use RuntimeException;

/**
 * Class BetterSerializerBench
 * @author mfris
 */
final class BetterSerializerBench extends AbstractBench
{

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * @throws RuntimeException|UnknownIdentifierException
     */
    public function init(): void
    {
        $builder = new Builder();

        if (extension_loaded('apcu') && ini_get('apc.enabled')) {
            $builder->enableApcuCache();
        } else {
            $builder->setCacheDir(dirname(__DIR__, 2) . '/cache/better-serializer');
        }

        $this->serializer = $builder->createSerializer();
    }

    /**
     * @param array $params
     * @ParamProviders({"provideData"})
     * @Warmup(1)
     * @throws LogicException|ReflectionException|RuntimeException
     */
    public function bench(array $params): void
    {
        $this->serializer->serialize($this->getData($params), SerializationType::JSON());
    }
}
