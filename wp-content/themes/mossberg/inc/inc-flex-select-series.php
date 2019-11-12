<div class="flex_text">
<div class="flex_form">
<form action="<?php echo get_bloginfo('url');?>/flex-select" class="form_body" method="get">

<div class="flex_form_select">
Series:<br/>
<select name="series" class="form_dropdown">
<option value="">-</option>
<?php
$terms = get_terms(array('taxonomy'=>'flex-model','parent'=>0,'hide_empty'=>false));
foreach($terms as $term) {
	$title = $term->name;
	$series = str_replace('flex-config-','',$term->slug); 
	echo "<option value=\"$series\"";
	if($_GET['series'] == $series) {
		echo "selected=\"selected\"";
	}
	echo ">$title</option>";
}
?>
</select>
</div>

<div class="flex_form_select">
Gauge:<br/>
<select name="gauge" class="form_dropdown">
<option value="">-</option>
<option value="12" <?php if($_GET['gauge'] == '12') { echo "selected=\"selected\""; }?>>12 GA</option>
<option value="20" <?php if($_GET['gauge'] == '20') { echo "selected=\"selected\""; }?>>20 GA</option>
</select>
</div>

<div class="flex_form_select">
Capacity:<br/>
<select name="capacity" class="form_dropdown">
<option value="">-</option>
<option value="6" <?php if($_GET['capacity'] == '6') { echo "selected=\"selected\""; }?>>6 Shot</option>
<option value="7" <?php if($_GET['capacity'] == '7') { echo "selected=\"selected\""; }?>>7 Shot</option>
<option value="8" <?php if($_GET['capacity'] == '8') { echo "selected=\"selected\""; }?>>8 Shot</option>
<option value="9" <?php if($_GET['capacity'] == '9') { echo "selected=\"selected\""; }?>>9 Shot</option>
</select>
</div>
<div class="flex_form_select">
<br/>
<input name="submit" type="submit" value="Next" class="form_button"/>
</div>
</form>
</div>
</div>
