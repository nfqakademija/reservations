<?php

namespace Reservations\FrontendBundle\Controller;

use Reservations\FrontendBundle\Form\Type\BarType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Reservations\CoreBundle\Entity\Bar;

/**
 * Bar controller.
 *
 */
class BarController extends Controller
{

    /**
     * Lists all Bar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ReservationsCoreBundle:Bar')->findByUserId($this->getUser()->getId());

        if (!$entities) {
            return $this->redirect($this->generateUrl('bar_new'));
        }

        return $this->render('ReservationsFrontendBundle:Bar:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Bar entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Bar();
        $form = $this->getCreateForm(
            $entity,
            $this->generateUrl('bar_create'),
            'POST',
            $this->get('translator')->trans('reservations.frontend.dashboard.add')
        );
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setUserId($this->getUser());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bar'));
        }

        return $this->render('ReservationsFrontendBundle:Bar:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Bar entity.
     *
     */
    public function newAction()
    {
        $entity = new Bar();
        $form   = $this->getCreateForm(
            $entity,
            $this->generateUrl('bar_create'),
            'POST',
            $this->get('translator')->trans('reservations.frontend.dashboard.add')
        );

        return $this->render('ReservationsFrontendBundle:Bar:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bar entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->get('reservations.core.search.bar')->getBarInfoById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bar entity.');
        }

        $editForm = $this->getCreateForm(
            $entity,
            $this->generateUrl('bar_update', array('id' => $entity->getId())),
            'PUT',
            $this->get('translator')->trans('reservations.frontend.dashboard.edit')
        );

        return $this->render('ReservationsFrontendBundle:Bar:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
     * Edits an existing Bar entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationsCoreBundle:Bar')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bar entity.');
        }

        $editForm = $this->getCreateForm(
            $entity,
            $this->generateUrl('bar_update', array('id' => $entity->getId())),
            'PUT',
            $this->get('translator')->trans('reservations.frontend.dashboard.edit')
        );
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bar_edit', array('id' => $id)));
        }

        return $this->render('ReservationsFrontendBundle:Bar:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ));
    }

    /**
     * Create form
     * @param Bar $entity
     * @param     $action
     * @param     $method
     * @param     $label
     * @return \Symfony\Component\Form\Form
     */
    private function getCreateForm(Bar $entity, $action, $method, $label)
    {
        $form = $this->createForm(new BarType(), $entity, array(
                'action' => $action,
                'method' => $method,
            ));

        $form->add('submit', 'submit', array(
                'label' => $label
            ));

        return $form;
    }
}
