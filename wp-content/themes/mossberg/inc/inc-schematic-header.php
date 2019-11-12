<?php
if(!empty($_GET['model'])) {
	// Model
	$model_slug = sanitize_text_field($_GET['model']);
	$model = get_term_by('slug', $model_slug, 'schematic-model');
	$model_title = str_replace('COMING SOON', '', $model->name);
	$model_assembled = trim($model->description);
	$model_parent = $model->parent;
	$model_args = array('post_type'=>'schematic', 'numberposts'=>'-1', 'orderby'=>'post_title', 'order'=>'asc', 'tax_query'=>array(array('taxonomy'=>'schematic-model','field'=>'slug','terms'=>$model_slug)));
}
?>
<div class="content_page">
<div class="breadcrumbs">
<a href="<?php echo get_bloginfo('home');?>/firearms">Firearms</a> / <a href="<?php echo get_bloginfo('home');?>/schematics">Schematics</a> / <?php echo $model_title;?>
</div>
</div>
