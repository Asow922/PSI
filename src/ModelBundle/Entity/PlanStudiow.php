<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ModelBundle\Entity\Enum\TypStudiow;

/**
 * PlanStudiow
 *
 * @ORM\Table(name="plan_studiow")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\PlanStudiowRepository")
 */
class PlanStudiow
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
     * @var ProgramStudiow
     *
     * @ORM\OneToOne(targetEntity="ModelBundle\Entity\ProgramStudiow", inversedBy="programKsztalcenia")
     * @ORM\JoinColumn(name="program_studiow_id", referencedColumnName="id")
     */
    private $programStudiow;

    /**
     * @var TypStudiow
     *
     * @ORM\ManyToOne(targetEntity="ModelBundle\Entity\Enum\TypStudiow")
     * @ORM\JoinColumn(name="typ_studiow_id", referencedColumnName="id")
     */
    private $forma;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\Semestr", inversedBy="planStudiow")
     * @ORM\JoinTable(name="plan_studiow_semestr")
     */
    private $semestr;

    /**
     * PlanStudiow constructor.
     */
    public function __construct()
    {
        $this->semestr = new ArrayCollection;
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
     * @return ProgramStudiow
     */
    public function getProgramStudiow()
    {
        return $this->programStudiow;
    }

    /**
     * @param ProgramStudiow $programStudiow
     */
    public function setProgramStudiow(ProgramStudiow $programStudiow)
    {
        $this->programStudiow = $programStudiow;
    }

    /**
     * @return TypStudiow
     */
    public function getForma()
    {
        return $this->forma;
    }

    /**
     * @param TypStudiow $forma
     */
    public function setForma(TypStudiow $forma)
    {
        $this->forma = $forma;
    }

    /**
     * @return ArrayCollection
     */
    public function getSemestr()
    {
        return $this->semestr;
    }

    /**
     * @param ArrayCollection $semestr
     */
    public function setSemestr(ArrayCollection $semestr)
    {
        $this->semestr = $semestr;
    }
}

