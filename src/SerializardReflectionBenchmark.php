<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Ivory\Tests\Serializer\Benchmark\Model\Category;
use Ivory\Tests\Serializer\Benchmark\Model\Comment;
use Ivory\Tests\Serializer\Benchmark\Model\Forum;
use Ivory\Tests\Serializer\Benchmark\Model\Thread;
use Thunder\Serializard\Format\JsonFormat;
use Thunder\Serializard\FormatContainer\FormatContainer;
use Thunder\Serializard\HydratorContainer\FallbackHydratorContainer;
use Thunder\Serializard\Normalizer\ReflectionNormalizer;
use Thunder\Serializard\NormalizerContainer\FallbackNormalizerContainer;
use Thunder\Serializard\Serializard;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
class SerializardReflectionBenchmark extends AbstractBenchmark
{
    /**
     * @var Serializard
     */
    private $serializer;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        $formats = new FormatContainer();
        $formats->add('json', new JsonFormat());

        $normalizers = new FallbackNormalizerContainer();
        $normalizers->add(Forum::class, new ReflectionNormalizer());
        $normalizers->add(Thread::class, new ReflectionNormalizer());
        $normalizers->add(Comment::class, new ReflectionNormalizer());
        $normalizers->add(Category::class, new ReflectionNormalizer());
        $normalizers->add(\DateTimeImmutable::class, function(\DateTimeImmutable $dt) {
            return $dt->format(\DATE_ATOM);
        });

        $hydrators = new FallbackHydratorContainer();

        $this->serializer = new Serializard($formats, $normalizers, $hydrators);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($horizontalComplexity = 1, $verticalComplexity = 1)
    {
        return $this->serializer->serialize(
            $this->getData($horizontalComplexity, $verticalComplexity),
            $this->getFormat()
        );
    }
}
