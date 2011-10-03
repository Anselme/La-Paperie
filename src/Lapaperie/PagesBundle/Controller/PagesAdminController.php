<?php

namespace Lapaperie\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Lapaperie\PagesBundle\Entity\Page;
use Lapaperie\PagesBundle\Form\PageType;

/**
 * Pages Admin controller.
 *
 * @Route("/admin/pages")
 */
class PagesAdminController extends Controller
{
    /**
     * Lists all Pages entities.
     *
     * @Route("/", name="pages")
     * @Template("LapaperiePagesBundle:Admin:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('LapaperiePagesBundle:Page')->findAll();

        return array('entities' => $entities);
    }


    /**
     * Displays a form to edit an existing Page entity.
     *
     * @Route("/{id}/edit", name="page_edit")
     * @Template("LapaperiePagesBundle:Admin:edit.html.twig")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('LapaperiePagesBundle:Page')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Page entity.');
        }

        $editForm = $this->createForm(new PageType(), $entity);

        $request = $this->getRequest();

        if ($request->getMethod() == 'POST') {

            $editForm->bindRequest($request);

            if ($editForm->isValid()) {
                $entity->uploadImg();
                $entity->uploadFile();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('page_edit', array('id' => $id)));
            }
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
        );
    }
}
