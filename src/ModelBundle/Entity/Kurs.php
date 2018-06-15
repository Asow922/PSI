<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\FormaZajec;
use ModelBundle\Entity\Enum\Rodzaj;
use ModelBundle\Entity\Enum\SposobZaliczenia;

/**
 * Kurs
 *
 * @ORM\Table(name="kurs")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\KursRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="grupped", type="string")
 * @ORM\DiscriminatorMap({"kurs" = "ModelBundle\Entity\Kurs", "grupaKursow" = "ModelBundle\Entity\GrupaKursow"})
 *
 */
class Kurs
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
     * @var int
     *
     * @ORM\Column(name="ects", type="integer")
     */
    private $ects;

    /**
     * @var int
     *
     * @ORM\Column(name="ZZU", type="integer")
     */
    private $zZU;

    /**
     * @var int
     *
     * @ORM\Column(name="formaKursu", type="integer")
     */
    private $formaKursu;

    /**
     * @var int
     *
     * @ORM\Column(name="ogolnoUczelniany", type="integer")
     */
    private $ogolnoUczelniany;

    /**
     * @var int
     *
     * @ORM\Column(name="praktyczny", type="integer")
     */
    private $praktyczny;

    /**
     * @var string
     *
     * @ORM\Column(name="typ", type="string", length=255)
     */
    private $typ;

    /**
     * @var Przedmiot
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Przedmiot", inversedBy="kurs")
     * @ORM\JoinColumn(name="przedmiot_id", referencedColumnName="id")
     */
    private $przedmiot;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\ModulKsztalcenia", mappedBy="kurs")
     */
    private $modulKsztalcenia;

    /**
     * @var GrupaKursow
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\GrupaKursow", inversedBy="kurs")
     * @ORM\JoinColumn(name="grupa_kursow_id", referencedColumnName="id")
     */
    private $grupaKursow;

    /**
     * @var FormaZajec
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\FormaZajec")
     * @ORM\JoinColumn(name="forma_zajec_id", referencedColumnName="id")
     */
    private $forma;

    /**
     * @var SposobZaliczenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\SposobZaliczenia")
     * @ORM\JoinColumn(name="sposb_zaliczenia_id", referencedColumnName="id")
     */
    private $sposobZaliczenia;

    /**
     * @var Rodzaj
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Rodzaj")
     * @ORM\JoinColumn(name="rodzaj_id", referencedColumnName="id")
     */
    private $rodzaj;

    /**
     * Kurs constructor.
     */
    public function __construct()
    {
        $this->modulKsztalcenia = new ArrayCollection();
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
     * Set ects
     *
     * @param integer $ects
     *
     * @return Kurs
     */
    public function setEcts($ects)
    {
        $this->ects = $ects;

        return $this;
    }

    /**
     * Get ects
     *
     * @return int
     */
    public function getEcts()
    {
        return $this->ects;
    }

    /**
     * Set zZU
     *
     * @param integer $zZU
     *
     * @return Kurs
     */
    public function setZZU($zZU)
    {
        $this->zZU = $zZU;

        return $this;
    }

    /**
     * Get zZU
     *
     * @return int
     */
    public function getZZU()
    {
        return $this->zZU;
    }

    /**
     * Set formaKursu
     *
     * @param integer $formaKursu
     *
     * @return Kurs
     */
    public function setFormaKursu($formaKursu)
    {
        $this->formaKursu = $formaKursu;

        return $this;
    }

    /**
     * Get formaKursu
     *
     * @return int
     */
    public function getFormaKursu()
    {
        return $this->formaKursu;
    }

    /**
     * Set ogolnoUczelniany
     *
     * @param integer $ogolnoUczelniany
     *
     * @return Kurs
     */
    public function setOgolnoUczelniany($ogolnoUczelniany)
    {
        $this->ogolnoUczelniany = $ogolnoUczelniany;

        return $this;
    }

    /**
     * Get ogolnoUczelniany
     *
     * @return int
     */
    public function getOgolnoUczelniany()
    {
        return $this->ogolnoUczelniany;
    }

    /**
     * Set praktyczny
     *
     * @param integer $praktyczny
     *
     * @return Kurs
     */
    public function setPraktyczny($praktyczny)
    {
        $this->praktyczny = $praktyczny;

        return $this;
    }

    /**
     * Get praktyczny
     *
     * @return int
     */
    public function getPraktyczny()
    {
        return $this->praktyczny;
    }

    /**
     * Set typ
     *
     * @param string $typ
     *
     * @return Kurs
     */
    public function setTyp($typ)
    {
        $this->typ = $typ;

        return $this;
    }

    /**
     * Get typ
     *
     * @return string
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * @return Przedmiot
     */
    public function getPrzedmiot(): Przedmiot
    {
        return $this->przedmiot;
    }

    /**
     * @param Przedmiot $przedmiot
     */
    public function setPrzedmiot(Przedmiot $przedmiot): void
    {
        $this->przedmiot = $przedmiot;
    }

    /**
     * @return ArrayCollection
     */
    public function getModulKsztalcenia(): ArrayCollection
    {
        return $this->modulKsztalcenia;
    }

    /**
     * @param ArrayCollection $modulKsztalcenia
     */
    public function setModulKsztalcenia(ArrayCollection $modulKsztalcenia): void
    {
        $this->modulKsztalcenia = $modulKsztalcenia;
    }

    /**
     * @return GrupaKursow
     */
    public function getGrupaKursow(): GrupaKursow
    {
        return $this->grupaKursow;
    }

    /**
     * @param GrupaKursow $grupaKursow
     */
    public function setGrupaKursow(GrupaKursow $grupaKursow): void
    {
        $this->grupaKursow = $grupaKursow;
    }

    /**
     * @return FormaZajec
     */
    public function getForma(): FormaZajec
    {
        return $this->forma;
    }

    /**
     * @param FormaZajec $forma
     */
    public function setForma(FormaZajec $forma): void
    {
        $this->forma = $forma;
    }

    /**
     * @return SposobZaliczenia
     */
    public function getSposobZaliczenia(): SposobZaliczenia
    {
        return $this->sposobZaliczenia;
    }

    /**
     * @param SposobZaliczenia $sposobZaliczenia
     */
    public function setSposobZaliczenia(SposobZaliczenia $sposobZaliczenia): void
    {
        $this->sposobZaliczenia = $sposobZaliczenia;
    }

    /**
     * @return Rodzaj
     */
    public function getRodzaj(): Rodzaj
    {
        return $this->rodzaj;
    }

    /**
     * @param Rodzaj $rodzaj
     */
    public function setRodzaj(Rodzaj $rodzaj): void
    {
        $this->rodzaj = $rodzaj;
    }
}

