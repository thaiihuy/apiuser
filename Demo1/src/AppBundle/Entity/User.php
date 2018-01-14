<?php
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @package AppBundle\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Column(type="string")
     */
    public  $username;
    /**
     * @ORM\Column(type="string")
     */
    public  $pass;
}