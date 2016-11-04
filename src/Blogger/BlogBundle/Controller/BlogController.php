<?php
// src/Blogger/BlogBundle/Controller/BlogController.php
namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{

	public function listAction()
	{
		// $posts = $this->get('doctrine')->getManager()->createQuery('SELECT p FROM BloggerBlogBundle:Post p')->execute();

		// return $this->render('BloggerBlogBundle:Blog:list.html.twig', array('posts' => $posts));
		//$posts = $this->get('doctrine')->getManager()->createQueryBuilder()->select('p')->from('BloggerBlogBundle:Post',  'p')->addOrderBy('p.date', 'DESC')->getQuery()->getResult();
		$posts = $this->get('doctrine')->getManager()->getRepository('BloggerBlogBundle:Post')->getLatestPosts();
		return $this->render('BloggerBlogBundle:Blog:list.html.twig', array('posts' => $posts));
	}

	public function showAction($id)
	{
		$post = $this->get('doctrine')->getManager()->getRepository('BloggerBlogBundle:Post')->find($id);
		
		if (!$post) {
			throw $this->createNotFoundException('No se ha encontrado el post.');
		}

		$comments = $this->get('doctrine')->getManager()->getRepository('BloggerBlogBundle:Comment')->getCommentsForPost($post->getId());

		return $this->render('BloggerBlogBundle:Blog:show.html.twig', array('post' => $post, 'comments' => $comments));
	}
	public function contactAction()
{
	return $this->render('BloggerBlogBundle:Blog:contact.html.twig');
}
}
?>