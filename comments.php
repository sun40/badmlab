<?php session_start(); ?>
<?php include("blocks/connect.php"); ?>
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
								
								
									
								
								<?php
								
								$query = "SELECT articles.article_title, article_id, article_text, article_date,  users.user_login FROM articles, users WHERE articles.user_id = users.user_id and article_id ='".$_GET['id']."'";
								$result = mysql_query($query);
								$artid = 0;
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
									echo($row['article_text']);
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
									echo("</td>");
									echo("</tr>");
									echo("</table>");
									$artid = $row[article_id];
  								}
  								
  								
  								
  								$query = "SELECT comments.id, comments.date, comments.text, users.user_login FROM comments, users WHERE page_id = ".$_GET['id']." and users.user_id = comments.user_id";
								$result = mysql_query($query);
								$c = 1;
								
								if ($_SESSION['priv'] != "a"){
									while($row = mysql_fetch_array($result))
  									{
  										echo("<table border='0' id='comment'>");
										echo("<tr id='comment'>");
										echo("<td><div id='number'>#".$c."</div></td>");
										$c++;
										echo("<td><div id='number'>".$row['user_login']."</div></td>");
										echo("<td><div id='date2'>".$row['date']."</div></td>");
										echo("</tr>");
										echo("<tr>");
										echo("<td colspan='3'><form><textarea disabled='true' id='comm' rows='5' cols='103' maxlength='515' onkeypress='return isNotMax(event)'>".$row['text']."</textarea></form></td>");
										echo("</tr>");
										echo("</table>");
									}
								}
								else {
									while($row = mysql_fetch_array($result))
  									{
										echo("<table border='0' id='comment'>");
										echo("<tr id='comment'>");
										echo("<td><div id='number'>#".$c."</div></td>");
										echo("<td><div id='number'>".$row['user_login']."</div></td>");
										echo("<td><div id='date2'>".$row['date']."</div></td>");
										echo("<td>");
										echo("<form method='post' action='process.php'>");
										echo("<input type='submit' name='delcom' id='delete' value=''/>");
										echo("<input type='hidden' name='track' value='del_com' />");
										echo("<input type='hidden'	name='com_id' value='".$row[id]."' />");
										echo("<input type='hidden'	name='back' value='".$artid."' />");
										echo("</form>");
										echo("</td>");
										echo("</tr>");
										echo("<tr>");
										echo("<td colspan='4'><form><textarea disabled='true' id='comm' rows='5' cols='103' maxlength='515' onkeypress='return isNotMax(event)'>".$row['text']."</textarea></form></td>");
										echo("</tr>");							
										echo("</table>");
									}
								}
								?>	
								
							

								
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
if (isset($_SESSION[name])){

								echo('<table border="0" id="comment">');
								echo('<tr id="comment">');
								echo('<td><div id="number">Добавить комментарий</div></td>');
								echo('</tr>');
								echo('<tr>');
								echo('<td>');
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
				<tr><td><?php include("blocks/footer.php"); ?></td></tr>
			</table>
		</center>
	</body>
	
	
</html>