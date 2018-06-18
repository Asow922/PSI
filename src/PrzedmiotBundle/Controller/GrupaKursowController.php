<?php

namespace PrzedmiotBundle\Controller;

use ModelBundle\Entity\GrupaKursow;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Grupakursow controller.
 *
 * @Route("grupakursow")
 */
class GrupaKursowController extends Controller
{
    /**
     * Lists all grupaKursow entities.
     *
     * @Route("/", name="grupakursow_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $grupaKursows = $em->getRepository('ModelBundle:GrupaKursow')->findAll();

        return $this->render('@Przedmiot/grupakursow/index.html.twig', array(
            'grupaKursows' => $grupaKursows,
        ));
    }

    /**
     * Creates a new grupaKursow entity.
     *
     * @Route("/new", name="grupakursow_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $grupaKursow = new Grupakursow();
        $form = $this->createForm('ModelBundle\Form\GrupaKursowType', $grupaKursow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($grupaKursow);
            $em->flush();

            return $this->redirectToRoute('grupakursow_show', array('id' => $grupaKursow->getId()));
        }

        return $this->render('@Przedmiot/grupakursow/new.html.twig', array(
            'grupaKursow' => $grupaKursow,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a grupaKursow entity.
     *
     * @Route("/{id}", name="grupakursow_show")
     * @Method("GET")
     */
    public function showAction(GrupaKursow $grupaKursow)
    {
        $deleteForm = $this->createDeleteForm($grupaKursow);

        return $this->render('@Przedmiot/grupakursow/show.html.twig', array(
            'grupaKursow' => $grupaKursow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing grupaKursow entity.
     *
     * @Route("/{id}/edit", name="grupakursow_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GrupaKursow $grupaKursow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($grupaKursow);
        $editForm = $this->createForm('ModelBundle\Form\GrupaKursowType', $grupaKursow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('grupakursow_edit', array('id' => $grupaKursow->getId()));
        }

        return $this->render('@Przedmiot/grupakursow/edit.html.twig', array(
            'grupaKursow' => $grupaKursow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a grupaKursow entity.
     *
     * @Route("/{id}", name="grupakursow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GrupaKursow $grupaKursow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($grupaKursow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($grupaKursow);
            $em->flush();
        }

        return $this->redirectToRoute('grupakursow_index');
    }

    /**
     * Creates a form to delete a grupaKursow entity.
     *
     * @param GrupaKursow $grupaKursow The grupaKursow entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(GrupaKursow $grupaKursow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grupakursow_delete', array('id' => $grupaKursow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
