<!-- Скрипт для проверки вводимых данных в форму авторизации -->
<script type="text/javascript" src="/script/login.js"></script>

<table id="headertable" cellspacing="0" cellpadding="0">
    <!-- Вывод колонок с изображениями -->
	<tr>
		<td rowspan="2"><img src="../img/header_left.jpg"/></td>
		<td valign="top"><img src="../img/header_center.jpg"/></td>
		<td rowspan="2"><img src="../img/header_right.jpg"/></td>
	</tr>
	<tr>
		<td bgcolor="black" height="62">
        <!-- скрипт для перенаправления на страничку регистрации -->
		<script type="text/javascript" >
			function move(){
				self.location.href='reg.php';
				}
		</script>
		<center>
			<?php
            //Проверка, если переменная name
            // в глобальной переменной-массиве $_SESSION не существует
            // тогда вывод формы для авторизации
			if (!isset($_SESSION['name']))
			{	
			echo("<form name='loginform' method='post' action='http://badm.ua/process.php' onsubmit='return validate(this);'>");
			echo("<input type='button' name='bt_reg' value='Регистрация' id='bt-reg' onclick='move()';/>");
			echo("<input type='text' name='auth_name' value='Имя пользователя' size='10' id='txt-login' onfocus='focusLogin(loginform)'/>");
			echo("<input type='password' name='auth_pass' value='password' size='10' id='txt-login' onfocus='focusPassword(loginform)'/>");
			echo("<input type='submit' name='bt_login' id='bt-login' value='Вход' onclick='loginCheck(loginForm)' />");
			echo("<input type='hidden' name='track' value='auth'/>");
			echo("</form>");
			}
            //Если переменная существует, то
            //вывод логина пользователя и кнопки для выхода
			else 
			{
			echo("<form name='logoutform' method='post' action='http://badm.ua/process.php'>");
			echo("<input type='text' name='name' value='".$_SESSION['name']."' size='20' id='lname'>");
			echo("<input type='submit' name='logout' value='Выход' id='logout'/>");
			echo("<input type='hidden' name='track' value='logout'/>");
			echo("</form>");
			}
		?>
		</center>
		</td>
	</tr>
</table>