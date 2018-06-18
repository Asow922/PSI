<?php

namespace PrzedmiotBundle\Controller;

use ModelBundle\Entity\KartaPrzedmiotu;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Kartaprzedmiotu controller.
 *
 * @Route("kartaprzedmiotu")
 */
class KartaPrzedmiotuController extends Controller
{
    /**
     * Lists all kartaPrzedmiotu entities.
     *
     * @Route("/", name="kartaprzedmiotu_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kartaPrzedmiotus = $em->getRepository('ModelBundle:KartaPrzedmiotu')->findAll();

        return $this->render('@Przedmiot/kartaprzedmiotu/index.html.twig', array(
            'kartaPrzedmiotus' => $kartaPrzedmiotus,
        ));
    }

    /**
     * Creates a new kartaPrzedmiotu entity.
     *
     * @Route("/new", name="kartaprzedmiotu_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $kartaPrzedmiotu = new Kartaprzedmiotu();
        $form = $this->createForm('ModelBundle\Form\KartaPrzedmiotuType', $kartaPrzedmiotu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kartaPrzedmiotu);
            $em->flush();

            return $this->redirectToRoute('kartaprzedmiotu_show', array('id' => $kartaPrzedmiotu->getId()));
        }

        return $this->render('@Przedmiot/kartaprzedmiotu/new.html.twig', array(
            'kartaPrzedmiotu' => $kartaPrzedmiotu,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kartaPrzedmiotu entity.
     *
     * @Route("/{id}", name="kartaprzedmiotu_show")
     * @Method("GET")
     */
    public function showAction(KartaPrzedmiotu $kartaPrzedmiotu)
    {
        $deleteForm = $this->createDeleteForm($kartaPrzedmiotu);

        return $this->render('@Przedmiot/kartaprzedmiotu/show.html.twig', array(
            'kartaPrzedmiotu' => $kartaPrzedmiotu,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kartaPrzedmiotu entity.
     *
     * @Route("/{id}/edit", name="kartaprzedmiotu_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, KartaPrzedmiotu $kartaPrzedmiotu)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($kartaPrzedmiotu);
        $editForm = $this->createForm('ModelBundle\Form\KartaPrzedmiotuType', $kartaPrzedmiotu);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kartaprzedmiotu_edit', array('id' => $kartaPrzedmiotu->getId()));
        }

        return $this->render('@Przedmiot/kartaprzedmiotu/edit.html.twig', array(
            'kartaPrzedmiotu' => $kartaPrzedmiotu,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kartaPrzedmiotu entity.
     *
     * @Route("/{id}", name="kartaprzedmiotu_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, KartaPrzedmiotu $kartaPrzedmiotu)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($kartaPrzedmiotu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kartaPrzedmiotu);
            $em->flush();
        }

        return $this->redirectToRoute('kartaprzedmiotu_index');
    }

    /**
     * Creates a form to delete a kartaPrzedmiotu entity.
     *
     * @param KartaPrzedmiotu $kartaPrzedmiotu The kartaPrzedmiotu entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(KartaPrzedmiotu $kartaPrzedmiotu)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kartaprzedmiotu_delete', array('id' => $kartaPrzedmiotu->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
