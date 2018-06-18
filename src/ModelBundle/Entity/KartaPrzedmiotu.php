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
     * @var NarzedziaDydaktyczne
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\NarzedziaDydaktyczne")
     * @ORM\JoinColumn(name="narzedzia_dydaktyczne_id", referencedColumnName="id")
     */
    private $narzedziaDydaktyczne;

    /**
     * @var OcenaOsiagniecia
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\OcenaOsiagniecia")
     * @ORM\JoinColumn(name="ocena_osiagneicia_id", referencedColumnName="id")
     */
    private $ocenaOsiagniecia;

    /**
     * @var WymaganiaWstepne
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\WymaganiaWstepne")
     * @ORM\JoinColumn(name="wymagania_wstepne_id", referencedColumnName="id")
     */
    private $wymaganiaWstepne;

    /**
     * @var CelePrzedmiotu
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\CelePrzedmiotu")
     * @ORM\JoinColumn(name="cele_przedmiotu_id", referencedColumnName="id")
     */
    private $celePrzedmiotu;

    /**
     * @var TresciProgramowe
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\TresciProgramowe")
     * @ORM\JoinColumn(name="tresci_programowe_id", referencedColumnName="id")
     */
    private $tresciProgramowe;

    /**
     * @var LiteraturaPodstawowa
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\LiteraturaPodstawowa")
     * @ORM\JoinColumn(name="literatura_podstawowa_id", referencedColumnName="id")
     */
    private $literaturaPodstawowa;

    /**
     * @var LiteraturaUzupelniajaca
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\LiteraturaUzupelniajaca")
     * @ORM\JoinColumn(name="literatura_uzupelniajaca_id", referencedColumnName="id")
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
     * @return NarzedziaDydaktyczne
     */
    public function getNarzedziaDydaktyczne()
    {
        return $this->narzedziaDydaktyczne;
    }

    /**
     * @param NarzedziaDydaktyczne $narzedziaDydaktyczne
     */
    public function setNarzedziaDydaktyczne(NarzedziaDydaktyczne $narzedziaDydaktyczne)
    {
        $this->narzedziaDydaktyczne = $narzedziaDydaktyczne;
    }

    /**
     * @return OcenaOsiagniecia
     */
    public function getOcenaOsiagniecia()
    {
        return $this->ocenaOsiagniecia;
    }

    /**
     * @param OcenaOsiagniecia $ocenaOsiagniecia
     */
    public function setOcenaOsiagniecia(OcenaOsiagniecia $ocenaOsiagniecia)
    {
        $this->ocenaOsiagniecia = $ocenaOsiagniecia;
    }

    /**
     * @return WymaganiaWstepne
     */
    public function getWymaganiaWstepne()
    {
        return $this->wymaganiaWstepne;
    }

    /**
     * @param WymaganiaWstepne $wymaganiaWstepne
     */
    public function setWymaganiaWstepne(WymaganiaWstepne $wymaganiaWstepne)
    {
        $this->wymaganiaWstepne = $wymaganiaWstepne;
    }

    /**
     * @return CelePrzedmiotu
     */
    public function getCelePrzedmiotu()
    {
        return $this->celePrzedmiotu;
    }

    /**
     * @param CelePrzedmiotu $celePrzedmiotu
     */
    public function setCelePrzedmiotu(CelePrzedmiotu $celePrzedmiotu)
    {
        $this->celePrzedmiotu = $celePrzedmiotu;
    }

    /**
     * @return TresciProgramowe
     */
    public function getTresciProgramowe()
    {
        return $this->tresciProgramowe;
    }

    /**
     * @param TresciProgramowe $tresciProgramowe
     */
    public function setTresciProgramowe(TresciProgramowe $tresciProgramowe)
    {
        $this->tresciProgramowe = $tresciProgramowe;
    }

    /**
     * @return LiteraturaPodstawowa
     */
    public function getLiteraturaPodstawowa()
    {
        return $this->literaturaPodstawowa;
    }

    /**
     * @param LiteraturaPodstawowa $literaturaPodstawowa
     */
    public function setLiteraturaPodstawowa(LiteraturaPodstawowa $literaturaPodstawowa)
    {
        $this->literaturaPodstawowa = $literaturaPodstawowa;
    }

    /**
     * @return LiteraturaUzupelniajaca
     */
    public function getLiteraturaUzupelniajaca()
    {
        return $this->literaturaUzupelniajaca;
    }

    /**
     * @param LiteraturaUzupelniajaca $literaturaUzupelniajaca
     */
    public function setLiteraturaUzupelniajaca(LiteraturaUzupelniajaca $literaturaUzupelniajaca)
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

