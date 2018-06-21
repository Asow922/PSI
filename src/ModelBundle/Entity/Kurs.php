<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\FormaKursu;
use ModelBundle\Entity\Enum\FormaZajec;
use ModelBundle\Entity\Enum\Rodzaj;
use ModelBundle\Entity\Enum\SposobZaliczenia;
use ModelBundle\Entity\Enum\Typ;

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
     * @ORM\Column(name="ects", type="integer", nullable=true)
     */
    private $ects;

    /**
     * @var int
     *
     * @ORM\Column(name="ZZU", type="integer", nullable=true)
     */
    private $zZU;

    /**
     * @var FormaKursu
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\FormaKursu")
     * @ORM\JoinColumn(name="forma_kursu_id", referencedColumnName="id")
     */
    private $formaKursu;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ogolnoUczelniany", type="boolean", nullable=true)
     */
    private $ogolnoUczelniany;

    /**
     * @var boolean
     *
     * @ORM\Column(name="praktyczny", type="boolean", nullable=true)
     */
    private $praktyczny;

    /**
     * @var Typ
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Typ")
     * @ORM\JoinColumn(name="typ_id", referencedColumnName="id")
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
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\EfektKierunkowy", mappedBy="kurs")
     */
    private $efektKierunkowy;

    /**
     * Kurs constructor.
     */
    public function __construct()
    {
        $this->modulKsztalcenia = new ArrayCollection();
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
     * @param FormaKursu $formaKursu
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
     * @return FormaKursu
     */
    public function getFormaKursu()
    {
        return $this->formaKursu;
    }

    /**
     * Set ogolnoUczelniany
     *
     * @param boolean $ogolnoUczelniany
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
     * @return boolean
     */
    public function isOgolnoUczelniany()
    {
        return $this->ogolnoUczelniany;
    }

    /**
     * Set praktyczny
     *
     * @param boolean $praktyczny
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
     * @return boolean
     */
    public function isPraktyczny()
    {
        return $this->praktyczny;
    }

    /**
     * Set typ
     *
     * @param Typ $typ
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
     * @return Typ
     */
    public function getTyp()
    {
        return $this->typ;
    }

    /**
     * @return Przedmiot
     */
    public function getPrzedmiot()
    {
        return $this->przedmiot;
    }

    /**
     * @param Przedmiot $przedmiot
     */
    public function setPrzedmiot(Przedmiot $przedmiot)
    {
        $this->przedmiot = $przedmiot;
    }

    /**
     * @return ArrayCollection
     */
    public function getModulKsztalcenia()
    {
        return $this->modulKsztalcenia;
    }

    /**
     * @param ArrayCollection $modulKsztalcenia
     */
    public function setModulKsztalcenia(ArrayCollection $modulKsztalcenia)
    {
        $this->modulKsztalcenia = $modulKsztalcenia;
    }

    /**
     * @return GrupaKursow
     */
    public function getGrupaKursow()
    {
        return $this->grupaKursow;
    }

    /**
     * @param GrupaKursow $grupaKursow
     */
    public function setGrupaKursow(GrupaKursow $grupaKursow)
    {
        $this->grupaKursow = $grupaKursow;
    }

    /**
     * @return FormaZajec
     */
    public function getForma()
    {
        return $this->forma;
    }

    /**
     * @param FormaZajec $forma
     */
    public function setForma(FormaZajec $forma)
    {
        $this->forma = $forma;
    }

    /**
     * @return SposobZaliczenia
     */
    public function getSposobZaliczenia()
    {
        return $this->sposobZaliczenia;
    }

    /**
     * @param SposobZaliczenia $sposobZaliczenia
     */
    public function setSposobZaliczenia(SposobZaliczenia $sposobZaliczenia)
    {
        $this->sposobZaliczenia = $sposobZaliczenia;
    }

    /**
     * @return Rodzaj
     */
    public function getRodzaj()
    {
        return $this->rodzaj;
    }

    /**
     * @param Rodzaj $rodzaj
     */
    public function setRodzaj(Rodzaj $rodzaj)
    {
        $this->rodzaj = $rodzaj;
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
    public function setEfektKierunkowy(ArrayCollection $efektKierunkowy)
    {
        $this->efektKierunkowy = $efektKierunkowy;
    }

    /**
     * @param EfektKierunkowy $efektKierunkowy
     */
    public function addEfektKierunkowy(EfektKierunkowy $efektKierunkowy)
    {
        $efektKierunkowy->addKurs($this);
        $this->efektKierunkowy->add($efektKierunkowy);
    }

    public function removeEfektKierunkowy(EfektKierunkowy $efektKierunkowy)
    {
        $efektKierunkowy->removeKurs($this);
        $this->efektKierunkowy->removeElement($efektKierunkowy);
    }

    public function __toString()
    {
        return $this->przedmiot->getNazwa().' - '.$this->forma;
    }

    public function addModulKsztalcenia($modulKsztalcenia)
    {
        $this->modulKsztalcenia->add($modulKsztalcenia);
    }
}

