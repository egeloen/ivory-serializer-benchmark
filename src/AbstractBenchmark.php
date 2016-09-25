<?php

namespace Ivory\Tests\Serializer\Benchmark;

use Ivory\Tests\Serializer\Benchmark\Model\Category;
use Ivory\Tests\Serializer\Benchmark\Model\Comment;
use Ivory\Tests\Serializer\Benchmark\Model\Forum;
use Ivory\Tests\Serializer\Benchmark\Model\Thread;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
abstract class AbstractBenchmark implements BenchmarkInterface
{
    public function setUp()
    {
    }

    /**
     * @return string
     */
    protected function getFormat()
    {
        return 'json';
    }

    /**
     * @param int $horizontalComplexity
     * @param int $verticalComplexity
     *
     * @return Forum
     */
    protected function getData($horizontalComplexity = 1, $verticalComplexity = 1)
    {
        $forum = new Forum(1, 'Great name!');
        $forum->setCategory($this->createCategory($verticalComplexity));

        for ($i = 0; $i < $horizontalComplexity * 2; ++$i) {
            $forum->addThread($this->createThread($i, $horizontalComplexity));
        }

        return $forum;
    }

    /**
     * @param int $verticalComplexity
     *
     * @return Category
     */
    private function createCategory($verticalComplexity = 1)
    {
        $original = $category = new Category(1);

        for ($i = 0; $i < $verticalComplexity * 2; ++$i) {
            $category->setParent($parent = new Category($i + 1));
            $category = $parent;
        }

        return $original;
    }

    /**
     * @param int $index
     * @param int $horizontalComplexity
     *
     * @return Thread
     */
    private function createThread($index, $horizontalComplexity = 1)
    {
        $thread = new Thread($index, 'Great thread '.$index.'!', 'Great description '.$index, $index / 100);

        for ($i = 0; $i < $horizontalComplexity * 5; ++$i) {
            $thread->addComment($this->createComment($index * $i + $i));
        }

        return $thread;
    }

    /**
     * @param int $index
     *
     * @return Comment
     */
    private function createComment($index)
    {
        return new Comment($index, 'Great comment '.$index.'!');
    }
}
