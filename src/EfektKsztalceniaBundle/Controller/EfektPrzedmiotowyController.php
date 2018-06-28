<?php

namespace EfektKsztalceniaBundle\Controller;

use Doctrine\ORM\EntityManager;
use ModelBundle\Entity\EfektPrzedmiotowy;
use ModelBundle\Entity\KartaPrzedmiotu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Efektprzedmiotowy controller.
 *
 * @Route("efektprzedmiotowy")
 */
class EfektPrzedmiotowyController extends Controller
{
    /**
     * Lists all efektPrzedmiotowy entities.
     *
     * @Route("/", name="efektprzedmiotowy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $efektPrzedmiotowies = $em->getRepository('ModelBundle:EfektPrzedmiotowy')->findAll();

        return $this->render('@EfektKsztalcenia/efektprzedmiotowy/index.html.twig', array(
            'efektPrzedmiotowies' => $efektPrzedmiotowies,
        ));
    }

    /**
     * Creates a new efektPrzedmiotowy entity.
     *
     * @Route("/new/{id}", name="efektprzedmiotowy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, KartaPrzedmiotu $kartaPrzedmiotu)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $efektPrzedmiotowy = new EfektPrzedmiotowy();
        $efektPrzedmiotowy->addKartaPrzedmiotu($kartaPrzedmiotu);
        $form = $this->createForm('ModelBundle\Form\EfektPrzedmiotowyType', $efektPrzedmiotowy);
        if ($form->has('identyfikator')) {
            $form->remove('identyfikator');
        }
        $form->handleRequest($request);

        $qb = $this->get('doctrine.orm.default_entity_manager')->createQueryBuilder();
        $result = $qb->select('ep')
            ->from(EfektPrzedmiotowy::class, 'ep')
            ->join('ep.kartaPrzedmiotu', 'kp')
            ->andWhere('kp.id = :kartaPrzedmiotuId')
            ->andWhere('ep.identyfikator LIKE :efektIdentyfikator')
            ->setParameter(':kartaPrzedmiotuId', $kartaPrzedmiotu->getId())
            ->setParameter(':efektIdentyfikator', $efektPrzedmiotowy->getIdentyfikator())
            ->getQuery()->getResult();

        if (count($result) > 0) {
            $form->addError(new FormError('Identyfikator musi być unikatowy w obrębie karty przedmiotu'));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var EntityManager $em */
            $em = $this->getDoctrine()->getManager();
            $identyfikator = 'PEK_';


            if ($efektPrzedmiotowy->getZakres()->getName() == 'wiedza') {
                $identyfikator .= 'W';
            } elseif ($efektPrzedmiotowy->getZakres()->getName() == 'umiejętności') {
                $identyfikator .= 'U';
            } elseif ($efektPrzedmiotowy->getZakres()->getName() == 'kompetencje społeczne') {
                $identyfikator .= 'K';
            } else {
                $identyfikator .= 'XXX';
            }

            $qb = $em->createQueryBuilder();

            $r = $qb->select('efektPrzedmiotowy')
                ->from(EfektPrzedmiotowy::class, 'efektPrzedmiotowy')
                ->join('efektPrzedmiotowy.zakres', 'zakres')
                ->join('efektPrzedmiotowy.kartaPrzedmiotu', 'kartaPrzedmiotu')
                ->andWhere('zakres.name LIKE :name')
                ->andWhere('kartaPrzedmiotu.id = :kartaPrzedmiotuId')
                ->setParameter(':kartaPrzedmiotuId', $kartaPrzedmiotu->getId())
                ->setParameter('name', $efektPrzedmiotowy->getZakres()->getName())
                ->orderBy('efektPrzedmiotowy.identyfikator', 'DESC')
                ->getQuery()->getResult();

            if (count($r) > 0) {
                $identyfikator = $r[0]->getIdentyfikator();
                $poczatek = substr($identyfikator, 0, 5);
                $koniec = substr($identyfikator, 5, 2);
                $koniec++;
                $identyfikator = $poczatek.sprintf('%02d', $koniec);
            } else {
                $identyfikator .= '01';
            }
            $efektPrzedmiotowy->setIdentyfikator($identyfikator);

            $em->persist($efektPrzedmiotowy);
            $em->flush();

            return $this->redirectToRoute('efektprzedmiotowy_show', array('id' => $efektPrzedmiotowy->getId()));
        }

        return $this->render('@EfektKsztalcenia/efektprzedmiotowy/new.html.twig', array(
            'efektPrzedmiotowy' => $efektPrzedmiotowy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a efektPrzedmiotowy entity.
     *
     * @Route("/{id}", name="efektprzedmiotowy_show")
     * @Method("GET")
     */
    public function showAction(EfektPrzedmiotowy $efektPrzedmiotowy)
    {
        $deleteForm = $this->createDeleteForm($efektPrzedmiotowy);

        return $this->render('@EfektKsztalcenia/efektprzedmiotowy/show.html.twig', array(
            'efektPrzedmiotowy' => $efektPrzedmiotowy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing efektPrzedmiotowy entity.
     *
     * @Route("/{id}/edit", name="efektprzedmiotowy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EfektPrzedmiotowy $efektPrzedmiotowy)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($efektPrzedmiotowy);
        $editForm = $this->createForm('ModelBundle\Form\EfektPrzedmiotowyType', $efektPrzedmiotowy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('efektprzedmiotowy_edit', array('id' => $efektPrzedmiotowy->getId()));
        }

        return $this->render('@EfektKsztalcenia/efektprzedmiotowy/edit.html.twig', array(
            'efektPrzedmiotowy' => $efektPrzedmiotowy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a efektPrzedmiotowy entity.
     *
     * @Route("/{id}", name="efektprzedmiotowy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EfektPrzedmiotowy $efektPrzedmiotowy)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($efektPrzedmiotowy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($efektPrzedmiotowy);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a efektPrzedmiotowy entity.
     *
     * @param EfektPrzedmiotowy $efektPrzedmiotowy The efektPrzedmiotowy entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(EfektPrzedmiotowy $efektPrzedmiotowy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('efektprzedmiotowy_delete', array('id' => $efektPrzedmiotowy->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
