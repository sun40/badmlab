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
								<td width="780" valign="top">
									



								<?php
									include("blocks/connect.php");
										
										$num = 3; 
										if (isset($_GET['page'])) 
											$page = $_GET['page'];
										else 
											$page = 1;
								
										$result = mysql_query("SELECT COUNT(*) FROM video"); 
										$posts = mysql_result($result, 0);
										$total = intval(($posts - 1) / $num) + 1; 
										$page = intval($page); 
										if(empty($page) or $page < 0) $page = 1; 
  										if($page > $total) $page = $total; 
										$start = $page * $num - $num; 
																				
										
										$query = "SELECT * FROM video ORDER BY id DESC LIMIT $start, $num";
										$result = mysql_query($query);
										while($row = mysql_fetch_array($result)){
											echo('<table border="0" id="article">');						
											echo('<tr>');
											echo('<td>');
											echo('<div align="center">');
											echo('<div align="right">');
											if (isset($_SESSION['name'])){											
												echo('<form action="process.php" method="post">');
												echo('<input type="hidden" value="del_video" name="track" />');
												echo('<input type="hidden" value="'.$row['id'].'" name="video_id"/>');
												echo('<input type="hidden" value="'.$row['path'].'" name="path"/>');
												echo('<input type="submit" name="clc" id="delete" value=""/>');					
												echo('</form>');
											}
											echo('</div>');
											echo('<object type="application/x-shockwave-flash" data="media/uflvplayer.swf" height="300" width="400"><param name="bgcolor" value="#FFFFFF" /><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="movie" value="/media/uflvplayer.swf" /><param name="FlashVars" value="way='.$row['path'].'&amp;swf=http://myhost.net/media/uflvplayer.swf&amp;w=400&amp;h=300&amp;pic=http://&amp;autoplay=0&amp;tools=1&amp;skin=black&amp;volume=70&amp;q=1&amp;comment='.$row[title].'"/></object>');										
											echo('<form>');
											echo('<input type="button" id="white"/>');					
											echo('</form>');									
											echo('</div>');
											echo('</td>');
											echo('</tr>');
											echo('</table>');
										}
									?>
									
									
									<table border="1" id="article">
										<tr>
											<td>
											<?php 
												 
												$pgs = "video.php";
												if ($page != 1) $pervpage = '<a id="comment" href= ./'.$pgs.'?page=1><<</a>&nbsp;&nbsp;<a id="comment" href= ./'.$pgs.'?page='. ($page - 1) .'><</a> ';  
												if ($page != $total) $nextpage = ' <a id="comment" href= ./'.$pgs.'?page='. ($page + 1) .'>></a>&nbsp;&nbsp;<a id="comment" href= ./'.$pgs.'?page=' .$total. '>>></a>'; 
												
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