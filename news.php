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
									
								
								
								
								<?php
								
								$num = 5; 
								if (isset($_GET['page'])) 
									$page = $_GET['page'];
								else 
									 $page = 1;
								
								$result = mysql_query("SELECT COUNT(*) FROM articles WHERE article_type = 'n'"); 
								$posts = mysql_result($result, 0); 
								$total = intval(($posts - 1) / $num) + 1; 
								$page = intval($page); 
								if(empty($page) or $page < 0) $page = 1; 
  								if($page > $total) $page = $total; 
								$start = $page * $num - $num; 
															
								
								$query = "SELECT articles.article_title, article_prev, article_id, article_text, article_type, article_date,  users.user_login FROM articles, users WHERE articles.user_id = users.user_id and article_type = 'n' ORDER BY article_id DESC LIMIT $start, $num";
								$result = mysql_query($query);
									
								if(isset($_SESSION[name]) && ($_SESSION[priv] == 'a' || $_SESSION[priv] == 'm')){	
									
									while($row = mysql_fetch_array($result))
  									{
 
  										echo('<table border="0" id="article">');
										echo('<tr>');
										echo('<td colspan="3" width="780">');
										echo('<h2 id="title">');
										echo($row['article_title']);
										echo('</h2>');												
										echo('</td>');
										echo('<td valign="top">');
										echo('<div align="right">');
										echo('<form name="edit" method="post" action="/admin/edit_news.php">');
										echo('<input type="submit" name="edit_button" value="" id="bt-edit"/>');	
										echo('<input type="hidden" name="news_id" value="'.$row[article_id].'"/>');											
										echo('</form>');											
										echo('</div>');
										echo('<div align="right">');
										echo('<form name="delete" method="post" action="process.php">');
										echo('<input type="submit" name="delete_button" value="" id="delete"/>');
										echo('<input type="hidden" name="news_id" value="'.$row[article_id].'"/>');
										echo('<input type="hidden" name="track" value="del_news" />');												
										echo('</form>');
										echo('</div>');
										echo('</td>');
										echo('</tr>');
										echo('<tr>');
										echo('<td colspan="4">');
										echo('<div id="content">');
										echo($row[article_prev]); 										
										echo('</div>');
										echo('</td>');
										echo('</tr>');
										echo('<tr>');
										echo('<td>');
										echo("<div id='author'>".$row['user_login']."</div>");
										echo('</td>');
										echo('<td>');
										echo("<div id='data'>".$row['article_date']."</div>");
										echo('</td>');
										$queryd = "SELECT id FROM `comments` WHERE page_id =".$row['article_id'];
										$res = mysql_query($queryd);
										$count = mysql_num_rows($res);
										echo('<td><div align="right"><a href="comments.php?id='.$row[article_id].'" id="comment">Комментарии('.$count.')</a></div></td>');
										echo('<td>');										
										echo('</td>');
										echo('</tr>');
										echo('</table>');
  									}
  								}
  								else {
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
  									
  								}
								?>

									<table border="1" id="article">
										<tr>
											<td>
											<?php 
												 
												$pgs = "news.php";
												if ($page != 1) $pervpage = '<a id="comment" href= ./'.$pgs.'?page=1><<</a><a id="comment" href= ./'.$pgs.'?page='. ($page - 1) .'><</a> ';  
												if ($page != $total) $nextpage = ' <a id="comment" href= ./'.$pgs.'?page='. ($page + 1) .'>></a><a id="comment" href= ./'.$pgs.'?page=' .$total. '>>></a>'; 
												
												if($page - 2 > 0) $page2left = ' <a id="comment" href= ./'.$pgs.'?page='. ($page - 2) .'>'. ($page - 2) .'</a> | '; 
												if($page - 1 > 0) $page1left = '<a id="comment" href= ./'.$pgs.'?page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
												if($page + 2 <= $total) $page2right = ' | <a id="comment" href= ./'.$pgs.'?page='. ($page + 2) .'>'. ($page + 2) .'</a>'; 
												if($page + 1 <= $total) $page1right = ' | <a id="comment" href= ./'.$pgs.'?page='. ($page + 1) .'>'. ($page + 1) .'</a>';
												
												echo("<div align=center>"); 
												echo $pervpage.$page2left.$page1left.'<b id="page">'.$page.'</b>'.$page1right.$page2right.$nextpage;
												echo("</div>"); 

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