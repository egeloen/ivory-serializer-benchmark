<?php

namespace Ivory\Tests\Serializer\Benchmark\Runner;

use Ivory\Tests\Serializer\Benchmark\BenchmarkInterface;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResult;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResultInterface;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResults;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BenchmarkRunner
{
    /**
     * @param BenchmarkInterface $benchmark
     * @param int                $iteration
     * @param int                $horizontalComplexity
     * @param int                $verticalComplexity
     *
     * @return BenchmarkResultInterface
     */
    public function run(
        BenchmarkInterface $benchmark,
        $iteration = 1,
        $horizontalComplexity = 1,
        $verticalComplexity = 1
    ) {
        $results = [];
        $this->doRun($benchmark);

        for ($i = 0; $i < $iteration; $i++) {
            $results[] = $this->doRun($benchmark, $horizontalComplexity, $verticalComplexity);
        }

        if ($iteration > 1) {
            return new BenchmarkResults($results);
        }

        return reset($results);
    }

    /**
     * @param BenchmarkInterface $benchmark
     * @param int                $horizontalComplexity
     * @param int                $verticalComplexity
     *
     * @return BenchmarkResult
     */
    private function doRun(BenchmarkInterface $benchmark, $horizontalComplexity = 1, $verticalComplexity = 1)
    {
        $benchmark->setUp();

        $start = microtime(true);
        $benchmark->execute($horizontalComplexity, $verticalComplexity);
        $finish = microtime(true);

        return new BenchmarkResult($benchmark, $finish - $start);
    }
}
