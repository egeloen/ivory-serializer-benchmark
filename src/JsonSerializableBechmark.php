<?php

namespace Ivory\Tests\Serializer\Benchmark;

/**
 * @author scyzoryck <scyzoryck@gmail.com>
 */
class JsonSerializableBechmark extends AbstractBenchmark
{
    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function execute($horizontalComplexity = 1, $verticalComplexity = 1)
    {
        return json_encode(
            $this->getData($horizontalComplexity, $verticalComplexity)
        );
    }
}
