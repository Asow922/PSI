<?php

namespace ModelBundle\Entity\Enum;

use Doctrine\ORM\Mapping as ORM;

/**
 * PoziomKsztalcenia
 *
 * @ORM\Table(name="poziom_ksztalcenia")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\PoziomKsztalceniaRepository")
 */
class PoziomKsztalcenia
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return PoziomKsztalcenia
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}

