<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Ivory\Tests\Serializer\Benchmark\Model\Forum;
use Ivory\Tests\Serializer\Benchmark\Runner\DataGenerator;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractBenchmark implements BenchmarkInterface
{

    /**
     * @const string
     */
    protected const NAME = 'override_me';

    /**
     * @var DataGenerator
     */
    private $dataGenerator;

    /**
     * AbstractBenchmark constructor.
     */
    public function __construct()
    {
        $this->dataGenerator = new DataGenerator();
    }

    /**
     *
     */
    public function setUp()
    {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    protected function getFormat()
    {
        return 'json';
    }

    /**
     * @param int $horizontalComplexity
     * @param int $verticalComplexity
     *
     * @return Forum
     */
    protected function getData(int $horizontalComplexity = 1, int $verticalComplexity = 1): Forum
    {
        return $this->dataGenerator->getData($horizontalComplexity, $verticalComplexity);
    }
}
