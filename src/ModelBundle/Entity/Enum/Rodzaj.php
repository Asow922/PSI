<?php

namespace ModelBundle\Entity\Enum;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rodzaj
 *
 * @ORM\Table(name="rodzaj")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\RodzajRepository")
 */
class Rodzaj
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
     * @ORM\Column(name="short_code", type="string", length=255)
     */
    private $shortCode;

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
     * Set shortCode
     *
     * @param string $shortCode
     *
     * @return Rodzaj
     */
    public function setShortCode($shortCode)
    {
        $this->shortCode = $shortCode;

        return $this;
    }

    /**
     * Get shortCode
     *
     * @return string
     */
    public function getShortCode()
    {
        return $this->shortCode;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Rodzaj
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

