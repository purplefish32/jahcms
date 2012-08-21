<?php

namespace Probesys\Bundle\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Probesys\Bundle\CmsBundle\Entity\Setting;
use Probesys\Bundle\CmsBundle\Form\SettingType;

/**
 * Setting controller.
 *
 * @Route("/admin/setting")
 */
class SettingController extends Controller
{

    /**
     * Lists general settings.
     *
     * @Route("s/general", name="admin_setting_general")
     * @Template()
     */
    public function generalAction()
    {
        return array();
    }

    /**
     * Lists all Setting entities.
     *
     * @Route("/", name="admin_setting")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ProbesysCmsBundle:Setting')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Setting entity.
     *
     * @Route("/{id}/show", name="admin_setting_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProbesysCmsBundle:Setting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Setting entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Setting entity.
     *
     * @Route("/new", name="admin_setting_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Setting();
        $form   = $this->createForm(new SettingType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Setting entity.
     *
     * @Route("/create", name="admin_setting_create")
     * @Method("post")
     * @Template("ProbesysCmsBundle:Setting:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Setting();
        $request = $this->getRequest();
        $form    = $this->createForm(new SettingType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_setting_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Setting entity.
     *
     * @Route("/{id}/edit", name="admin_setting_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProbesysCmsBundle:Setting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Setting entity.');
        }

        $editForm = $this->createForm(new SettingType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Setting entity.
     *
     * @Route("/{id}/update", name="admin_setting_update")
     * @Method("post")
     * @Template("ProbesysCmsBundle:Setting:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ProbesysCmsBundle:Setting')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Setting entity.');
        }

        $editForm   = $this->createForm(new SettingType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_setting_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Setting entity.
     *
     * @Route("/{id}/delete", name="admin_setting_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ProbesysCmsBundle:Setting')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Setting entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_setting'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
