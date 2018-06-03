<?php

namespace Ivory\Tests\Serializer\Benchmark\Result;

use Ivory\Tests\Serializer\Benchmark\BenchmarkInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BenchmarkResult implements BenchmarkResultInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $time;

    /**
     * @param string $name
     * @param int                $time
     */
    public function __construct(string $name, $time)
    {
        $this->name = $name;
        $this->time = $time;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getTime(): float
    {
        return $this->time;
    }
}
