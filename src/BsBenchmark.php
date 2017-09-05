<?php

namespace Ivory\Tests\Serializer\Benchmark;

use BetterSerializer\Common\SerializationType;
use BetterSerializer\Serializer;
use Pimple\Container;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BsBenchmark extends AbstractBenchmark
{
    /**
     * @var Container
     */
    private static $container;

    /**
     * @var Serializer
     */
    private static $serializer;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        self::$container = require dirname(__DIR__) . '/vendor/better-serializer/better-serializer/dev/di.pimple.php';
        self::$serializer = self::$container->offsetGet(Serializer::class);
//        $this->serializer = SerializerBuilder::create()
//            ->setCacheDir(__DIR__.'/../cache/Jms')
//            ->build();
    }

    /**
     * {@inheritdoc}
     */
    public function execute($horizontalComplexity = 1, $verticalComplexity = 1)
    {
        return self::$serializer->serialize(
            $this->getData($horizontalComplexity, $verticalComplexity),
            SerializationType::byValue($this->getFormat())
        );
    }
}
