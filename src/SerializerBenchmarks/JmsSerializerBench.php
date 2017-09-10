<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace SerializerBenchmarks;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;
use PhpBench\Benchmark\Metadata\Annotations\Warmup;

/**
 * Class JmsSerializerBench
 * @author mfris
 * @package SerializerBenchmarks
 */
final class JmsSerializerBench extends AbstractBench
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
        $this->serializer = SerializerBuilder::create()
            ->setCacheDir(__DIR__.'/../../cache/Jms')
            ->build();
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
