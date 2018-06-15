<?php

namespace ModelBundle\Entity\Enum;

use Doctrine\ORM\Mapping as ORM;

/**
 * Jezyk
 *
 * @ORM\Table(name="jezyk")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\JezykRepository")
 */
class Jezyk
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

