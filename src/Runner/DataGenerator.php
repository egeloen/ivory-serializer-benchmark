<?php
declare(strict_types=1);

/**
 * @author Martin Fris <rasta@lj.sk>
 */

namespace Ivory\Tests\Serializer\Benchmark\Runner;

use Ivory\Tests\Serializer\Benchmark\Model\Category;
use Ivory\Tests\Serializer\Benchmark\Model\Comment;
use Ivory\Tests\Serializer\Benchmark\Model\Forum;
use Ivory\Tests\Serializer\Benchmark\Model\Thread;

/**
 * Class DataGenerator
 * @author mfris
 * @package Ivory\Tests\Serializer\Benchmark\Runner
 */
final class DataGenerator
{

    /**
     * @param int $horizontalComplexity
     * @param int $verticalComplexity
     *
     * @return Forum
     */
    public function getData(int $horizontalComplexity = 1, int $verticalComplexity = 1): Forum
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
    private function createCategory(int $verticalComplexity = 1): Category
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
    private function createThread($index, $horizontalComplexity = 1): Thread
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
    private function createComment($index): Comment
    {
        return new Comment($index, 'Great comment '.$index.'!');
    }
}
