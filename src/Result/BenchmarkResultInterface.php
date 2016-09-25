<?php

namespace Ivory\Tests\Serializer\Benchmark\Result;

use Ivory\Tests\Serializer\Benchmark\BenchmarkInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface BenchmarkResultInterface
{
    /**
     * @return BenchmarkInterface
     */
    public function getBenchmark();

    /**
     * @return int
     */
    public function getTime();

    /**
     * @return int
     */
    public function getMemory();
}
