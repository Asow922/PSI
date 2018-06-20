<?php

namespace ModelBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * GrupaKursow
 *
 * @ORM\Entity(repositoryClass="ModelBundle\Repository\GrupaKursowRepository")
 */
class GrupaKursow extends Kurs
{
//    /**
//     * @var int
//     *
//     * @ORM\Column(name="id", type="integer")
//     * @ORM\Id
//     * @ORM\GeneratedValue(strategy="AUTO")
//     */
//    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="ModelBundle\Entity\Kurs", mappedBy="grupaKursow")
     */
    private $kurs;

    /**
     * GrupaKursow constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->kurs = new ArrayCollection();
    }

//    /**
//     * Get id
//     *
//     * @return int
//     */
//    public function getId()
//    {
//        return $this->id;
//    }

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
    public function setKurs(ArrayCollection $kurs)
    {
        $this->kurs = $kurs;
    }

    public function __toString()
    {
        return parent::getId().'';
    }


}

