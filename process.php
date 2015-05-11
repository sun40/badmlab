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
														
									<table id="regdone">
										<tr>
											<td>
											
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
													
													if($_POST[track] == "reg")
													{
														$login = $_POST[login];
														$email = $_POST[email];
														$pass = $_POST[pass];
														if (($login != "") || ($email != "") || ($pass != "")){
														$query = "INSERT INTO users (`user_id`, `user_login`, `user_email`, `user_pass`, `user_priv`) VALUES (NULL, '$login', '$email', '$pass', 'u')";
														mysql_query($query) or die(mysql_error());
														mysql_close();
														header("Location: http://myhost.net/reg_seccess.php");
														}		
														else echo("<div align='center'>Post method is empty!</div>"); 
												   }
												 	elseif($_POST[track] == "auth"){
												 		$login = $_POST[auth_name];
												 		$pass = $_POST[auth_pass];
												 		
												 		$query = "SELECT * FROM `users` WHERE user_login = '$login' and user_pass = '$pass'";
												 		$result = mysql_query($query);
												 		$rows = mysql_num_rows($result);
												 		if ($rows == 0){
												 			echo("<font color='red'>Пользователь не найден либо пароль не совпадает!</font>");
												 		}
												 		else{
												 			$id = mysql_result($result,0,"user_id");
												 			$name = mysql_result($result,0,"user_login");
												 			$priv = mysql_result($result, 0, "user_priv");

															$_SESSION['id'] = $id;
															$_SESSION['name'] = $name;
															$_SESSION['priv'] = $priv;			
												 			
												 			echo("Добро пожаловать на сайт, ".$name."!");
												 			echo("<br><br><div>Вы будете перенаправлены на главную страницу через <span id='timer'></span> секунд.</div>");
												 			echo("<div>Если ваш браузер не поддерживает автоматического перенаправления воспользуйтесь <a href='http://myhost.net/index.php' >ссылкой</a> </div>");
												 			
												 		}
											 		}
											 		elseif($_POST[track] == "logout") {
											 			session_destroy();
											 			header("Location: http://myhost.net/index.php");
											 		}
											 		elseif($_POST[track] == "comment") {
											 			$page = $_POST['page'];
											 			$user = $_SESSION['id'];
											 			$date = date('h:i d.m.y');
											 			$text = $_POST['comm_text'];
											 			
											 			echo($page);
											 			$query = "INSERT INTO comments (id, date, text, page_id, user_id) VALUES (NULL, '$date', '$text', '$page', '$user')";
														mysql_query($query) or die(mysql_error());
														header("Location: http://myhost.net/comments.php?id=".$page);		
											 		}
											 		elseif($_POST[track] == "del_pic") {
											 			$pic = $_POST['pic_id'];
											 			$query = "DELETE FROM pics WHERE pic_id = '$pic'";
											 			mysql_query($query) or die(mysql_error());
											 			$picthumb = $_POST['pic_thumb'];
											 			$picpath = $_POST['pic_path'];
											 			unlink("/home/sun40/etc/web".$picthumb);
											 			unlink("/home/sun40/etc/web".$picpath);
											 			header("Location: http://myhost.net/photo.php");
											 		}
											 		elseif($_POST[track] == "del_news") {
											 			$news_id = $_POST['news_id'];
											 			$query = "DELETE FROM articles WHERE article_id = '$news_id'";
											 			mysql_query($query) or die(mysql_error());
														header("Location: http://myhost.net/index.php");
											 		}
											 		elseif($_POST[track] == "del_video") {
											 			echo($_POST['video_id']);
											 			echo($_POST['path']);
											 			$vid = $_POST['video_id'];
											 			$path = $_POST['path'];
											 			$query = "DELETE FROM video WHERE id = '$vid'";
											 			mysql_query($query) or die(mysql_error());
											 			unlink("/home/sun40/etc/web".$path);
											 			header("Location: http://myhost.net/video.php");
											 		}
											 		elseif($_POST[track] == "del_com") {
											 			$cid = $_POST[com_id];
											 			$back = $_POST[back];
											 			$query = "DELETE FROM comments WHERE id = '$cid'";
											 			mysql_query($query) or die(mysql_error());
											 			header("Location: http://myhost.net/comments.php?id=".$back);
											 			
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
				<tr><td><?php include("blocks/footer.php"); ?></td></tr>
			</table>
		</center>
	</body>
	
	
</html>