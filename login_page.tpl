<div id="loginForm" class="{class}">
<form  method="post" action="">
<div class="baseform">
	<table class="tableform">
		<tr>
			<td><input type="text" name="login_name" placeholder="{login-method}"/></td>
		</tr>
		<tr>
			<td><input type="password" name="login_password" placeholder="Пароль"/></td>
		</tr>
		<tr>
		  <td><div><a href="{lostpassword-link}">Забыли?</a></div><div><a href="{registration-link}">Регистрация</a></div></td>
		</tr>
		<tr>
		<td>
      <div class="sociallogin">
			[vk]<a href="{vk_url}" target="_blank" class="vk">vk</a>[/vk]
			[odnoklassniki]<a href="{odnoklassniki_url}" target="_blank"><img src="{THEME}/images/social/odnoklassniki.gif" /></a>[/odnoklassniki]
			[facebook]<a href="{facebook_url}" target="_blank"><img src="{THEME}/images/social/facebook.gif" /></a>[/facebook]
			[mailru]<a href="{mailru_url}" target="_blank"><img src="{THEME}/images/social/mailru.gif" /></a>[/mailru]
			[yandex]<a href="{yandex_url}" target="_blank"><img src="{THEME}/images/social/yandex.gif" /></a>[/yandex]
			[google]<a href="{google_url}" target="_blank"><img src="{THEME}/images/social/google.gif" /></a>[/google]
		  </div>		
		</td>
		</tr>
	</table>
	<div class="fieldsubmit">
		<button name="send_btn" type="submit"><span>Вход</span></button>
	</div>
</div>
<input name="login" type="hidden" id="login" value="submit">
</form>
{btnClose}
</div>
