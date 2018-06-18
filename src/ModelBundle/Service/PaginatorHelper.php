<?php

namespace ModelBundle\Service;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Knp\Component\Pager\Paginator;
use Symfony\Component\HttpFoundation\Request;

class PaginatorHelper
{
    /**
     * @var EntityManager $em
     */
    private $em;

    public function setEm(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @var Paginator $paginator
     */
    private $paginator;

    public function setPaginator(Paginator $paginator)
    {
        $this->paginator = $paginator;
    }

    public function getPaginate(Request $request, $entity)
    {
        $qb = $this->em->createQueryBuilder();
        $qb->select('entity')
            ->from($entity, 'entity');

        return $this->paginator->paginate(
            $qb->getQuery(),
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 10)
        );
    }

}