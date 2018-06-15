<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Traits\EfektKsztalcenia;

/**
 * EfektPrzedmiotowy
 *
 * @ORM\Table(name="efekt_przedmiotowy")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\EfektPrzedmiotowyRepository")
 */
class EfektPrzedmiotowy
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
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\KartaPrzedmiotu", mappedBy="efektPrzedmiotowy")
     */
    private $kartaPrzedmiotu;

    /**
     * @var EfektKierunkowy
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\EfektKierunkowy", inversedBy="efektPrzedmiotowy")
     * @ORM\JoinColumn(name="efekt_kierunkowy_id", referencedColumnName="id")
     */
    private $efektKierunkowy;

    /**
     * EfektPrzedmiotowy constructor.
     * @param ArrayCollection $kartaPrzedmiotu
     */
    public function __construct()
    {
        $this->kartaPrzedmiotu = new ArrayCollection();
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
    public function getKartaPrzedmiotu(): ArrayCollection
    {
        return $this->kartaPrzedmiotu;
    }

    /**
     * @param ArrayCollection $kartaPrzedmiotu
     */
    public function setKartaPrzedmiotu(ArrayCollection $kartaPrzedmiotu): void
    {
        $this->kartaPrzedmiotu = $kartaPrzedmiotu;
    }

    /**
     * @return EfektKierunkowy
     */
    public function getEfektKierunkowy(): EfektKierunkowy
    {
        return $this->efektKierunkowy;
    }

    /**
     * @param EfektKierunkowy $efektKierunkowy
     */
    public function setEfektKierunkowy(EfektKierunkowy $efektKierunkowy): void
    {
        $this->efektKierunkowy = $efektKierunkowy;
    }
}

