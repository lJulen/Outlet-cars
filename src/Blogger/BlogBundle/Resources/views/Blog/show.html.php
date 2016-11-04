<!-- src/Blogger/BlogBundle/Resources/views/Blog/show.html.php -->
<?php $view->extend('::layout.html.php') ?>

<?php $view['slots']->set('title', 'Post details') ?>

<h1><?php echo $post->getTitle() ?></h1>
<div class="date">
	<?php echo $post->getDate()->format('d-m-Y') ?>
</div>
<div class="body">
	<?php echo $post->getBody() ?>
</div>


