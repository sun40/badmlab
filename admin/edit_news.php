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
											
											function validate(frm){
												if (frm.title.value.length == 0){
													alert("Заполните заголовок!");
													return false;
													}
													
												if (frm.preview.value.length == 0){
													alert("Заполните предпросмотр!");
													return false;
													}	
													
												if (frm.full.value.length == 0){
													alert("Заполните текст статьи!");
													return false;
													}
												return true;	
												}
									</script>
									
									<?php									
									include("blocks/connect.php");
									$news_id = 	$_POST['news_id'];								
									$query = "SELECT * FROM articles WHERE article_id = '$news_id'";
									$result = mysql_query($query);						
									$id = mysql_result($result,0,"article_id");												
									$title = mysql_result($result,0,"article_title");
									$prev = mysql_result($result,0,"article_prev");
									$text = mysql_result($result,0,"article_text");				
									
									echo('<form name="editnewsform" action="process.php" method="post" onsubmit="return validate(this)">');
									echo('<div id="adder">Введите заголовок(max 70 символов!)</div>');
									echo('<input size="70" name="title" type="text" maxlength="70" id="text" value="'.$title.'"/>');
									echo('<div id="adder">Введите текст предпосмотра новости(max 700 символов!)</div>');
									echo('<textarea id="text" name="preview" rows="10" cols="100" maxlength="700" onkeypress="return isNotMax(event)">'.$prev.'</textarea>');
									echo('<div id="adder">Введите полный текст новости</div>');
									echo('<textarea id="text" name="full" rows="15" cols="100">'.$text.'</textarea>');
									echo('<input type="hidden" name="action" value="edit_news"/>');
									echo('<input type="hidden" name="nid" value="'.$id.'"/>');
									echo('<input type="submit" value="Отправить" id="asubmit"/>');			
									echo('</form>');

									
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