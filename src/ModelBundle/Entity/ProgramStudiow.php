<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * ProgramStudiow
 *
 * @ORM\Table(name="program_studiow")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\ProgramStudiowRepository")
 */
class ProgramStudiow
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
     * @ORM\Column(name="liczbaSemestrow", type="integer")
     */
    private $liczbaSemestrow;

    /**
     * @var string
     *
     * @ORM\Column(name="wymaganiaWstepne", type="text")
     */
    private $wymaganiaWstepne;

    /**
     * @var string
     *
     * @ORM\Column(name="mozliwoscKontynuacji", type="text")
     */
    private $mozliwoscKontynuacji;

    /**
     * @var string
     *
     * @ORM\Column(name="sylwetkaAbsolwenta", type="text")
     */
    private $sylwetkaAbsolwenta;

    /**
     * @var string
     *
     * @ORM\Column(name="misjaUczelni", type="text")
     */
    private $misjaUczelni;

    /**
     * @var string
     *
     * @ORM\Column(name="analizaZgodnosci", type="text")
     */
    private $analizaZgodnosci;

    /**
     * @var ProgramKsztalcenia
     *
     * @ORM\OneToOne(targetEntity="ModelBundle\Entity\ProgramKsztalcenia", inversedBy="programStudiow")
     * @ORM\JoinColumn(name="program_ksztalcenia_id", referencedColumnName="id")
     */
    private $programKsztalcenia;

    /**
     * @var PlanStudiow
     *
     * @ORM\OneToOne(targetEntity="ModelBundle\Entity\PlanStudiow", mappedBy="programStudiow")
     */
    private $planStudiow;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\ModulKsztalcenia", inversedBy="programStudiow")
     * @ORM\JoinTable(name="program_studiow_modul_ksztalcenia")
     */
    private $modulKsztalcenia;

    /**
     * ProgramStudiow constructor.
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
     * Set liczbaSemestrow
     *
     * @param integer $liczbaSemestrow
     *
     * @return ProgramStudiow
     */
    public function setLiczbaSemestrow($liczbaSemestrow)
    {
        $this->liczbaSemestrow = $liczbaSemestrow;

        return $this;
    }

    /**
     * Get liczbaSemestrow
     *
     * @return int
     */
    public function getLiczbaSemestrow()
    {
        return $this->liczbaSemestrow;
    }

    /**
     * Set wymaganiaWstepne
     *
     * @param string $wymaganiaWstepne
     *
     * @return ProgramStudiow
     */
    public function setWymaganiaWstepne($wymaganiaWstepne)
    {
        $this->wymaganiaWstepne = $wymaganiaWstepne;

        return $this;
    }

    /**
     * Get wymaganiaWstepne
     *
     * @return string
     */
    public function getWymaganiaWstepne()
    {
        return $this->wymaganiaWstepne;
    }

    /**
     * Set mozliwoscKontynuacji
     *
     * @param string $mozliwoscKontynuacji
     *
     * @return ProgramStudiow
     */
    public function setMozliwoscKontynuacji($mozliwoscKontynuacji)
    {
        $this->mozliwoscKontynuacji = $mozliwoscKontynuacji;

        return $this;
    }

    /**
     * Get mozliwoscKontynuacji
     *
     * @return string
     */
    public function getMozliwoscKontynuacji()
    {
        return $this->mozliwoscKontynuacji;
    }

    /**
     * Set sylwetkaAbsolwenta
     *
     * @param string $sylwetkaAbsolwenta
     *
     * @return ProgramStudiow
     */
    public function setSylwetkaAbsolwenta($sylwetkaAbsolwenta)
    {
        $this->sylwetkaAbsolwenta = $sylwetkaAbsolwenta;

        return $this;
    }

    /**
     * Get sylwetkaAbsolwenta
     *
     * @return string
     */
    public function getSylwetkaAbsolwenta()
    {
        return $this->sylwetkaAbsolwenta;
    }

    /**
     * Set misjaUczelni
     *
     * @param string $misjaUczelni
     *
     * @return ProgramStudiow
     */
    public function setMisjaUczelni($misjaUczelni)
    {
        $this->misjaUczelni = $misjaUczelni;

        return $this;
    }

    /**
     * Get misjaUczelni
     *
     * @return string
     */
    public function getMisjaUczelni()
    {
        return $this->misjaUczelni;
    }

    /**
     * Set analizaZgodnosci
     *
     * @param string $analizaZgodnosci
     *
     * @return ProgramStudiow
     */
    public function setAnalizaZgodnosci($analizaZgodnosci)
    {
        $this->analizaZgodnosci = $analizaZgodnosci;

        return $this;
    }

    /**
     * Get analizaZgodnosci
     *
     * @return string
     */
    public function getAnalizaZgodnosci()
    {
        return $this->analizaZgodnosci;
    }

    /**
     * @return ProgramKsztalcenia
     */
    public function getProgramKsztalcenia()
    {
        return $this->programKsztalcenia;
    }

    /**
     * @param ProgramKsztalcenia $programKsztalcenia
     */
    public function setProgramKsztalcenia(ProgramKsztalcenia $programKsztalcenia)
    {
        $this->programKsztalcenia = $programKsztalcenia;
    }

    /**
     * @return PlanStudiow
     */
    public function getPlanStudiow()
    {
        return $this->planStudiow;
    }

    /**
     * @param PlanStudiow $planStudiow
     */
    public function setPlanStudiow(PlanStudiow $planStudiow)
    {
        $this->planStudiow = $planStudiow;
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
     * @param ModulKsztalcenia $modulKsztalcenia
     */
    public function addModulKsztalcenia(ModulKsztalcenia $modulKsztalcenia)
    {
        $this->modulKsztalcenia->add($modulKsztalcenia);
    }

    public function __toString() {
	    return $this->liczbaSemestrow.' semestrów';
    }
}

