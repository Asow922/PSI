<?php

namespace ProgramBundle\Controller;

use ModelBundle\Entity\PlanStudiow;
use ModelBundle\Entity\ProgramStudiow;
use ModelBundle\Entity\Semestr;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

/**
 * Planstudiow controller.
 *
 * @Route("planstudiow")
 */
class PlanStudiowController extends Controller
{
    /**
     * Lists all planStudiow entities.
     *
     * @Route("/", name="planstudiow_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $planStudiows = $em->getRepository('ModelBundle:PlanStudiow')->findAll();

        return $this->render('@Program/planstudiow/index.html.twig', array(
            'planStudiows' => $planStudiows,
        ));
    }

    /**
     * Creates a new planStudiow entity.
     *
     * @Route("/new/{id}", name="planstudiow_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, ProgramStudiow $programStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $planStudiow = new Planstudiow();
        $planStudiow->setProgramStudiow($programStudiow);
        $form = $this->createForm('ModelBundle\Form\PlanStudiowType', $planStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($planStudiow);

            for ($i = 0; $i < $planStudiow->getProgramStudiow()->getLiczbaSemestrow(); $i++) {
                $semestr = new Semestr();
                $semestr->setNumer($i+1);
                $semestr->addPlanStudiow($planStudiow);
                $em->persist($semestr);

            }
            $em->flush();
            return $this->redirectToRoute('planstudiow_show', array('id' => $planStudiow->getId()));
        }

        return $this->render('@Program/planstudiow/new.html.twig', array(
            'planStudiow' => $planStudiow,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a planStudiow entity.
     *
     * @Route("/{id}", name="planstudiow_show")
     * @Method("GET")
     */
    public function showAction(PlanStudiow $planStudiow)
    {
        $deleteForm = $this->createDeleteForm($planStudiow);

        return $this->render('@Program/planstudiow/show.html.twig', array(
            'planStudiow' => $planStudiow,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing planStudiow entity.
     *
     * @Route("/{id}/edit", name="planstudiow_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PlanStudiow $planStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $deleteForm = $this->createDeleteForm($planStudiow);
        $editForm = $this->createForm('ModelBundle\Form\PlanStudiowType', $planStudiow);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planstudiow_edit', array('id' => $planStudiow->getId()));
        }

        return $this->render('@Program/planstudiow/edit.html.twig', array(
            'planStudiow' => $planStudiow,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a planStudiow entity.
     *
     * @Route("/{id}", name="planstudiow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PlanStudiow $planStudiow)
    {
        if (!$this->get('security.authorization_checker')->isGranted(User::ROLE_AUTOR_PROGRAMU_KSZTALCENIA)) {
            throw new AccessDeniedException('Brak dostępu do tej części systemu');
        }

        $form = $this->createDeleteForm($planStudiow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($planStudiow);
            $em->flush();
        }

        return $this->redirectToRoute('planstudiow_index');
    }

    /**
     * Creates a form to delete a planStudiow entity.
     *
     * @param PlanStudiow $planStudiow The planStudiow entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(PlanStudiow $planStudiow)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('planstudiow_delete', array('id' => $planStudiow->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
