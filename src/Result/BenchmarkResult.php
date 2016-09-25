<?php

namespace Ivory\Tests\Serializer\Benchmark\Result;

use Ivory\Tests\Serializer\Benchmark\BenchmarkInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BenchmarkResult implements BenchmarkResultInterface
{
    /**
     * @var BenchmarkInterface
     */
    private $benchmark;

    /**
     * @var int
     */
    private $time;

    /**
     * @param BenchmarkInterface $benchmark
     * @param int                $time
     */
    public function __construct(BenchmarkInterface $benchmark, $time)
    {
        $this->benchmark = $benchmark;
        $this->time = $time;
    }

    /**
     * @return BenchmarkInterface
     */
    public function getBenchmark()
    {
        return $this->benchmark;
    }

    /**
     * {@inheritdoc}
     */
    public function getTime()
    {
        return $this->time;
    }
}
