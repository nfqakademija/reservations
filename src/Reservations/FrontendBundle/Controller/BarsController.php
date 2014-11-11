<?php

namespace Reservations\FrontendBundle\Controller;

use Reservations\FrontendBundle\Form\Type\BarsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Reservations\CoreBundle\Entity\Bars;

/**
 * Bars controller.
 *
 */
class BarsController extends Controller
{

    /**
     * Lists all Bars entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ReservationsCoreBundle:Bars')->findAll();

        return $this->render('ReservationsFrontendBundle:Bars:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Bars entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Bars();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bars_show', array('id' => $entity->getId())));
        }

        return $this->render('ReservationsFrontendBundle:Bars:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Bars entity.
     *
     * @param Bars $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bars $entity)
    {
        $form = $this->createForm(new BarsType(), $entity, array(
            'action' => $this->generateUrl('bars_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bars entity.
     *
     */
    public function newAction()
    {
        $entity = new Bars();
        $form   = $this->createCreateForm($entity);

        return $this->render('ReservationsFrontendBundle:Bars:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bars entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationsCoreBundle:Bars')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bars entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReservationsFrontendBundle:Bars:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Bars entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationsCoreBundle:Bars')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bars entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ReservationsFrontendBundle:Bars:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Bars entity.
    *
    * @param Bars $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bars $entity)
    {
        $form = $this->createForm(new BarsType(), $entity, array(
            'action' => $this->generateUrl('bars_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bars entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ReservationsCoreBundle:Bars')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bars entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('bars_edit', array('id' => $id)));
        }

        return $this->render('ReservationsFrontendBundle:Bars:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Bars entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ReservationsCoreBundle:Bars')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bars entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bars'));
    }

    /**
     * Creates a form to delete a Bars entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bars_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
