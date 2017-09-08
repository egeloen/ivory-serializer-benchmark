<?php

namespace Ivory\Tests\Serializer\Benchmark\Command;

use Ivory\Tests\Serializer\Benchmark\BsBenchmark;
use Ivory\Tests\Serializer\Benchmark\IvoryBenchmark;
use Ivory\Tests\Serializer\Benchmark\JmsBenchmark;
use Ivory\Tests\Serializer\Benchmark\Result\BenchmarkResultInterface;
use Ivory\Tests\Serializer\Benchmark\Result\ResultsAggregate;
use Ivory\Tests\Serializer\Benchmark\Runner\BenchmarkRunner;
use Ivory\Tests\Serializer\Benchmark\SymfonyGetSetNormalizerBenchmark;
use Ivory\Tests\Serializer\Benchmark\SymfonyObjectNormalizerBenchmark;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class BenchmarkCommand extends Command
{
    /**
     * @var BenchmarkRunner
     */
    private $runner;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct();

        $this->runner = new BenchmarkRunner();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('benchmark')
            ->addOption('iteration', 'i', InputArgument::OPTIONAL, 'Number of iteration(s)', 1)
            ->addOption('horizontal-complexity', 'hc', InputArgument::OPTIONAL, 'Horizontal data complexity', 1)
            ->addOption('vertical-complexity', 'vc', InputArgument::OPTIONAL, 'Vertical data complexity', 1);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $benchmarks = [
            new IvoryBenchmark(),
//            new SymfonyObjectNormalizerBenchmark(),
//            new SymfonyGetSetNormalizerBenchmark(),
            new JmsBenchmark(),
            new BsBenchmark(),
        ];

        $iteration = $input->getOption('iteration');
        $horizontalComplexity = $input->getOption('horizontal-complexity');
        $verticalComplexity = $input->getOption('vertical-complexity');

        $results = new ResultsAggregate();

        foreach ($benchmarks as $benchmark) {
            $output->writeln($benchmark->getName() . ': Done!');
            $results->addResult($this->runner->run($benchmark, $iteration, $horizontalComplexity, $verticalComplexity));
        }

        $output->writeln('');

        $table = new Table($output);
        $table
            ->setHeaders(['Serializer', 'Duration (sec)', 'Factor'])
            ->setRows($results->getResultRows())
        ;
        $table->render();
    }
}
