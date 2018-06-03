# README

This project benchmarks the most popular & feature rich PHP serializers. It measures the time consumed during the 
serialization of an object graph and give you a report of the execution.

The result of the benchmark is directly available on travis: https://travis-ci.org/egeloen/ivory-serializer-benchmark

## Documentation

If you're interesting to use the project locally, follow the next steps.

### Clone the project

First clone the project on on your system:

``` bash
$ git clone git@github.com:egeloen/ivory-serializer-benchmark.git 
```

### Set up the project

The most easy way to set up the project is to install [Docker](https://www.docker.com) and
[Docker Composer](https://docs.docker.com/compose/) and build the project. The configuration is shipped with a 
distribution environment file allowing you to customize your current user/group ID:

``` bash
$ cp .env.dist .env
```

**The most important part is the `USER_ID` and `GROUP_ID` which should match your current user/group.**

Once you have configured your environment, you can build the project:

``` bash
$ docker-compose build
```

### Install dependencies

Install the dependencies via [Composer](https://getcomposer.org/):

``` bash
$ docker-compose run --rm php composer install
```

### Benchmark

To benchmark a single serialization, you can use:

``` bash
$ docker-compose run --rm php bin/benchmark
```

If you want to get a more accurate value, you can use the `iteration` option which will run the benchmark `n` times 
and will give you the average of the executions:

``` bash
$ docker-compose run --rm php bin/benchmark --iteration 100
```

If you want to increase the horizontal complexity of the serialization, you can use the `horizontal-complexity` option 
which represents a complexity factor:

``` bash
$ docker-compose run --rm php bin/benchmark --horizontal-complexity 4
```

If you want to increase the vertical complexity of the serialization, you can use the `vertical-complexity` option 
which represents a complexity factor:

``` bash
$ docker-compose run --rm php bin/benchmark --vertical-complexity 4
```

Symfony serializer isn't included in the benchmarking process by default, because it is very slow.
If you'd like to benchmark also the Symfony serializer, you can use the `with-symfony-serializer` option:

``` bash
$ docker-compose run --rm php bin/benchmark --with-symfony-serializer
```

## PhpBench integration

All the benchmarks were also integrated with PhpBench, to provide more trustful results. You can run the benchmarks
using these commands:

```bash
$ vendor/bin/phpbench run src/SerializerBenchmarks/JmsSerializerBench.php --report=aggregate --revs=10 --iterations=10 --retry-threshold=5 --dump-file=a.xml
$ vendor/bin/phpbench run src/SerializerBenchmarks/IvorySerializerBench.php --report=aggregate --revs=10 --iterations=10 --retry-threshold=5 --dump-file=b.xml
$ vendor/bin/phpbench run src/SerializerBenchmarks/BetterSerializerBench.php --report=aggregate --revs=10 --iterations=10 --retry-threshold=5 --dump-file=c.xml
$ vendor/bin/phpbench run src/SerializerBenchmarks/SymfonyGsNormSerializerBench.php --report=aggregate --revs=1 --iterations=1  --dump-file=d.xml
$ vendor/bin/phpbench run src/SerializerBenchmarks/SymfonyObjNormSerializerBench.php --report=aggregate --revs=1 --iterations=1  --dump-file=e.xml
$ vendor/bin/phpbench report --file=a.xml --file=b.xml --file=c.xml --file=d.xml --file=e.xml --report=compare
```

## Contribute

We love contributors! Ivory is an open source project. If you'd like to contribute, feel free to propose a PR!.

## License

The Ivory Serializer is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
