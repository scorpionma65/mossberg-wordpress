<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" enctype="multipart/form-data" name="flex_email" id="flex_email" class="form_body">
<input name="email" type="text" class="form_field" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) { echo sanitize_text_field($_POST['email']);}?>" />
<input name="url" type="hidden" value="<?php echo $url;?>" />
<input name="submit" type="submit" class="form_button" id="submit" value="SEND EMAIL"/>
</form>
