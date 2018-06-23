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
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\Kurs", inversedBy="efektKierunkowy", cascade={"all"})
     * @ORM\JoinTable(name="efekt_kierunkowy_kurs")
     */
    private $kurs;

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
    public function getEfektPrzedmiotowy()
    {
        return $this->efektPrzedmiotowy;
    }

    /**
     * @param ArrayCollection $efektPrzedmiotowy
     */
    public function setEfektPrzedmiotowy( $efektPrzedmiotowy)
    {
        $this->efektPrzedmiotowy = $efektPrzedmiotowy;
    }

    /**
     * @return EfektMinisterialny
     */
    public function getEfektMinisterialny()
    {
        return $this->efektMinisterialny;
    }

    /**
     * @param EfektMinisterialny $efektMinisterialny
     */
    public function setEfektMinisterialny( $efektMinisterialny)
    {
        $this->efektMinisterialny = $efektMinisterialny;
    }

    /**
     * @return ArrayCollection
     */
    public function getKurs()
    {
        return $this->kurs;
    }

    /**
     * @param ArrayCollection $kurs
     */
    public function setKurs( $kurs)
    {
        $this->kurs = $kurs;
    }

    /**
     * @return ArrayCollection
     */
    public function getProgramKsztalcenia()
    {
        return $this->programKsztalcenia;
    }

    /**
     * @param ArrayCollection $programKsztalcenia
     */
    public function setProgramKsztalcenia( $programKsztalcenia)
    {
        $this->programKsztalcenia = $programKsztalcenia;
    }

    public function __toString() {
	    return $this->identyfikator.'';
    }

    /**
     * @param Kurs $kurs
     */
    public function addKurs( $kurs)
    {
        if (!$this->kurs->contains($kurs)) {
            $this->kurs->add($kurs);
        }
    }

    public function removeKurs($kurs)
    {
        if ($this->kurs->contains($kurs)) {
            $this->kurs->removeElement($kurs);
        }
    }

    public function addProgramKsztalcenia($programKsztalcenia)
    {
        $this->programKsztalcenia->add($programKsztalcenia);
    }
}

