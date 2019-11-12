<h4>Click 'Delete Data' to confirm removal of your personal information from the Mossberg marketing system.</h4>
<form action="<?php echo get_bloginfo('url');?>/privacy-center/data-removal" method="get" name="form_delete" class="form_body">
<input name="token" type="hidden" value="<?php echo $token; ?>" />
<input name="id" type="hidden" value="<?php echo $email; ?>" />
<input name="submit" type="submit" value="Delete Data" class="form_button"/>
</form>