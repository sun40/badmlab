﻿<?php session_start(); ?> <!-- Cтарт сессии пользователя -->
<?php include("blocks/connect.php"); ?> <!-- Подключение к базе данных -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

	<head>
        <!-- Включение контекста html -->
		<?php include("blocks/head.php"); ?>		
	</head>

	<body background="img/2.png">
		<center>
			<table id="maintable" background="img/4.png" >
				<tr>
					<td bgcolor="black">
                        <!-- Подключение хедера -->
						<?php include("blocks/header.php"); ?>
					</td>
				</tr>
				<tr>
					<td>
						<table id="maintable">
							<tr>
								<td id="menuleft" align="top">
                                    <!-- Подключение меню навигации слева -->
									<?php include("blocks/left.php"); ?>
								</td> 
								<td width="780" valign="top">
														
									<table id="regdone">
										<tr>
											<td>
											<div>Регистрация прошла успешно!</div>
											<div>Можете зайти на сайт используя свой логин и пароль.</div>
											<br><div>Вы будете перенаправлены на главную страницу
											через <span id="timer"></span> секунд.</div>
                                            <!-- Скрипт перенаправления на главную страницу
                                                после регистрации через 5 секунд
                                             -->
											<script type="text/javascript">
											var t=5;
											function refr_time()
											{
  												if (t>0)
  												{
    												t--;
    												document.getElementById('timer').innerHTML=t;
  												} else
  												{
    												clearInterval(tm);
    												location.href='index.php';
  												}
											}
											var tm=setInterval('refr_time();',1000);
											</script>
											<br><div>Если ваш браузер не поддерживает автоматического перенаправления воспользуйтесь <a href="http://badm.ua/index.php" >ссылкой</a> </div>
											
											</td>
										</tr>
									</table>
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>
                        <!-- Подключение футера -->
                        <?php include("blocks/footer.php"); ?>
                    </td></tr>
			</table>
		</center>
	</body>
	
	
</html>