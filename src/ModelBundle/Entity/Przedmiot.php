<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Przedmiot
 *
 * @ORM\Table(name="przedmiot")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\PrzedmiotRepository")
 */
class Przedmiot
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
     * @var string
     *
     * @ORM\Column(name="nazwaAng", type="string", length=255)
     */
    private $nazwaAng;

    /**
     * @var string
     *
     * @ORM\Column(name="kod", type="string", length=255, unique=true)
     */
    private $kod;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\KartaPrzedmiotu", mappedBy="przedmiot")
     */
    private $kartaPrzedmiotu;

    /**
     * @var ModulKsztalcenia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\ModulKsztalcenia", inversedBy="przedmiot")
     * @ORM\JoinColumn(name="modul_ksztalcenia_id", referencedColumnName="id")
     */
    private $modulKsztalcenia;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\Kurs", mappedBy="przedmiot")
     */
    private $kurs;

    /**
     * Przedmiot constructor.
     */
    public function __construct()
    {
        $this->kurs = new ArrayCollection();
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
     * Set nazwa
     *
     * @param string $nazwa
     *
     * @return Przedmiot
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
     * Set nazwaAng
     *
     * @param string $nazwaAng
     *
     * @return Przedmiot
     */
    public function setNazwaAng($nazwaAng)
    {
        $this->nazwaAng = $nazwaAng;

        return $this;
    }

    /**
     * Get nazwaAng
     *
     * @return string
     */
    public function getNazwaAng()
    {
        return $this->nazwaAng;
    }

    /**
     * Set kod
     *
     * @param string $kod
     *
     * @return Przedmiot
     */
    public function setKod($kod)
    {
        $this->kod = $kod;

        return $this;
    }

    /**
     * Get kod
     *
     * @return string
     */
    public function getKod()
    {
        return $this->kod;
    }

    /**
     * @return ArrayCollection
     */
    public function getKartaPrzedmiotu()
    {
        return $this->kartaPrzedmiotu;
    }

    /**
     * @param ArrayCollection $kartaPrzedmiotu
     */
    public function setKartaPrzedmiotu( $kartaPrzedmiotu)
    {
        $this->kartaPrzedmiotu = $kartaPrzedmiotu;
    }

    /**
     * @return ModulKsztalcenia
     */
    public function getModulKsztalcenia()
    {
        return $this->modulKsztalcenia;
    }

    /**
     * @param ModulKsztalcenia $modulKsztalcenia
     */
    public function setModulKsztalcenia( $modulKsztalcenia)
    {
        $this->modulKsztalcenia = $modulKsztalcenia;
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

    public function __toString() {
	    return $this->nazwa;
    }

}

