<?php

namespace Ivory\Tests\Serializer\Benchmark\Model;

use Ivory\Serializer\Mapping\Annotation as Ivory;
use JMS\Serializer\Annotation as Jms;
use Symfony\Component\Serializer\Annotation as Symfony;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Category implements \JsonSerializable
{
    use TimestampableTrait;

    /**
     * @Ivory\Type("int")
     * @Jms\Type("integer")
     *
     * @var int
     */
    private $id;

    /**
     * @Ivory\Type("Ivory\Tests\Serializer\Benchmark\Model\Category")
     * @Jms\Type("Ivory\Tests\Serializer\Benchmark\Model\Category")
     *
     * @var Category|null
     */
    private $parent;

    /**
     * @Ivory\Type("array<key=int, value=Ivory\Tests\Serializer\Benchmark\Model\Category>")
     * @Jms\Type("array<integer, Ivory\Tests\Serializer\Benchmark\Model\Category>")
     *
     * @var Category[]
     */
    private $children = [];

    /**
     * @param int           $id
     * @param Category|null $parent
     * @param Category[]    $children
     */
    public function __construct($id, Category $parent = null, array $children = [])
    {
        $this->setId($id);
        $this->setParent($parent);
        $this->setChildren($children);
        $this->initializeTimestampable();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Category|null
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Category|null $parent
     */
    public function setParent(Category $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * @return Category[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Category[] $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }

    /**
     * @param Category $child
     */
    public function addChild(Category $child)
    {
        $this->children[] = $child;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'parent' => $this->parent,
            'children' => $this->children,
            'createdAt' => $this->createdAt instanceof \DateTimeInterface ? $this->createdAt->format(\DateTime::ATOM) : null,
            'updatedAt' => $this->updatedAt instanceof \DateTimeInterface ? $this->updatedAt->format(\DateTime::ATOM) : null,
        ];
    }
}
