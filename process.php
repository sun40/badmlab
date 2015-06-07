<?php session_start(); ?> <!-- Старт сессии -->
<!-- Подключение к базе данных -->
<?php include("blocks/connect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

	<head>
        <!-- Подключение контекста html-->
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
								<td width="780" valign="top">
														
									<table id="regdone">
										<tr>
											<td>
                                                <!-- скрипт для перенаправления пользователя
                                                 на главную страничку через 5 сек -->
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
											
												<?php
													//Обработка запросов, которые пришли через
													// глобальную переменную-массив $_POST

                                                    //обработка данных при регистрации пользователя
													if($_POST[track] == "reg")
													{
														$login = $_POST[login];
														$email = $_POST[email];
														$pass = $_POST[pass];
                                                        //если поля не пустые делает запрос к бд
														if (($login != "") && ($email != "") && ($pass != "")){
                                                            //вставка нового поля в таблицу users
                                                            $query = "INSERT INTO users (`user_id`, `user_login`, `user_email`, `user_pass`, `user_priv`) VALUES (NULL, '$login', '$email', '$pass', 'u')";
                                                            //запрос к бд
                                                            mysql_query($query) or die(mysql_error());
                                                            //закрытие соединения с бд
                                                            mysql_close();
                                                            //Перенаправление на страницу с успешной регистрацией
                                                            echo("<script type='text/javascript'>");
                                                            echo("location.href='http://badm.ua/reg_seccess.php';");
                                                            echo("</script>");
														}
                                                        //Если одно из полей было не заполнено выводим ошибку
														else
                                                            echo("<div align='center'>Post method is empty!</div>");
												   }
                                                    //Обработка данных при регистрации пользователя
												 	elseif($_POST[track] == "auth"){
												 		$login = $_POST[auth_name];
												 		$pass = $_POST[auth_pass];

                                                        //Запрос к бд - выбрать пользователя с данным логином
                                                        // и паролем
												 		$query = "SELECT * FROM `users` WHERE user_login = '$login' and user_pass = '$pass'";
												 		//Получение результатов запроса
                                                        $result = mysql_query($query);
                                                        //получение кол-ва строк из запроса
												 		$rows = mysql_num_rows($result);
                                                        //если кол-во строк равно 0
                                                        //значит пользователь не существует с таким
                                                        // логином, либо пароль не верен
												 		if ($rows == 0){
												 			echo("<font color='red'>Пользователь не найден либо пароль не совпадает!</font>");
												 		}
												 		else{
                                                            //Если данные введены правильно
                                                            //тогда получаем данные о пользователе из рез-та
                                                            //запроса
												 			$id = mysql_result($result,0,"user_id");
												 			$name = mysql_result($result,0,"user_login");
												 			$priv = mysql_result($result, 0, "user_priv");

                                                            //записываем данные пользователя
                                                            //в глобальную переменную-массив сессии
                                                            //и выводим сообщение о перенаправлении
															$_SESSION['id'] = $id;
															$_SESSION['name'] = $name;
															$_SESSION['priv'] = $priv;			
												 			
												 			echo("Добро пожаловать на сайт, ".$name."!");
												 			echo("<br><br><div>Вы будете перенаправлены на главную страницу через <span id='timer'></span> секунд.</div>");
												 			echo("<div>Если ваш браузер не поддерживает автоматического перенаправления воспользуйтесь <a href='http://badm.ua/index.php' >ссылкой</a> </div>");
												 			
												 		}
											 		}
                                                    //обработка запроса для выхода пользователя
											 		elseif($_POST[track] == "logout") {
                                                        //уничтожаем переменные сессии
											 			session_destroy();
                                                        //перенаправляем пользователя на главную страничку
														echo("<script type='text/javascript'>");
														echo("location.href='http://badm.ua/index.php';");
														echo("</script>");
											 		}
                                                    //обработка запроса на добавление комментария
											 		elseif($_POST[track] == "comment") {
											 			$page = $_POST['page'];
                                                        //получение айди пользователя из переменной сессии
											 			$user = $_SESSION['id'];
                                                        //получение текущей даты в формате часы:минуты день.месяц.год
											 			$date = date('h:i d.m.y');
											 			$text = $_POST['comm_text'];

                                                        //отображение текущего айди статьи
											 			echo($page);
                                                        //формирование запроса на вставку нового комментария в бд
											 			$query = "INSERT INTO comments (id, date, text, page_id, user_id) VALUES (NULL, '$date', '$text', '$page', '$user')";
                                                        //отправка запроса в бд
														mysql_query($query) or die(mysql_error());
                                                        //перенаправление на предыдущую страницу,
                                                        // откуда был отправлен комментарий
														echo("<script type='text/javascript'>");
														echo("location.href='http://badm.ua/comments.php?id=".$page."';");
														echo("</script>");
		
											 		}
                                                    //обработка запроса на удаление картинки
											 		elseif($_POST[track] == "del_pic") {
											 			$pic = $_POST['pic_id'];
                                                        //формирование запроса на удаление картинки
											 			$query = "DELETE FROM pics WHERE pic_id = '$pic'";
                                                        //запрос на удаление к бд
											 			mysql_query($query) or die(mysql_error());
                                                        //перенаправление на станичку с фотографиями
														echo("<script type='text/javascript'>");
														echo("location.href='http://badm.ua/photo.php';");
														echo("</script>");
											 		}
                                                    //обработка запроса на удаление новости
											 		elseif($_POST[track] == "del_news") {
											 			$news_id = $_POST['news_id'];
                                                        //формирование запроса на удаление новости
											 			$query = "DELETE FROM articles WHERE article_id = '$news_id'";
                                                        //запрос на удаление к бд
											 			mysql_query($query) or die(mysql_error());
                                                        //перенаправление пользователя на главную страничку
														echo("<script type='text/javascript'>");
														echo("location.href='http://badm.ua/index.php';");
														echo("</script>");
											 		}
                                                    //обработка запроса на удаление комментария
											 		elseif($_POST[track] == "del_com") {
											 			$cid = $_POST[com_id];
											 			$back = $_POST[back];
                                                        //формирование запроса на удаление комментария
											 			$query = "DELETE FROM comments WHERE id = '$cid'";
                                                        //запрос на удаление к бд
											 			mysql_query($query) or die(mysql_error());
                                                        //перенаправление пользователя на главную страничку
														echo("<script type='text/javascript'>");
														echo("location.href='http://badm.ua/comments.php?id=".$back."';");
														echo("</script>");
											 			//header("Location: http://badm.ua/comments.php?id=".$back);
											 			
											 		}
												?>
											</td>
										</tr>
									</table>
									
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>
                        <!-- подключение футера -->
                        <?php include("blocks/footer.php"); ?>
                    </td></tr>
			</table>
		</center>
	</body>
	
	
</html>