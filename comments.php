<?php session_start(); ?><!-- Cтарт сессии пользователя -->
<?php include("blocks/connect.php"); ?><!-- Подключение к базе данных -->
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
                                <!-- Скрипт для проверки длины комментария -->
								<script type="text/javascript" >
											function isNotMax(e){
												e = e || window.event;
												var target = e.target || e.srcElement;
												var code=e.keyCode?e.keyCode:(e.which?e.which:e.charCode)

												switch (code){
													case 13:
													case 8:
													case 9:
													case 46:
													case 37:
													case 38:
													case 39:
													case 40:
													return true;
												}
												return target.value.length <= target.getAttribute('maxlength');
											}
											
									</script>
								
								
									
							<!-- Вывод содержимого статьи -->
                            <?php
								//Формирование запроса к БД для выбора данных о статье/новости
								$query = "SELECT articles.article_title, article_id, article_text, article_date,  users.user_login FROM articles, users WHERE articles.user_id = users.user_id and article_id ='".$_GET['id']."'";
                                //Запрос к БД
								$result = mysql_query($query);
								$artid = 0;

                                //Вывод содержимого статьи/новости
								while($row = mysql_fetch_array($result))
  								{
  									echo("<table border='0' id='article'>");
									echo("<tr>");
									echo("<td colspan='4'>");
									echo("<h2 id='title'>");
                                    //Вывод оглавления статьи/новости
									echo($row['article_title']); 
									echo("</h2>");
									echo("</td>");
									echo("</tr>");
									echo("<tr>");
									echo("<td colspan='4'>");
									echo("<div id='content'>");
                                    //Вывод полного текста статьи/новости
									echo($row['article_text']);
									echo("</div>");
									echo("</td>");
									echo("</tr>");
									echo("<tr>");
									echo("<td>");
                                    //Вывод имени автора
									echo("<div id='author'>".$row['user_login']."</div>");
									echo("</td>");
									echo("<td>");
                                    //Вывод даты создания
									echo("<div id='data'>".$row['article_date']."</div>");
									echo("</td>");
									echo("<td></td>");
									echo("<td>");
									echo("</td>");
									echo("</tr>");
									echo("</table>");
                                    //cохранениe айди статьи/новости в переменную $atrid
									$artid = $row[article_id];
  								}
  								
  								
  								//Формирование запроса к БД для комментарие к данной статье/новости
  								$query = "SELECT comments.id, comments.date, comments.text, users.user_login FROM comments, users WHERE page_id = ".$_GET['id']." and users.user_id = comments.user_id";
                                //Запрос к БД и сохранения результата в $result
								$result = mysql_query($query);
                                //Счетчик комментариев
								$c = 1;


                                 //Если пользователь не администратор
                                //отображаем обычный комментарий
								if ($_SESSION['priv'] != "a"){
                                    //отображаем все комментарии в цикле
									while($row = mysql_fetch_array($result))
  									{
  										echo("<table border='0' id='comment'>");
										echo("<tr id='comment'>");
                                        //Вывод номера коментария
										echo("<td><div id='number'>#".$c."</div></td>");
                                        //Увеличиваем счетчик комментариев на 1
										$c++;
                                        //Вывод логина автора комментария
										echo("<td><div id='number'>".$row['user_login']."</div></td>");
                                        //Вывод времени отправки комментария
										echo("<td><div id='date2'>".$row['date']."</div></td>");
										echo("</tr>");
										echo("<tr>");
                                        //Вывод текста комментария
										echo("<td colspan='3'><form><textarea disabled='true' id='comm' rows='5' cols='103' maxlength='515' onkeypress='return isNotMax(event)'>".$row['text']."</textarea></form></td>");
										echo("</tr>");
										echo("</table>");
									}
								}
                                //Отображаем расширенный комментария
                                //С кнопкой удаления
                                //если пользователь с правами администратора
								else {
                                    //отображаем все комментарии в цикле
									while($row = mysql_fetch_array($result))
  									{
										echo("<table border='0' id='comment'>");
										echo("<tr id='comment'>");
                                        //Вывод номера коментария
										echo("<td><div id='number'>#".$c."</div></td>");
                                        //Увеличиваем счетчик комментариев на 1
                                        $c++;
                                        //Вывод логина автора комментария
										echo("<td><div id='number'>".$row['user_login']."</div></td>");
                                        //Вывод времени отправки комментария
										echo("<td><div id='date2'>".$row['date']."</div></td>");
										echo("<td>");
                                        //Вывод формы с кнопкой удаления комментария
										echo("<form method='post' action='process.php'>");
										echo("<input type='submit' name='delcom' id='delete' value=''/>");
										echo("<input type='hidden' name='track' value='del_com' />");
										echo("<input type='hidden'	name='com_id' value='".$row[id]."' />");
										echo("<input type='hidden'	name='back' value='".$artid."' />");
										echo("</form>");
										echo("</td>");
										echo("</tr>");
										echo("<tr>");
                                        //Вывод текста комментария
										echo("<td colspan='4'><form><textarea disabled='true' id='comm' rows='5' cols='103' maxlength='515' onkeypress='return isNotMax(event)'>".$row['text']."</textarea></form></td>");
										echo("</tr>");							
										echo("</table>");
									}
								}
								?>	
								
								<!-- Скрипт для вывода сообщения, если пользователь не ввел текст комметария -->
								<script type="text/javascript" >
									function validate(frm){
										if (frm.comm_text.value.length == 0){
											alert("Сначала напишите комментарий!");
											return false;
											}
										return true;
									}
								</script>


                            <?php
                            //Если пользователь авторизирован - отображаем форму для отправки комментария
                            if (isset($_SESSION[name])){

								echo('<table border="0" id="comment">');
								echo('<tr id="comment">');
								echo('<td><div id="number">Добавить комментарий</div></td>');
								echo('</tr>');
								echo('<tr>');
								echo('<td>');
                                //Вывод формы для ввода комментария
								echo('<form action="process.php" method="post" name="com" onsubmit="return validate(this);">');
								echo('<textarea name="comm_text" id="commtext" rows="5" cols="103" maxlength="515" onkeypress="return isNotMax(event)"></textarea>');
								echo('<input type="hidden" name="track" value="comment" />');
								echo("<input type='hidden' name='page' value='".$_GET['id']."' >");																									
								echo('<center><input id="commtext" type="submit" name="submt" value="Отправить";"/></center>');
								echo('</form>');
								echo('</td>');
								echo('</tr>');
								echo('</table>');
								}
                            ?>
								
											
									
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