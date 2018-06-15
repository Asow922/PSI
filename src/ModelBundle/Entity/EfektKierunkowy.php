<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Traits\EfektKsztalcenia;

/**
 * EfektKierunkowy
 *
 * @ORM\Table(name="efekt_kierunkowy")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\EfektKierunkowyRepository")
 */
class EfektKierunkowy
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
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\EfektPrzedmiotowy", mappedBy="efektKierunkowy")
     */
    private $efektPrzedmiotowy;

    /**
     * @var EfektMinisterialny
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\EfektMinisterialny", inversedBy="efektKierunkowy")
     * @ORM\JoinColumn(name="efekt_ministerialny_id", referencedColumnName="id")
     */
    private $efektMinisterialny;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\Przedmiot", inversedBy="efektKierunkowy")
     * @ORM\JoinTable(name="efekt_kierunkowy_przedmiot")
     */
    private $przedmiot;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\ProgramKsztalcenia", inversedBy="efektKierunkowy")
     * @ORM\JoinTable(name="efekt_kierunkowy_program_ksztalcenia")
     */
    private $programKsztalcenia;

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
    public function getEfektPrzedmiotowy(): ArrayCollection
    {
        return $this->efektPrzedmiotowy;
    }

    /**
     * @param ArrayCollection $efektPrzedmiotowy
     */
    public function setEfektPrzedmiotowy(ArrayCollection $efektPrzedmiotowy): void
    {
        $this->efektPrzedmiotowy = $efektPrzedmiotowy;
    }

    /**
     * @return EfektMinisterialny
     */
    public function getEfektMinisterialny(): EfektMinisterialny
    {
        return $this->efektMinisterialny;
    }

    /**
     * @param EfektMinisterialny $efektMinisterialny
     */
    public function setEfektMinisterialny(EfektMinisterialny $efektMinisterialny): void
    {
        $this->efektMinisterialny = $efektMinisterialny;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrzedmiot(): ArrayCollection
    {
        return $this->przedmiot;
    }

    /**
     * @param ArrayCollection $przedmiot
     */
    public function setPrzedmiot(ArrayCollection $przedmiot): void
    {
        $this->przedmiot = $przedmiot;
    }

    /**
     * @return ArrayCollection
     */
    public function getProgramKsztalcenia(): ArrayCollection
    {
        return $this->programKsztalcenia;
    }

    /**
     * @param ArrayCollection $programKsztalcenia
     */
    public function setProgramKsztalcenia(ArrayCollection $programKsztalcenia): void
    {
        $this->programKsztalcenia = $programKsztalcenia;
    }
}

