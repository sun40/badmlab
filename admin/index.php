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
									<?php 
									if($_SESSION['priv'] == 'a' || $_SESSION['priv'] == 'm'){
										include("blocks/left.php");
									}
									else{
										include("../blocks/left.php");
									}
									?>
								</td> 
								<td width="780" valign="top">
									
									<table id="regdone">
										<tr>
											<td>
											<?php
											if($_SESSION['priv'] == 'a' || $_SESSION['priv'] == 'm'){
												echo("<div>Добро пожаловать в админку!</div>");
												echo("<div>Выбрете действие которое необходимо выполнить на панели слева.</div>");
											}
											else{
												echo("<div>У вас не достаточно прав для просмотра этой страницы.</div>");
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