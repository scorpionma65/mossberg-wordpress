<?php
/*
Template Name: Schematic Caliber
*/
?>
<?php get_header('modal'); ?>

<?php
// Model
$model_slug = sanitize_text_field($_GET['id']);
$model = get_term_by('slug', $model_slug, 'schematic-model');
$model_title = $model->name;
?>
<div class="content_popup">
<div class="schematic_caliber_select">
<h3><?php echo $model_title;?> Schematic</h3>
Select Caliber:<br/>
<?php
// Caliber Select
echo " <select id=\"caliber\" name=\"caliber\" id=\"caliber\" class=\"schematic_list_calibers\" onchange=\"if(this.selectedIndex!=0) parent.location=this.options[this.selectedIndex].value;\">
<option value=\"\">-</option>";
include(TEMPLATEPATH.'/inc/inc-schematic-caliber.php');
foreach($calibers[$model_slug] as $key => $value) {
	echo "<option value=\"".get_bloginfo('url')."/schematic?model=$model_slug&cal=$key\">$value</option>";
}
echo "</select>";
?>
</div>
</div>