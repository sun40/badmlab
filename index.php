<?php session_start();?>
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
								<td width="780" valign="top">
									
								<p id="top">Последние новости:</p>





<?php
								
								include("blocks/connect.php");					
								
								$query = "SELECT articles.article_title, article_prev, article_id, article_text, article_type, article_date,  users.user_login FROM articles, users WHERE articles.user_id = users.user_id ORDER BY article_id DESC LIMIT 5";
								$result = mysql_query($query);
									
									while($row = mysql_fetch_array($result))
  									{
  										echo("<table border='0' id='article'>");
										echo("<tr>");
										echo("<td colspan='4'>");
										echo("<h2 id='title'>");
										echo($row['article_title']); 
										echo("</h2>");
										echo("</td>");
										echo("</tr>");
										echo("<tr>");
										echo("<td colspan='4'>");
										echo("<div id='content'>");
										echo($row[article_prev]);
										echo("</div>");
										echo("</td>");
										echo("</tr>");
										echo("<tr>");
										echo("<td>");
										echo("<div id='author'>".$row['user_login']."</div>");
										echo("</td>");
										echo("<td>");
										echo("<div id='data'>".$row['article_date']."</div>");
										echo("</td>");
										echo("<td></td>");
										echo("<td>");
										$queryd = "SELECT id FROM `comments` WHERE page_id =".$row['article_id'];
										$res = mysql_query($queryd);
										$count = mysql_num_rows($res);
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
				<tr><td><?php include("blocks/footer.php"); ?></td></tr>
			</table>
		</center>
	</body>
	
	
</html>