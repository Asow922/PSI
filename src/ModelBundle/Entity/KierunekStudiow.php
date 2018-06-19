<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\ProfilKsztalcenia;
use ModelBundle\Entity\Enum\Wydzial;

/**
 * KierunekStudiow
 *
 * @ORM\Table(name="kierunek_studiow")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\KierunekStudiowRepository")
 */
class KierunekStudiow
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
     * @ORM\Column(name="nazwa", type="string", length=255, unique=true)
     */
    private $nazwa;

    /**
     * @var string
     *
     * @ORM\Column(name="skrot", type="string", length=255, unique=true)
     */
    private $skrot;

    /**
     * @var Wydzial
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Wydzial")
     * @ORM\JoinColumn(name="wydzial_id", referencedColumnName="id")
     */
    private $wydzial;

    /**
     * @var ProfilKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\ProfilKsztalcenia")
     * @ORM\JoinColumn(name="profil_id", referencedColumnName="id")
     */
    private $profil;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\ProgramKsztalcenia", mappedBy="kierunekStudiow")
     */
    private $programKsztalcenia;

    /**
     * KierunekStudiow constructor.
     */
    public function __construct()
    {
        $this->programKsztalcenia = new ArrayCollection();
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
    public function setProfil($profil)
    {
        $this->profil = $profil;
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
     * @return KierunekStudiow
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
     * Set skrot
     *
     * @param string $skrot
     *
     * @return KierunekStudiow
     */
    public function setSkrot($skrot)
    {
        $this->skrot = $skrot;

        return $this;
    }

    /**
     * Get skrot
     *
     * @return string
     */
    public function getSkrot()
    {
        return $this->skrot;
    }

    /**
     * @return Wydzial
     */
    public function getWydzial()
    {
        return $this->wydzial;
    }

    /**
     * @param Wydzial $wydzial
     */
    public function setWydzial(Wydzial $wydzial)
    {
        $this->wydzial = $wydzial;
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
    public function setProgramKsztalcenia(ArrayCollection $programKsztalcenia)
    {
        $this->programKsztalcenia = $programKsztalcenia;
    }

    public function __toString() {
	    return $this->skrot.' - '.$this->nazwa;
    }
}

