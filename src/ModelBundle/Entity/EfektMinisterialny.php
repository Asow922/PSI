<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Traits\EfektKsztalcenia;

/**
 * EfektMinisterialny
 *
 * @ORM\Table(name="efekt_ministerialny")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\EfektMinisterialnyRepository")
 */
class EfektMinisterialny
{
    use EfektKsztalcenia;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\Enum\ObszarKsztalcenia")
     * @ORM\JoinTable(name="efekt_ministerialny_obszar_ksztalcenia",
     *     joinColumns={@ORM\JoinColumn(name="efekt_ministerialny_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="obszar_ksztalcenia_id", referencedColumnName="id")}
     *     )
     */
    private $obszar;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\EfektKierunkowy", mappedBy="efektMinisterialny")
     */
    private $efektKierunkowy;

    /**
     * EfektMinisterialny constructor.
     * @param ArrayCollection $obszar
     */
    public function __construct()
    {
        $this->obszar = new ArrayCollection();
        $this->efektKierunkowy = new ArrayCollection();
    }

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
     * @return ArrayCollection
     */
    public function getObszar()
    {
        return $this->obszar;
    }

    /**
     * @param ArrayCollection $obszar
     */
    public function setObszar( $obszar)
    {
        $this->obszar = $obszar;
    }

    /**
     * @return ArrayCollection
     */
    public function getEfektKierunkowy()
    {
        return $this->efektKierunkowy;
    }

    /**
     * @param ArrayCollection $efektKierunkowy
     */
    public function setEfektKierunkowy( $efektKierunkowy)
    {
        $this->efektKierunkowy = $efektKierunkowy;
    }

    public function __toString() {
	    return $this->identyfikator.'';
    }
}

