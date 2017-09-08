<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace Ivory\Tests\Serializer\Benchmark\Result;

/**
 * Class ResultsAggregate
 * @author mfris
 * @package Ivory\Tests\Serializer\Benchmark\Result
 */
final class ResultsAggregate
{

    /**
     * @var BenchmarkResultInterface[]
     */
    private $results = [];

    /**
     * @param BenchmarkResultInterface $result
     */
    public function addResult(BenchmarkResultInterface $result): void
    {
        $this->results[] = $result;
    }

    /**
     * @return array
     */
    public function getResultRows(): array
    {
        usort($this->results, function(BenchmarkResultInterface $a, BenchmarkResultInterface $b) {
            return $a->getTime() <=> $b->getTime();
        });

        $fastestTime = $this->results[0]->getTime();

        $rows = [];

        foreach ($this->results as $result) {
            $rows[] = [
                $result->getName(),
                sprintf('%.6fs', $result->getTime()),
                sprintf('%.2fx', $result->getTime() / $fastestTime),
            ];
        }

        return $rows;
    }
}
