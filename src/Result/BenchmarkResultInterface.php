<?php

namespace Ivory\Tests\Serializer\Benchmark\Result;

use Ivory\Tests\Serializer\Benchmark\BenchmarkInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface BenchmarkResultInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getTime(): float;
}
