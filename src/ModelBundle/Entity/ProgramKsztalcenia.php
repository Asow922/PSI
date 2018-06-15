<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\Jezyk;
use ModelBundle\Entity\Enum\PoziomKsztalcenia;
use ModelBundle\Entity\Enum\ProfilKsztalcenia;
use ModelBundle\Entity\Enum\Tytul;

/**
 * ProgramKsztalcenia
 *
 * @ORM\Table(name="program_ksztalcenia")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\ProgramKsztalceniaRepository")
 */
class ProgramKsztalcenia
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
     * @ORM\Column(name="specjalnosc", type="string", length=255)
     */
    private $specjalnosc;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\EfektKierunkowy", mappedBy="programKsztalcenia")
     */
    private $efektKierunkowy;

    /**
     * @var PoziomKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\PoziomKsztalcenia")
     * @ORM\JoinColumn(name="poziom_ksztalcenia_id", referencedColumnName="id")
     */
    private $poziom;

    /**
     * @var ProfilKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\ProfilKsztalcenia")
     * @ORM\JoinColumn(name="profil_ksztalcenia_id", referencedColumnName="id")
     */
    private $profil;

    /**
     * @var Tytul
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Tytul")
     * @ORM\JoinColumn(name="tytul_id", referencedColumnName="id")
     */
    private $tytul;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\Enum\ObszarKsztalcenia")
     * @ORM\JoinTable(name="program_ksztalcenia_obszar_ksztalcenia",
     *     joinColumns={@ORM\JoinColumn(name="efekt_ministerialny_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="obszar_ksztalcenia_id", referencedColumnName="id")}
     *     )
     */
    private $obszar;

    /**
     * @var Jezyk
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Jezyk")
     * @ORM\JoinColumn(name="jezyk_id", referencedColumnName="id")
     */
    private $jezyk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cykl", type="date")
     */
    private $cykl;

    /**
     * @var KierunekStudiow
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\KierunekStudiow", inversedBy="programKsztalcenia")
     * @ORM\JoinColumn(name="kierunek_studiow_id", referencedColumnName="id")
     */
    private $kierunekStudiow;

    /**
     * @var ProgramStudiow
     *
     * @ORM\OneToOne(targetEntity="ModelBundle\Entity\ProgramStudiow", mappedBy="programKsztalcenia")
     */
    private $programStudiow;

    /**
     * ProgramKsztalcenia constructor.
     * @param int $id
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
     * Set specjalnosc
     *
     * @param string $specjalnosc
     *
     * @return ProgramKsztalcenia
     */
    public function setSpecjalnosc($specjalnosc)
    {
        $this->specjalnosc = $specjalnosc;

        return $this;
    }

    /**
     * Get specjalnosc
     *
     * @return string
     */
    public function getSpecjalnosc()
    {
        return $this->specjalnosc;
    }

    /**
     * @return ArrayCollection
     */
    public function getEfektKierunkowy(): ArrayCollection
    {
        return $this->efektKierunkowy;
    }

    /**
     * @param ArrayCollection $efektKierunkowy
     */
    public function setEfektKierunkowy(ArrayCollection $efektKierunkowy): void
    {
        $this->efektKierunkowy = $efektKierunkowy;
    }

    /**
     * @return PoziomKsztalcenia
     */
    public function getPoziom(): PoziomKsztalcenia
    {
        return $this->poziom;
    }

    /**
     * @param PoziomKsztalcenia $poziom
     */
    public function setPoziom(PoziomKsztalcenia $poziom): void
    {
        $this->poziom = $poziom;
    }

    /**
     * @return ProfilKsztalcenia
     */
    public function getProfil(): ProfilKsztalcenia
    {
        return $this->profil;
    }

    /**
     * @param ProfilKsztalcenia $profil
     */
    public function setProfil(ProfilKsztalcenia $profil): void
    {
        $this->profil = $profil;
    }

    /**
     * @return Tytul
     */
    public function getTytul(): Tytul
    {
        return $this->tytul;
    }

    /**
     * @param Tytul $tytul
     */
    public function setTytul(Tytul $tytul): void
    {
        $this->tytul = $tytul;
    }

    /**
     * @return ArrayCollection
     */
    public function getObszar(): ArrayCollection
    {
        return $this->obszar;
    }

    /**
     * @param ArrayCollection $obszar
     */
    public function setObszar(ArrayCollection $obszar): void
    {
        $this->obszar = $obszar;
    }

    /**
     * @return Jezyk
     */
    public function getJezyk(): Jezyk
    {
        return $this->jezyk;
    }

    /**
     * @param Jezyk $jezyk
     */
    public function setJezyk(Jezyk $jezyk): void
    {
        $this->jezyk = $jezyk;
    }

    /**
     * @return \DateTime
     */
    public function getCykl(): \DateTime
    {
        return $this->cykl;
    }

    /**
     * @param \DateTime $cykl
     */
    public function setCykl(\DateTime $cykl): void
    {
        $this->cykl = $cykl;
    }

    /**
     * @return KierunekStudiow
     */
    public function getKierunekStudiow(): KierunekStudiow
    {
        return $this->kierunekStudiow;
    }

    /**
     * @param KierunekStudiow $kierunekStudiow
     */
    public function setKierunekStudiow(KierunekStudiow $kierunekStudiow): void
    {
        $this->kierunekStudiow = $kierunekStudiow;
    }

    /**
     * @return ProgramStudiow
     */
    public function getProgramStudiow(): ProgramStudiow
    {
        return $this->programStudiow;
    }

    /**
     * @param ProgramStudiow $programStudiow
     */
    public function setProgramStudiow(ProgramStudiow $programStudiow): void
    {
        $this->programStudiow = $programStudiow;
    }
}

