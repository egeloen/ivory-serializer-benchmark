# README

This project benchmarks the most popular & feature rich PHP serializers. It measures the time consumed during the 
serialization of an object graph and give you a report of the execution.

The result of the benchmark is directly available on travis: https://travis-ci.org/php-serializers/ivory-serializer-benchmark

This repository is a fork of [egeloen/ivory-serializer-benchmark](https://github.com/egeloen/ivory-serializer-benchmark),
the project was looking not maintained for a while, please refer to this as the next reference point when benchmarking
PHP serializers.

## Documentation

If you're interesting to use the project locally, follow the next steps.

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

If you want to run the benchmark only for a specific serializer, you can use the `serializer` option:

``` bash
$ docker-compose run --rm php bin/benchmark --serializer SymfonyGetSetNormalizer
```

Available serializers:

* `Ivory`
* `Jms`
* `JmsMinimal`
* `JsonSerializable`
* `SerializardClosure`
* `SerializardReflection`
* `SymfonyGetSetNormalizer`
* `SymfonyObjectNormalizer`

## Contribute

We love contributors! Ivory is an open source project. If you'd like to contribute, feel free to propose a PR!.

## License

The Ivory Serializer is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
