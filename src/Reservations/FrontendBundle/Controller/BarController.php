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
        $entity = $this->get('reservations.core.search.bar')->getBarInfoById($id);

        $editForm = $this->getBarUpdateForm($entity);

        return $this->render('ReservationsFrontendBundle:Bar:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
        $entity = $this->get('reservations.core.search.bar')->getBarInfoById($id);
        $editForm = $this->getBarUpdateForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entity);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('bar_edit', ['id' => $id]));
        }

        return $this->render('ReservationsFrontendBundle:Bar:edit.html.twig', [
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        ]);
    }

     /**
     * @param $entity
     * @return \Symfony\Component\Form\Form
     */
    private function getBarCreateForm($entity)
    {
        $form = $this->createForm(new BarType(), $entity, [
            'action' => $this->generateUrl('bar_create'),
            'method' =>'POST',
        ]);

        $form->add('submit', 'submit', [
            'label' => $this->get('translator')->trans('reservations.frontend.dashboard.add')
        ]);

        return $form;
    }

    /**
     * @param Bar $entity
     * @return \Symfony\Component\Form\Form
     */
    private function getBarUpdateForm($entity)
    {
        $editForm = $this->createForm(new BarType(), $entity, [
            'action' => $this->generateUrl('bar_update', ['id' => $entity->getId()]),
            'method' =>'PUT',
        ]);

        $editForm->add('submit', 'submit', [
            'label' => $this->get('translator')->trans('reservations.frontend.dashboard.edit')
        ]);

        return $editForm;
    }
}
