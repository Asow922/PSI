<?php

namespace EfektKsztalceniaBundle\Controller;

use ModelBundle\Entity\EfektPrzedmiotowy;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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
     * @Route("/new", name="efektprzedmiotowy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $efektPrzedmiotowy = new Efektprzedmiotowy();
        $form = $this->createForm('ModelBundle\Form\EfektPrzedmiotowyType', $efektPrzedmiotowy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
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

        return $this->redirectToRoute('efektprzedmiotowy_index');
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
