<?php

namespace iList\BackendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use iList\BackendBundle\Entity\Ad;
use iList\BackendBundle\Form\AdType;

/**
 * Ad controller.
 *
 */
class AdController extends Controller
{

    /**
     * Lists all Ad entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('iListBackendBundle:Ad')->findAll();

        return $this->render('iListBackendBundle:Ad:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Ad entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('anuncios_show', array('id' => $entity->getId())));
        }

        return $this->render('iListBackendBundle:Ad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Ad entity.
    *
    * @param Ad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Ad $entity)
    {
        $form = $this->createForm(new AdType(), $entity, array(
            'action' => $this->generateUrl('anuncios_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ad entity.
     *
     */
    public function newAction()
    {
        $entity = new Ad();
        $form   = $this->createCreateForm($entity);

        return $this->render('iListBackendBundle:Ad:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ad entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:Ad:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Ad entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('iListBackendBundle:Ad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Ad entity.
    *
    * @param Ad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ad $entity)
    {
        $form = $this->createForm(new AdType(), $entity, array(
            'action' => $this->generateUrl('anuncios_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Ad entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('anuncios_edit', array('id' => $id)));
        }

        return $this->render('iListBackendBundle:Ad:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ad entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('iListBackendBundle:Ad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('anuncios'));
    }

    /**
     * Creates a form to delete a Ad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('anuncios_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
