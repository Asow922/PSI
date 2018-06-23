<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ModulKsztalcenia
 *
 * @ORM\Table(name="modul_ksztalcenia")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\ModulKsztalceniaRepository")
 */
class ModulKsztalcenia
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
     * @ORM\Column(name="nazwa", type="string", length=255)
     */
    private $nazwa;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\ProgramStudiow", mappedBy="modulKsztalcenia")
     */
    private $programStudiow;

    /**
     * @var Semestr
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Semestr", inversedBy="modulKsztalcenia")
     * @ORM\JoinColumn(name="semestr_id", referencedColumnName="id")
     */
    private $semestr;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\Przedmiot", mappedBy="modulKsztalcenia")
     */
    private $przedmiot;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\ModulKsztalcenia", mappedBy="nadrzedny")
     */
    private $podrzedny;

    /**
     * @var ModulKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\ModulKsztalcenia", inversedBy="podrzedny")
     * @ORM\JoinColumn(name="nadrzedny_id", referencedColumnName="id")
     */
    private $nadrzedny;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\Kurs", inversedBy="modulKsztalcenia")
     * @ORM\JoinTable(name="modul_ksztalcenia_kurs")
     */
    private $kurs;

    /**
     * ModulKsztalcenia constructor.
     */
    public function __construct()
    {
        $this->kurs = new ArrayCollection();
        $this->podrzedny = new ArrayCollection();
        $this->przedmiot = new ArrayCollection();
        $this->programStudiow = new ArrayCollection();
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
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return ModulKsztalcenia
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;

        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * @return ArrayCollection
     */
    public function getProgramStudiow()
    {
        return $this->programStudiow;
    }

    /**
     * @param ArrayCollection $programStudiow
     */
    public function setProgramStudiow( $programStudiow)
    {
        $this->programStudiow = $programStudiow;
    }

    /**
     * @param ProgramStudiow $programStudiow
     */
    public function addProgramStudiow( $programStudiow)
    {
        $programStudiow->addModulKsztalcenia($this);
        $this->programStudiow->add($programStudiow);
    }

    /**
     * @return Semestr
     */
    public function getSemestr()
    {
        return $this->semestr;
    }

    /**
     * @param Semestr $semestr
     */
    public function setSemestr( $semestr)
    {
        $this->semestr = $semestr;
    }

    /**
     * @return ArrayCollection
     */
    public function getPrzedmiot()
    {
        return $this->przedmiot;
    }

    /**
     * @param ArrayCollection $przedmiot
     */
    public function setPrzedmiot( $przedmiot)
    {
        $this->przedmiot = $przedmiot;
    }

    /**
     * @return ArrayCollection
     */
    public function getPodrzedny()
    {
        return $this->podrzedny;
    }

    /**
     * @param ArrayCollection $podrzedny
     */
    public function setPodrzedny( $podrzedny)
    {
        $this->podrzedny = $podrzedny;
    }

    /**
     * @return ModulKsztalcenia
     */
    public function getNadrzedny()
    {
        return $this->nadrzedny;
    }

    /**
     * @param ModulKsztalcenia $nadrzedny
     */
    public function setNadrzedny( $nadrzedny)
    {
        $this->nadrzedny = $nadrzedny;
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
     * @param ModulKsztalcenia $modulKsztalcenia
     */
    public function addPodrzedny($modulKsztalcenia)
    {
        $modulKsztalcenia->setNadrzedny($this);
        $this->podrzedny->add($modulKsztalcenia);
    }

    public function __toString()
    {
        return $this->nazwa;
    }


}

