<?php
// src/Blogger/BlogBundle/Controller/CommentController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Comment;
use Blogger\BlogBundle\Form\CommentType;

/**
 * Comment controller.
 */
class CommentController extends Controller
{
    public function newAction($post_id)
    {
        $post = $this->getPost($post_id);

        $comment = new Comment();
        $comment->setPost($post);
        $form   = $this->createForm(new CommentType(), $comment);

        return $this->render('BloggerBlogBundle:Comment:form.html.twig', array('comment' => $comment,'form'   => $form->createView()));
    }

    public function createAction($post_id)
    {
        $post = $this->getPost($post_id);

        $comment  = new Comment();
        $comment->setPost($post);
        $request = $this->getRequest();
        $form = $this->createForm(new CommentType(), $comment);
        $form->bind($request);

        if ($form->isValid()) {
           $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirect($this->generateUrl('blogger_blog_show', array('id' => $comment->getPost()->getId())) . '#comment-' . $comment->getId());
        }

        return $this->render('BloggerBlogBundle:Comment:create.html.twig', array('comment' => $comment, 'form' => $form->createView()));
    }

    protected function getPost($post_id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('BloggerBlogBundle:Post')->find($post_id);

        if (!$post) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $post;
    }
}
?>
