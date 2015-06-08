<?php session_start();?> <!-- Cтарт сессии пользователя -->
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
									
								<p id="top">Последние новости:</p>

							<!-- отображение 5 последних новостей и комментариев -->
							<?php	
								//Подключение к базе данных	
								include("blocks/connect.php");				
								
								//Запрос к базе данных, для 5 последних новостей и статей
								$query = "SELECT articles.article_title, article_prev, article_id, article_text, article_type, article_date,  users.user_login FROM articles, users WHERE articles.user_id = users.user_id ORDER BY article_id DESC LIMIT 5";
								//Получение результата запроса к базе данных
								$result = mysql_query($query);
								
									// Вывод полученных данных
									while($row = mysql_fetch_array($result))  
  									{
  										echo("<table border='0' id='article'>");
										echo("<tr>");
										echo("<td colspan='4'>");
										echo("<h2 id='title'>");
										//Вывод заголовка статьи
										echo($row['article_title']); 
										echo("</h2>");
										echo("</td>");
										echo("</tr>");
										echo("<tr>");
										echo("<td colspan='4'>");
										echo("<div id='content'>");
										//Вывод краткого содержания
										echo($row[article_prev]);	
										echo("</div>");
										echo("</td>");
										echo("</tr>");
										echo("<tr>");
										echo("<td>");
										//Вывод автора статьи
										echo("<div id='author'>".$row['user_login']."</div>");	
										echo("</td>");
										echo("<td>");
										//Вывод даты создания статьи
										echo("<div id='data'>".$row['article_date']."</div>");	
										echo("</td>");
										echo("<td></td>");
										echo("<td>");
										//Запрос к базе данных, для получения кол-ва коментариев к статье
										$queryd = "SELECT id FROM `comments` WHERE page_id =".$row['article_id']; 
										$res = mysql_query($queryd);
										 //Кол-во комментариев
										$count = mysql_num_rows($res);
										//Вывод кол-ва коментариев
										echo("<div align='right'><a href='comments.php?id=".$row['article_id']."' id='comment'>Комментарии(".$count.")</a></div>"); 
										echo("</td>");
										echo("</tr>");
										echo("</table>");
  									}
  								?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- Подключение футера -->
				<tr><td><?php include("blocks/footer.php"); ?></td></tr>
			</table>
		</center>
	</body>
</html>