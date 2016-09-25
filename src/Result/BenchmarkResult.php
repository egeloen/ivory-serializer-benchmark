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
     * @var int
     */
    private $memory;

    /**
     * @param BenchmarkInterface $benchmark
     * @param int                $time
     * @param int|null           $memory
     */
    public function __construct(BenchmarkInterface $benchmark, $time, $memory = null)
    {
        $this->benchmark = $benchmark;
        $this->time = $time;
        $this->memory = $memory;
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

    /**
     * {@inheritdoc}
     */
    public function getMemory()
    {
        return $this->memory;
    }
}
