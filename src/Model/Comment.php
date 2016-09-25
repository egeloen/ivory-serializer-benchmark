<?php

namespace Ivory\Tests\Serializer\Benchmark\Model;

use Ivory\Serializer\Mapping\Annotation as Ivory;
use JMS\Serializer\Annotation as Jms;
use Symfony\Component\Serializer\Annotation as Symfony;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class Comment
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
     * @Ivory\Type("string")
     * @Jms\Type("string")
     *
     * @var string
     */
    private $content;

    /**
     * @Ivory\Type("Ivory\Tests\Serializer\Benchmark\Model\User")
     * @Jms\Type("Ivory\Tests\Serializer\Benchmark\Model\User")
     *
     * @var User
     */
    private $author;

    /**
     * @param int       $id
     * @param string    $content
     * @param User|null $author
     */
    public function __construct($id, $content, User $author = null)
    {
        $this->setId($id);
        $this->setContent($content);
        $this->setAuthor($author);
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
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return User|null
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param User|null $author
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;
    }
}
