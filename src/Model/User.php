<?php

namespace Ivory\Tests\Serializer\Benchmark\Model;

use Ivory\Serializer\Mapping\Annotation as Ivory;
use JMS\Serializer\Annotation as Jms;
use Symfony\Component\Serializer\Annotation as Symfony;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class User
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
    private $firstname;

    /**
     * @Ivory\Type("string")
     * @Jms\Type("string")
     *
     * @var string
     */
    private $lastname;

    /**
     * @Ivory\Type("bool")
     * @Jms\Type("boolean")
     *
     * @var bool
     */
    private $newsletter;
}
