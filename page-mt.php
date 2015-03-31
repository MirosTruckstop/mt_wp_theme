<?php
	if (defined('MT_DIR')) {
		try {
			require_once(MT_DIR . '/public/view/ICommon.php');		
			$viewType = get_query_var('mtView');
			$id = intval(get_query_var('mtId'));
			switch ($viewType) {
				case 'bilder/galerie':
					require_once(MT_DIR . '/public/view/Gallery.php');		
					$view = new MT_View_Gallery($id, get_query_var('mtPage', 1), get_query_var('mtNum', 10), get_query_var('mtSort', 'date'));
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