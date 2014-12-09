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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('ReservationsFrontendBundle:Bar:index.html.twig', [
            'entities' => $this->get('reservations.core.search.bar')->getBarByUser($this->getUser()->getId()),
        ]);
    }

    /**
     * Creates a new Bar entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request)
    {
        $entity = new Bar();
        $form = $this->getBarCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entity->setUserId($this->getUser());
            $entityManager->persist($entity);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('bar'));
        }

        return $this->render('ReservationsFrontendBundle:Bar:new.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * Displays a form to create a new Bar entity.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function newAction()
    {
        $entity = new Bar();
        $form = $this->getBarCreateForm($entity);
        return $this->render('ReservationsFrontendBundle:Bar:new.html.twig', [
            'entity' => $entity,
            'form'   => $form->createView(),
        ]);
    }

    /**
     * Displays a form to edit an existing Bar entity
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function editAction($id)
    {
        list($entity, $editForm) = $this->getBarUpdateForm($id);
        return $this->render('ReservationsFrontendBundle:Bar:edit.html.twig', [
            'entity'    => $entity,
            'edit_form' => $editForm->createView(),
        ]);
    }

    /**
     * Edits an existing Bar entity.
     * @param Request $request
     * @param         $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function updateAction(Request $request, $id)
    {
        list($entity, $editForm) = $this->getBarUpdateForm($id);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('bar_edit', ['id' => $id]));
        }
        return $this->render(
            'ReservationsFrontendBundle:Bar:edit.html.twig',
            ['entity'    => $entity, 'edit_form' => $editForm->createView()]
        );
    }

    /**
     * @return \Symfony\Component\Form\Form
     */
    private function getBarCreateForm($entity)
    {
        $action = $this->generateUrl('bar_create');
        $label = $this->get('translator')->trans('reservations.frontend.dashboard.add');
        $form = $this->getForm($entity, $action, 'POST', $label);
        return $form;
    }

    /**
     * @param $id
     * @internal param Bar $entity
     * @return \Symfony\Component\Form\Form
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    private function getBarUpdateForm($id)
    {
        $entity = $this->get('reservations.core.search.bar')->getBarInfoById($id);
        $action = $this->generateUrl('bar_update', ['id' => $entity->getId()]);
        $label = $this->get('translator')->trans('reservations.frontend.dashboard.edit');
        $editForm = $this->getForm($entity, $action, 'PUT', $label);
        return [$entity, $editForm];
    }

    /**
     * Create form
     * @param Bar $entity
     * @param     $action
     * @param     $method
     * @param     $label
     * @return \Symfony\Component\Form\Form
     */
    private function getForm(Bar $entity, $action, $method, $label)
    {
        $form = $this->createForm(new BarType(), $entity, [
            'action' => $action,
            'method' => $method,
        ]);

        $form->add('submit', 'submit', [
            'label' => $label
        ]);

        return $form;
    }
}
