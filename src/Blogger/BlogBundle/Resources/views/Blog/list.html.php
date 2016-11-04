<!-- src/Blogger/BlogBundle/Resources/views/Blog/list.html.php -->
<?php $view->extend('::layout.html.php') ?>

<?php $view['slots']->set('title', 'List of Posts') ?>

<h1>List of Posts</h1>
<ul>
	<?php foreach ($posts as $post): ?>
	<li>
		<a href="<?php echo $view['router']->generate('blogger_blog_show', array('id' => $post->getId())) ?>">
			<?php echo $post->getTitle() ?>
		</a>
	</li>
	<?php endforeach; ?>
</ul>