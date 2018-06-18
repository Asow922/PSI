<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
        const ROLE_ZAINTERESOWANY = "ROLE_ZAINTERESOWANY";
        const ROLE_AUTOR_PROGRAMU_KSZTALCENIA = "ROLE_AUTOR_PROGRAMU_KSZTALCENIA";
        const ROLE_OPIEKUN_PRZEDMIOTU = "ROLE_OPIEKUN_PRZEDMIOTU";
        const ROLE_ADMIN = "ROLE_ADMIN";
        const ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN";

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
