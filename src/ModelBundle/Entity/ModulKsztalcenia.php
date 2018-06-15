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
    public function getProgramStudiow(): ArrayCollection
    {
        return $this->programStudiow;
    }

    /**
     * @param ArrayCollection $programStudiow
     */
    public function setProgramStudiow(ArrayCollection $programStudiow): void
    {
        $this->programStudiow = $programStudiow;
    }

    /**
     * @return Semestr
     */
    public function getSemestr(): Semestr
    {
        return $this->semestr;
    }

    /**
     * @param Semestr $semestr
     */
    public function setSemestr(Semestr $semestr): void
    {
        $this->semestr = $semestr;
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
    public function getPodrzedny(): ArrayCollection
    {
        return $this->podrzedny;
    }

    /**
     * @param ArrayCollection $podrzedny
     */
    public function setPodrzedny(ArrayCollection $podrzedny): void
    {
        $this->podrzedny = $podrzedny;
    }

    /**
     * @return ModulKsztalcenia
     */
    public function getNadrzedny(): ModulKsztalcenia
    {
        return $this->nadrzedny;
    }

    /**
     * @param ModulKsztalcenia $nadrzedny
     */
    public function setNadrzedny(ModulKsztalcenia $nadrzedny): void
    {
        $this->nadrzedny = $nadrzedny;
    }

    /**
     * @return ArrayCollection
     */
    public function getKurs(): ArrayCollection
    {
        return $this->kurs;
    }

    /**
     * @param ArrayCollection $kurs
     */
    public function setKurs(ArrayCollection $kurs): void
    {
        $this->kurs = $kurs;
    }
}

