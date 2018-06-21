<?php

namespace PrzedmiotBundle\Controller;

use ModelBundle\Entity\Kurs;
use ModelBundle\Entity\ModulKsztalcenia;
use ModelBundle\Entity\ProgramStudiow;
use ModelBundle\Entity\Przedmiot;
use ModelBundle\Entity\Semestr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Modulksztalcenium controller.
 *
 * @Route("modulksztalcenia")
 */
class ModulKsztalceniaController extends Controller
{
    /**
     * Lists all modulKsztalcenium entities.
     *
     * @Route("/", name="modulksztalcenia_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modulKsztalcenias = $em->getRepository('ModelBundle:ModulKsztalcenia')->findAll();

        return $this->render('@Przedmiot/modulksztalcenia/index.html.twig', array(
            'modulKsztalcenias' => $modulKsztalcenias,
        ));
    }

    /**
     * Creates a new modulKsztalcenium entity.
     *
     * @Route("/new/{id}", name="modulksztalcenia_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Semestr $semestr)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $modulKsztalcenium = new ModulKsztalcenia();
        $modulKsztalcenium->setSemestr($semestr);
        $form = $this->createForm('ModelBundle\Form\ModulKsztalceniaType', $modulKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modulKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('modulksztalcenia_show', array('id' => $modulKsztalcenium->getId()));
        }

        return $this->render('@Przedmiot/modulksztalcenia/new.html.twig', array(
            'modulKsztalcenium' => $modulKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new modulKsztalcenium entity.
     *
     * @Route("/new/program/{id}", name="modulksztalcenia_new_program")
     * @Method({"GET", "POST"})
     */
    public function newPrzedmiotAction(Request $request, ProgramStudiow $program)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $modulKsztalcenium = new ModulKsztalcenia();
        $modulKsztalcenium->addProgramStudiow($program);
        $form = $this->createForm('ModelBundle\Form\ModulKsztalceniaType', $modulKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modulKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('modulksztalcenia_show', array('id' => $modulKsztalcenium->getId()));
        }

        return $this->render('@Przedmiot/modulksztalcenia/new.html.twig', array(
            'modulKsztalcenium' => $modulKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new modulKsztalcenium entity.
     *
     * @Route("/new/modul/{id}", name="modulksztalcenia_new_modul")
     * @Method({"GET", "POST"})
     */
    public function newModulAction(Request $request, ModulKsztalcenia $modulKsztalcenia)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $modulKsztalcenium = new ModulKsztalcenia();
        $modulKsztalcenium->setNadrzedny($modulKsztalcenia);

        /** @var ProgramStudiow $program */
        foreach ($modulKsztalcenia->getProgramStudiow() as $program) {
            $modulKsztalcenium->addProgramStudiow($program);
        }

        $modulKsztalcenium->setSemestr($modulKsztalcenia->getSemestr());


        $form = $this->createForm('ModelBundle\Form\ModulKsztalceniaType', $modulKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modulKsztalcenium);
            $em->flush();

            return $this->redirectToRoute('modulksztalcenia_show', array('id' => $modulKsztalcenium->getId()));
        }

        return $this->render('@Przedmiot/modulksztalcenia/new.html.twig', array(
            'modulKsztalcenium' => $modulKsztalcenium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a modulKsztalcenium entity.
     *
     * @Route("/{id}", name="modulksztalcenia_show")
     * @Method("GET")
     */
    public function showAction(ModulKsztalcenia $modulKsztalcenium)
    {
        $deleteForm = $this->createDeleteForm($modulKsztalcenium);

        return $this->render('@Przedmiot/modulksztalcenia/show.html.twig', array(
            'modulKsztalcenium' => $modulKsztalcenium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing modulKsztalcenium entity.
     *
     * @Route("/{id}/edit", name="modulksztalcenia_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ModulKsztalcenia $modulKsztalcenium)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_OPIEKUN_PRZEDMIOTU)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($modulKsztalcenium);
        $editForm = $this->createForm('ModelBundle\Form\ModulKsztalceniaType', $modulKsztalcenium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var ModulKsztalcenia $modulKsztalcenia */
            $modulKsztalcenia = $editForm->getData();

//            if ($modulKsztalcenia->getNadrzedny()) {
//                foreach ($modulKsztalcenia->getNadrzedny()->getProgramStudiow() as $program) {
//                    $modulKsztalcenia->addProgramStudiow($program);
//                }
//            }

            /** @var Przedmiot $przedmiot */
            foreach($modulKsztalcenia->getPrzedmiot() as $przedmiot) {
                $przedmiot->setModulKsztalcenia($modulKsztalcenia);
            }

            /** @var Kurs $kurs */
            foreach ($modulKsztalcenia->getKurs() as $kurs) {
                $kurs->addModulKsztalcenia($modulKsztalcenia);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('modulksztalcenia_edit', array('id' => $modulKsztalcenium->getId()));
        }

        return $this->render('@Przedmiot/modulksztalcenia/edit.html.twig', array(
            'modulKsztalcenium' => $modulKsztalcenium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a modulKsztalcenium entity.
     *
     * @Route("/{id}", name="modulksztalcenia_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ModulKsztalcenia $modulKsztalcenium)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_SUPER_ADMIN)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($modulKsztalcenium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modulKsztalcenium);
            $em->flush();
        }

        return $this->redirectToRoute('modulksztalcenia_index');
    }

    /**
     * Creates a form to delete a modulKsztalcenium entity.
     *
     * @param ModulKsztalcenia $modulKsztalcenium The modulKsztalcenium entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(ModulKsztalcenia $modulKsztalcenium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modulksztalcenia_delete', array('id' => $modulKsztalcenium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
