<?php

namespace Ivory\Tests\Serializer\Benchmark;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
interface BenchmarkInterface
{
    public function setUp();

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param int $horizontalComplexity
     * @param int $verticalComplexity
     */
    public function execute($horizontalComplexity = 1, $verticalComplexity = 1);
}
