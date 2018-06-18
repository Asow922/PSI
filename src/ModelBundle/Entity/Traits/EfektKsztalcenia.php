<?php

namespace ModelBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\PoziomKsztalcenia;
use ModelBundle\Entity\Enum\ProfilKsztalcenia;
use ModelBundle\Entity\Enum\Zakres;

trait EfektKsztalcenia
{
    /**
     * @var string
     *
     * @ORM\Column(name="identyfikator", type="string", length=255, unique=true)
     */
    private $identyfikator;

    /**
     * @var string
     *
     * @ORM\Column(name="opis", type="string", length=255)
     */
    private $opis;

    /**
     * @var ProfilKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\ProfilKsztalcenia")
     * @ORM\JoinColumn(name="profil_ksztalcenia_id", referencedColumnName="id")
     */
    private $profil;

    /**
     * @var PoziomKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\PoziomKsztalcenia")
     * @ORM\JoinColumn(name="poziom_ksztalcenia_id", referencedColumnName="id")
     */
    private $poziom;

    /**
     * @var Zakres
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Zakres")
     * @ORM\JoinColumn(name="zakres_id", referencedColumnName="id")
     */
    private $zakres;

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
     * Set identyfikator
     *
     * @param string $identyfikator
     *
     * @return EfektKsztalcenia
     */
    public function setIdentyfikator($identyfikator)
    {
        $this->identyfikator = $identyfikator;

        return $this;
    }

    /**
     * Get identyfikator
     *
     * @return string
     */
    public function getIdentyfikator()
    {
        return $this->identyfikator;
    }

    /**
     * Set opis
     *
     * @param string $opis
     *
     * @return EfektKsztalcenia
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;

        return $this;
    }

    /**
     * Get opis
     *
     * @return string
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * @return ProfilKsztalcenia
     */
    public function getProfil()
    {
        return $this->profil;
    }

    /**
     * @param ProfilKsztalcenia $profil
     */
    public function setProfil(ProfilKsztalcenia $profil)
    {
        $this->profil = $profil;
    }

    /**
     * @return PoziomKsztalcenia
     */
    public function getPoziom()
    {
        return $this->poziom;
    }

    /**
     * @param PoziomKsztalcenia $poziom
     */
    public function setPoziom(PoziomKsztalcenia $poziom)
    {
        $this->poziom = $poziom;
    }

    /**
     * @return Zakres
     */
    public function getZakres()
    {
        return $this->zakres;
    }

    /**
     * @param Zakres $zakres
     */
    public function setZakres(Zakres $zakres)
    {
        $this->zakres = $zakres;
    }
}

