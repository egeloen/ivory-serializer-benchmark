<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace SerializerBenchmarks;

use Ivory\Tests\Serializer\Benchmark\Runner\DataGenerator;
use PhpBench\Benchmark\Metadata\Annotations\BeforeMethods;
use PhpBench\Benchmark\Metadata\Annotations\ParamProviders;

/**
 * Class AbstractBench
 * @author mfris
 * @package Benchmarks
 * @BeforeMethods({"init"})
 */
abstract class AbstractBench
{

    /**
     * @var DataGenerator
     */
    private $dataGenerator;

    /**
     * @var mixed
     */
    private $data;

    /**
     * AbstractBench constructor.
     */
    public function __construct()
    {
        $this->dataGenerator = new DataGenerator();
    }

    /**
     * @return array
     */
    public function provideData(): array
    {
        return [
            [
                'horizontal' => 1,
                'vertical' => 1,
            ],
            [
                'horizontal' => 2,
                'vertical' => 2,
            ],
            [
                'horizontal' => 10,
                'vertical' => 10,
            ],
            [
                'horizontal' => 20,
                'vertical' => 20,
            ],
            [
                'horizontal' => 50,
                'vertical' => 50,
            ],
            [
                'horizontal' => 100,
                'vertical' => 100,
            ],
            [
                'horizontal' => 100,
                'vertical' => 200,
            ],
        ];
    }

    /**
     *
     */
    abstract public function init(): void;

    /**
     * @param array $params
     * @ParamProviders({"provideData"})
     */
    abstract public function bench(array $params): void;

    /**
     * @return DataGenerator
     */
    protected function getDataGenerator(): DataGenerator
    {
        return $this->dataGenerator;
    }

    /**
     * @param array $params
     * @return mixed
     */
    protected function getData(array $params)
    {
        if ($this->data === null) {
            $this->data = $this->dataGenerator->getData($params['horizontal'], $params['vertical']);
        }

        return $this->data;
    }
}
