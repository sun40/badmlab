<?php session_start(); ?>
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
									
									<table id="regdone">
										<tr>
											<td>
												<form method="post" enctype="multipart/form-data">
   												<p>Загрузить файл:</p>
   												<p><input name="vtitle" size="20" type="text"/></p>
    												<p><input name="file" size="18" type="file" value=""></p>
    												<p><input name="submit" type="submit" value="Загрузить"></p>
    												
    												<?php
    													$tile = $_POST['vtitle'];
														$file = $_FILES['file']['tmp_name'];
														$filename = $_FILES['file']['name'];
														if(!empty($file))
														{
  															ini_set('memory_limit', '32M');
  															$maxsize = "1000000000";
															$extentions = array("gif","jpg","jpeg","png","flv");
  															$size = filesize ($_FILES['file']['tmp_name']);
  															$type = strtolower(substr($filename, 1+strrpos($filename,".")));
  															$new_name = 'video-'.time().'.'.$type;
  															echo($title);
  															if($size > $maxsize)
  															{
     															echo "Файл больше 100 мб. Уменьшите размер вашего файла или загрузите другой. <br><a href='' onClick=window.close();>Закрыть окно</a>";
  															}
  															elseif(!in_array($type,$extentions))
  															{
    															echo ' <b>Файл имеет недопустимое расширение</b>. Допустимыми являются форматы "gif","jpg","jpeg","png". <br>';
  															}
  															else 
  															{
  																$dots = "../";
  																
    															if (copy($file, $dots."media/".$new_name))
      															{
      																echo "<br><center>Файл загружен!</center>";
      																
      																$path = "/media/".$new_name;
																	include("blocks/connect.php");
																	$query = "INSERT INTO video (id, title, path) VALUES (NULL, '$_POST[vtitle]', '$path')";
																	mysql_query($query) or die(mysql_error());
      																
      															}
    															else {
    																echo ("<br><center><font color='red'>Файл НЕ был загружен.</font></center>");
    																}
    																
  															}
														  
														}

														?>
														
    												
    												
    												
												</form> 
											</td>
										</tr>
									</table>


<a href='' ></a>
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