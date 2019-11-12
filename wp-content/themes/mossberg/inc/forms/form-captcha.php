<script language="javascript" type="text/javascript">var RecaptchaOptions = {theme:'clean'};</script>
<div id="recaptcha_widget" style="display:none;">
<div id="recaptcha_image"></div>
<div class="recaptcha_icon"><a href="javascript:Recaptcha.reload()"><img src="template/icons/icon-captcha-refresh.png"/></a></div>
<div class="recaptcha_icon recaptcha_only_if_image "><a href="javascript:Recaptcha.switch_type('audio')"><img src="template/icons/icon-captcha-audio.png"/></a></div>
<div class="recaptcha_icon recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')"><img src="template/icons/icon-captcha-image.png"/></a></div>
<div class="recaptcha_icon"><a href="javascript:Recaptcha.showhelp()"><img src="template/icons/icon-captcha-help.png"/></a></div>
<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="form_field" placeholder="CAPTCHA* (Type the 2 words)"/>
</div>
<?php
require_once(TEMPLATEPATH.'/inc/recaptcha/recaptchalib.php');
echo recaptcha_get_html('6LcqVBoTAAAAAIba98OHzdS-GrgjQFsBYjplOBQe');
?>