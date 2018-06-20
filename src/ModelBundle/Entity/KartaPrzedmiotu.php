<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\Jezyk;
use ModelBundle\Entity\Enum\Wydzial;

/**
 * KartaPrzedmiotu
 *
 * @ORM\Table(name="karta_przedmiotu")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\KartaPrzedmiotuRepository")
 */
class KartaPrzedmiotu
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
     * @ORM\Column(name="wersja", type="integer", nullable=true)
     */
    private $wersja;

    /**
     * @var string
     *
     * @ORM\Column(name="studium", type="string", length=255)
     */
    private $studium;

    /**
     * @var string
     *
     * @ORM\Column(name="opiekun_przedmiotu", type="string", length=255)
     */
    private $opiekunPrzedmiotu;

    /**
     * @var Jezyk
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Jezyk")
     * @ORM\JoinColumn(name="jezyk_id", referencedColumnName="id")
     */
    private $jezyk;

    /**
     * @var Wydzial
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\Wydzial")
     * @ORM\JoinColumn(name="wydzial_id", referencedColumnName="id")
     */
    private $wydzial;

    /**
     * @var string
     *
     * @ORM\Column(name="narzedzia_dydaktyczne", type="string", length=255)
     */
    private $narzedziaDydaktyczne;

    /**
     * @var string
     *
     * @ORM\Column(name="ocena_osiagniecia", type="string", length=255)
     */
    private $ocenaOsiagniecia;

    /**
     * @var string
     *
     * @ORM\Column(name="wymagania_wstepne", type="string", length=255)
     */
    private $wymaganiaWstepne;

    /**
     * @var string
     *
     * @ORM\Column(name="cele_przedmiotu", type="string", length=255)
     */
    private $celePrzedmiotu;

    /**
     * @var string
     *
     * @ORM\Column(name="tresci_programowe", type="string", length=255)
     */
    private $tresciProgramowe;

    /**
     * @var string
     *
     * @ORM\Column(name="literatura_podstawowa", type="string", length=255)
     */
    private $literaturaPodstawowa;

    /**
     * @var string
     *
     * @ORM\Column(name="literatura_uzupelniajaca", type="string", length=255)
     */
    private $literaturaUzupelniajaca;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\EfektPrzedmiotowy", inversedBy="kartaPrzedmiotu")
     * @ORM\JoinTable(name="karta_przedmiotu_efekt_przedmiotowy")
     */
    private $efektPrzedmiotowy;

    /**
     * @var Przedmiot
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Przedmiot", inversedBy="kartaPrzedmiotu")
     * @ORM\JoinColumn(name="przedmiot_id", referencedColumnName="id")
     */
    private $przedmiot;

    /**
     * KartaPrzedmiotu constructor.
     */
    public function __construct()
    {
        $this->efektPrzedmiotowy = new ArrayCollection();
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
     * Set wersja
     *
     * @param integer $wersja
     *
     * @return KartaPrzedmiotu
     */
    public function setWersja($wersja)
    {
        $this->wersja = $wersja;

        return $this;
    }

    /**
     * Get wersja
     *
     * @return int
     */
    public function getWersja()
    {
        return $this->wersja;
    }

    /**
     * Set studium
     *
     * @param string $studium
     *
     * @return KartaPrzedmiotu
     */
    public function setStudium($studium)
    {
        $this->studium = $studium;

        return $this;
    }

    /**
     * Get studium
     *
     * @return string
     */
    public function getStudium()
    {
        return $this->studium;
    }

    /**
     * Set opiekunPrzedmiotu
     *
     * @param string $opiekunPrzedmiotu
     *
     * @return KartaPrzedmiotu
     */
    public function setOpiekunPrzedmiotu($opiekunPrzedmiotu)
    {
        $this->opiekunPrzedmiotu = $opiekunPrzedmiotu;

        return $this;
    }

    /**
     * Get opiekunPrzedmiotu
     *
     * @return string
     */
    public function getOpiekunPrzedmiotu()
    {
        return $this->opiekunPrzedmiotu;
    }

    /**
     * @return Jezyk
     */
    public function getJezyk()
    {
        return $this->jezyk;
    }

    /**
     * @param Jezyk $jezyk
     */
    public function setJezyk(Jezyk $jezyk)
    {
        $this->jezyk = $jezyk;
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
     * @return string
     */
    public function getNarzedziaDydaktyczne()
    {
        return $this->narzedziaDydaktyczne;
    }

    /**
     * @param string $narzedziaDydaktyczne
     */
    public function setNarzedziaDydaktyczne( $narzedziaDydaktyczne)
    {
        $this->narzedziaDydaktyczne = $narzedziaDydaktyczne;
    }

    /**
     * @return string
     */
    public function getOcenaOsiagniecia()
    {
        return $this->ocenaOsiagniecia;
    }

    /**
     * @param string $ocenaOsiagniecia
     */
    public function setOcenaOsiagniecia( $ocenaOsiagniecia)
    {
        $this->ocenaOsiagniecia = $ocenaOsiagniecia;
    }

    /**
     * @return string
     */
    public function getWymaganiaWstepne()
    {
        return $this->wymaganiaWstepne;
    }

    /**
     * @param string $wymaganiaWstepne
     */
    public function setWymaganiaWstepne( $wymaganiaWstepne)
    {
        $this->wymaganiaWstepne = $wymaganiaWstepne;
    }

    /**
     * @return string
     */
    public function getCelePrzedmiotu()
    {
        return $this->celePrzedmiotu;
    }

    /**
     * @param string $celePrzedmiotu
     */
    public function setCelePrzedmiotu( $celePrzedmiotu)
    {
        $this->celePrzedmiotu = $celePrzedmiotu;
    }

    /**
     * @return string
     */
    public function getTresciProgramowe()
    {
        return $this->tresciProgramowe;
    }

    /**
     * @param string $tresciProgramowe
     */
    public function setTresciProgramowe( $tresciProgramowe)
    {
        $this->tresciProgramowe = $tresciProgramowe;
    }

    /**
     * @return string
     */
    public function getLiteraturaPodstawowa()
    {
        return $this->literaturaPodstawowa;
    }

    /**
     * @param string $literaturaPodstawowa
     */
    public function setLiteraturaPodstawowa( $literaturaPodstawowa)
    {
        $this->literaturaPodstawowa = $literaturaPodstawowa;
    }

    /**
     * @return string
     */
    public function getLiteraturaUzupelniajaca()
    {
        return $this->literaturaUzupelniajaca;
    }

    /**
     * @param string $literaturaUzupelniajaca
     */
    public function setLiteraturaUzupelniajaca( $literaturaUzupelniajaca)
    {
        $this->literaturaUzupelniajaca = $literaturaUzupelniajaca;
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
    public function setEfektPrzedmiotowy(ArrayCollection $efektPrzedmiotowy)
    {
        $this->efektPrzedmiotowy = $efektPrzedmiotowy;
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
}

