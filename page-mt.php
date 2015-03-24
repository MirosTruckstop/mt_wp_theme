<?php
	require_once(MT_DIR . '/public/view/ICommon.php');		
	$viewType = get_query_var('mtView');
	$id = intval(get_query_var('mtId'));
	if (defined('MT_DIR') && !empty($id)) {
		try {
			switch ($viewType) {
				case 'bilder/galerie':
					require_once(MT_DIR . '/public/view/Gallery.php');		
					$view = new MT_View_Gallery($id);
					break;
				case 'bilder/kategorie':
					require_once(MT_DIR . '/public/view/Category.php');
					$view = new MT_View_Category($id);
					break;
				case 'fotograf':
					require_once(MT_DIR . '/public/view/Photographer.php');		
					$view = new MT_View_Photographer($id);
					break;
			}
		} catch (Exception $e) {
			require_once(MT_DIR . '/public/view/Error.php');
			$view = new MT_View_Error($e->getMessage());
		}
	} else {
		echo 'Constant MT_DIR is undefined.';
	}
?>

<?php get_header(); ?>
	<article>
		<?php (method_exists($view, outputBreadcrumb) ? $view->outputBreadcrumb() : ''); ?>
		<h2><?php $view->outputTitle(); ?></h2>
		<?php $view->outputContent(); ?>
	</article>
<?php get_footer(); ?>