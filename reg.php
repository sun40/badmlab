<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

	<head>
		<?php include("blocks/head.php"); ?>		
	</head>
	
	
	<body background="img/2.png">
		<center>
			<table id="maintable" background="img/4.png" >
				<tr>
					<td bgcolor="black">				
			
			
				
						<?php include("blocks/header.php"); ?>
					</td>
				</tr>
				<tr>
					<td>
						<table id="maintable">
							<tr>
								<td id="menuleft" align="top">
									<?php include("blocks/left.php"); ?>
								</td> 
								<td width="780">
								
								<script type="text/javascript" src="/script/reg.js"></script>
								<form name="reg" action="process.php" method="POST" onsubmit="return checkReg(reg)">	
									<table border="0" id="regform">
										<tr >
											<td colspan="2"><div id="regtitle">Форма регистрации</div></td>
										</tr>
										<tr>
											<td id="reg"><div id="text_reg">Введите логин:</div></td>
											<td><input name="login" type="text" size="20" id="inp_reg" maxlength="15" ></td>
										</tr>
										<tr>
											<td  id="reg"><div id="text_reg">Введите e-mail:</div></td>
											<td><input name="email" type="text" size="20" id="inp_reg" maxlength="20"></td>
										</tr>
										<tr>
											<td  id="reg"><div id="text_reg">Повторите e-mail:</div></td>
											<td><input name="email_rep" type="text" size="20" id="inp_reg" maxlength="20"></td>
										</tr>
										<tr>
											<td  id="reg"><div id="text_reg">Введите пароль:</div></td>
											<td><input name="pass" type="password" size="20" id="inp_reg" maxlength="15"></td>
										</tr>
										<tr>
											<td  id="reg"><div id="text_reg">Повторите пароль:</div></td>
											<td><input name="pass_rep" type="password" size="20" id="inp_reg" maxlength="15"></td>
										</tr>
										<tr>
											<td colspan="2" align="center"><input type="submit" value="Отправить" size="20" id="bt_reg"></td>
										</tr>
									</table>
									<input type="hidden" name="track" value="reg"/>
								</form>
									
									
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td><?php include("blocks/footer.php"); ?></td></tr>
			</table>
		</center>
	</body>
	
	
</html>