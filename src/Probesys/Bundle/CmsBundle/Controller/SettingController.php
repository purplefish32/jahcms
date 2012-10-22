<?php
/**
 * MIT License
 * ===========
 *
 * Copyright (c) 2012 Donovan Tengblad <contact@donovan-tengblad.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 *
 * @category   Controller
 * @package    JahCMS
 * @subpackage CmsBundle
 * @author     Donovan Tengblad <contant@donovan-tengblad.com>
 * @copyright  2012 Donovan Tengblad.
 * @license    http://www.opensource.org/licenses/mit-license.php  MIT License
 * @version    0.1
 * @link       http://donovan-tengblad.com
 */
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
