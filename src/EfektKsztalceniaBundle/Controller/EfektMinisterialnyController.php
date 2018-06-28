<?php

namespace EfektKsztalceniaBundle\Controller;

use ModelBundle\Entity\EfektMinisterialny;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Efektministerialny controller.
 *
 * @Route("efektministerialny")
 */
class EfektMinisterialnyController extends Controller
{
    /**
     * Lists all efektMinisterialny entities.
     *
     * @Route("/", name="efektministerialny_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $efektMinisterialnies = $em->getRepository('ModelBundle:EfektMinisterialny')->findAll();

        return $this->render('@EfektKsztalcenia/efektministerialny/index.html.twig', array(
            'efektMinisterialnies' => $efektMinisterialnies,
        ));
    }

    /**
     * Creates a new efektMinisterialny entity.
     *
     * @Route("/new", name="efektministerialny_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $efektMinisterialny = new Efektministerialny();
        $form = $this->createForm('ModelBundle\Form\EfektMinisterialnyType', $efektMinisterialny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($efektMinisterialny);
            $em->flush();

            return $this->redirectToRoute('efektministerialny_show', array('id' => $efektMinisterialny->getId()));
        }

        return $this->render('@EfektKsztalcenia/efektministerialny/new.html.twig', array(
            'efektMinisterialny' => $efektMinisterialny,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a efektMinisterialny entity.
     *
     * @Route("/{id}", name="efektministerialny_show")
     * @Method("GET")
     */
    public function showAction(EfektMinisterialny $efektMinisterialny)
    {
        $deleteForm = $this->createDeleteForm($efektMinisterialny);

        return $this->render('@EfektKsztalcenia/efektministerialny/show.html.twig', array(
            'efektMinisterialny' => $efektMinisterialny,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing efektMinisterialny entity.
     *
     * @Route("/{id}/edit", name="efektministerialny_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EfektMinisterialny $efektMinisterialny)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($efektMinisterialny);
        $editForm = $this->createForm('ModelBundle\Form\EfektMinisterialnyType', $efektMinisterialny);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('efektministerialny_edit', array('id' => $efektMinisterialny->getId()));
        }

        return $this->render('@EfektKsztalcenia/efektministerialny/edit.html.twig', array(
            'efektMinisterialny' => $efektMinisterialny,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a efektMinisterialny entity.
     *
     * @Route("/{id}", name="efektministerialny_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EfektMinisterialny $efektMinisterialny)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($efektMinisterialny);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($efektMinisterialny);
            $em->flush();
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * Creates a form to delete a efektMinisterialny entity.
     *
     * @param EfektMinisterialny $efektMinisterialny The efektMinisterialny entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(EfektMinisterialny $efektMinisterialny)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('efektministerialny_delete', array('id' => $efektMinisterialny->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
