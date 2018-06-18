<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Semestr
 *
 * @ORM\Table(name="semestr")
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\SemestrRepository")
 */
class Semestr
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
     * @ORM\Column(name="numer", type="integer")
     */
    private $numer;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="ModelBundle\Entity\PlanStudiow", mappedBy="semestr")
     */
    private $planStudiow;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\ModulKsztalcenia", mappedBy="semestr")
     */
    private $modulKsztalcenia;

    /**
     * Semestr constructor.
     */
    public function __construct()
    {
        $this->planStudiow = new ArrayCollection;
        $this->modulKsztalcenia = new ArrayCollection;
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
     * Set numer
     *
     * @param integer $numer
     *
     * @return Semestr
     */
    public function setNumer($numer)
    {
        $this->numer = $numer;

        return $this;
    }

    /**
     * Get numer
     *
     * @return int
     */
    public function getNumer()
    {
        return $this->numer;
    }

    /**
     * @return ArrayCollection
     */
    public function getPlanStudiow()
    {
        return $this->planStudiow;
    }

    /**
     * @param ArrayCollection $planStudiow
     */
    public function setPlanStudiow(ArrayCollection $planStudiow)
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
}

