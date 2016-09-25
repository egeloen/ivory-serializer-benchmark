<?php

namespace Ivory\Tests\Serializer\Benchmark;

use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerBuilder;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class JmsBenchmark extends AbstractBenchmark
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
        $this->serializer = SerializerBuilder::create()
            ->setCacheDir(__DIR__.'/../cache/Jms')
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
