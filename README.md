# README

This project benchmarks the most popular & feature rich PHP serializers. It measures time ans memory consumed during 
the serialization of an object graph and give you a report of the execution.

The result of the benchmark is directly available on travis: https://travis-ci.org/egeloen/ivory-serializer-benchmark

## Documentation

If you're interesting to use the project locally, follow the next steps.

### Clone the project

First clone the project on on your system:

``` bash
$ git clone git@github.com:egeloen/ivory-serializer-benchmark.git 
```

### Enable APCu

The autoloader shipped in the project is configured to use the APCu Symfony class loader in order to increase 
performance, so you need to enable APCu on your system.

### Install dependencies

Install the project dependencies with composer and generated an optimized autoloader:

``` bash
$ composer install --optimize-autoloader
```

### Benchmark

To benchmark a single serialization, you can use:

``` bash
$ ./bin/benchmark
```

If you want to get a more accurate value, you can use the `iteration` option which will run the benchmark `n` times 
and will give you the average of the executions:

``` bash
$ ./bin/benchmark --iteration 100
```

If you want to increase the horizontal complexity of the serialization, you can use the `horizontal-complexity` option 
which represents a complexity factor:

``` bash
$ ./bin/benchmark --horizontal-complexity 4
```

If you want to increase the vertical complexity of the serialization, you can use the `vertical-complexity` option 
which represents a complexity factor:

``` bash
$ ./bin/benchmark --vertical-complexity 4
```

## Contribute

We love contributors! Ivory is an open source project. If you'd like to contribute, feel free to propose a PR!.

## License

The Ivory Serializer is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
