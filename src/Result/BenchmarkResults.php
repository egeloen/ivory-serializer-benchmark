<?php

namespace Ivory\Tests\Serializer\Benchmark\Result;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BenchmarkResults implements BenchmarkResultInterface
{
    /**
     * @var BenchmarkResultInterface[]
     */
    private $results;

    /**
     * @var int
     */
    private $time;

    /**
     * @param BenchmarkResultInterface[] $results
     */
    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * @return BenchmarkResultInterface[]
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * {@inheritdoc}
     */
    public function getBenchmark()
    {
        return reset($this->results)->getBenchmark();
    }

    /**
     * {@inheritdoc}
     */
    public function getTime()
    {
        if ($this->time !== null) {
            return $this->time;
        }

        foreach ($this->results as $result) {
            $this->time += $result->getTime();
        }

        return $this->time = $this->time / count($this->results);
    }
}
