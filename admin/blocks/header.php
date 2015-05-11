<script type="text/javascript" src="/script/login.js"></script>

<table id="headertable" cellspacing="0" cellpadding="0">
	<tr>
		<td rowspan="2"><img src="../img/header_left.jpg"/></td>
		<td valign="top"><img src="../img/header_center.jpg"/></td>
		<td rowspan="2"><img src="../img/header_right.jpg"/></td>
	</tr>
	<tr>
		<td bgcolor="black" height="62">
		<center>
			<form name="loginform" method="post" action="process.php" onsubmit="return validate(this);">
				<input type="button" name="bt_reg" value="Регистрация" id="bt-reg" onclick="self.location.href='reg.php'"/>
				<input type="text" name="auth_name" value="Имя пользователя" size="10" id="txt-login" onfocus="focusLogin(loginform)"/>
				<input type="password" name="auth_pass" value="password" size="10" id="txt-login" onfocus="focusPassword(loginform)"/>
				<input type="submit" name="bt_login" id="bt-login" value="Вход" onclick="loginCheck(loginForm)" />
			</form>
		</center>
		</td>
	</tr>
</table>
<!-- <img src="../img/logo.png" width="1000" height="200" alt="" /> -->