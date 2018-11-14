<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Ivory\Tests\Serializer\Benchmark\Model\Category;
use Ivory\Tests\Serializer\Benchmark\Model\Comment;
use Ivory\Tests\Serializer\Benchmark\Model\Forum;
use Ivory\Tests\Serializer\Benchmark\Model\Thread;
use Thunder\Serializard\Format\JsonFormat;
use Thunder\Serializard\FormatContainer\FormatContainer;
use Thunder\Serializard\HydratorContainer\FallbackHydratorContainer;
use Thunder\Serializard\NormalizerContainer\FallbackNormalizerContainer;
use Thunder\Serializard\Serializard;

/**
 * @author Tomasz Kowalczyk <tomasz@kowalczyk.cc>
 */
class SerializardClosureBenchmark extends AbstractBenchmark
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
        $normalizers->add(Forum::class, function(Forum $forum) {
            return [
                'id' => $forum->getId(),
                'name' => $forum->getName(),
                'threads' => $forum->getThreads(),
                'category' => $forum->getCategory(),
                'createdAt' => $forum->getCreatedAt(),
                'updatedAt' => $forum->getUpdatedAt(),
            ];
        });
        $normalizers->add(Thread::class, function(Thread $thread) {
            return [
                'id' => $thread->getId(),
                'popularity' => $thread->getPopularity(),
                'title' => $thread->getTitle(),
                'comments' => $thread->getComments(),
                'description' => $thread->getDescription(),
                'createdAt' => $thread->getCreatedAt(),
                'updatedAt' => $thread->getUpdatedAt(),
            ];
        });
        $normalizers->add(Comment::class, function(Comment $comment) {
            return [
                'id' => $comment->getId(),
                'content' => $comment->getContent(),
                'author' => $comment->getAuthor(),
                'createdAt' => $comment->getCreatedAt(),
                'updatedAt' => $comment->getUpdatedAt(),
            ];
        });
        $normalizers->add(\DateTimeImmutable::class, function(\DateTimeImmutable $dt) {
            return $dt->format(\DATE_ATOM);
        });
        $normalizers->add(Category::class, function(Category $category) {
            return [
                'id' => $category->getId(),
                'parent' => $category->getParent(),
                'children' => $category->getChildren(),
                'createdAt' => $category->getCreatedAt(),
                'updatedAt' => $category->getUpdatedAt(),
            ];
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
