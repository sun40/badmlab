<?php session_start(); ?>
<?php include("blocks/connect.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

	<head>
		<?php include("blocks/head.php"); ?>	
	</head>
	
	
	<body background="../img/2.png">
		<center>
			<table id="maintable" background="../img/4.png" >
				<tr>
					<td bgcolor="black">				
			
			
				
						<?php include("../blocks/header.php"); ?>
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
								
								<?php 
									if ($_POST[action] == "add_news"){
										$title = "&rarr;".$_POST[title];
										$prev = $_POST[preview];
										$text = $_POST[full];
										$date = date('h:i d.m.y');
										$id = $_SESSION['id'];
										$query = "INSERT INTO articles (`article_id`, `article_title`, `article_prev`, `article_text`, `article_type`, `user_id`, `article_date`) VALUES (NULL, '$title', '$prev', '$text', 'n', '$id', '$date')";
										mysql_query($query) or die(mysql_error());
										header("Location: http://myhost.net/news.php");																				
									}
									elseif($_POST[action] == "edit_news") {
										$id = $_POST[nid];
										$title = $_POST[title];
										$prev = $_POST[preview];
										$text = $_POST[full];
										
										$query = "UPDATE articles SET article_title = '$title', article_prev = '$prev', article_text = '$text' WHERE article_id = '$id'";
										mysql_query($query) or die(mysql_error());
										header("Location: http://myhost.net/index.php");	
										
		
									}
									if ($_POST[action] == "add_article"){
										$title = "&rarr;".$_POST[title];
										$prev = $_POST[preview];
										$text = $_POST[full];
										$date = date('h:i d.m.y');
										$id = $_SESSION['id'];
										$query = "INSERT INTO articles (`article_id`, `article_title`, `article_prev`, `article_text`, `article_type`, `user_id`, `article_date`) VALUES (NULL, '$title', '$prev', '$text', 'a', '$id', '$date')";
										mysql_query($query) or die(mysql_error());
										header("Location: http://myhost.net/articles.php");																				
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