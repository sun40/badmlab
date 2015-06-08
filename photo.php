<?php session_start(); ?><!-- Cтарт сессии пользователя -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

	<head>
        <!-- Включение контекста html -->
		<?php include("blocks/head.php"); ?>	
		<script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>
		<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />

        <!-- Скрипт для подключения библиотке отображения слайдов HighSlide -->
		<script type="text/javascript">
			hs.graphicsDir = 'highslide/graphics/';
			hs.align = 'center';
			hs.transitions = ['expand', 'crossfade'];
			hs.wrapperClassName = 'dark borderless floating-caption';
			hs.fadeInOut = true;
			hs.dimmingOpacity = .75;

			if (hs.addSlideshow) hs.addSlideshow({
				interval: 5000,
				repeat: false,
				useControls: true,
				fixedControls: 'fit',
				overlayOptions: {
					opacity: .6,
					position: 'bottom center',
					hideOnMouseOut: true
				}
			});
		</script>
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
									<div class="highslide-gallery">

									<?php
                                        //Подключение к базе данных
										include("blocks/connect.php");
                                        //формирование запроса к БД для картинок
										$query = "SELECT pic_id, pic_path, pic_thumb FROM pics ORDER BY pic_id DESC";
                                        //Отправка запроса к бд и сохранение рез-та в $result
										$result = mysql_query($query);
                                        //Отображение картинок в цикле
										while($row = mysql_fetch_array($result)){
											echo('<table border="0" id="article">');						
											echo('<tr>');
											echo('<td>');
											echo('<div align="center">');
											echo('<div align="right">');
                                            //Если пользователь админ или модер, отображаем кнопку удаления картинки
											if (isset($_SESSION['name']) && ($_SESSION[priv] == 'a' || $_SESSION[priv] == 'm')){
                                                //Форма с кнопкой для удаления картинки
												echo('<form action="process.php" method="post">');
												echo('<input type="hidden" value="del_pic" name="track" />');
												echo('<input type="hidden" value="'.$row['pic_id'].'" name="pic_id"/>');
												echo('<input type="hidden" value="'.$row['pic_path'].'" name="pic_path"/>');
												echo('<input type="hidden" value="'.$row['pic_thumb'].'" name="pic_thumb"/>');
												echo('<input type="submit" name="clc" id="delete" value=""/>');					
												echo('</form>');
											}
											echo('</div>');
                                            //Выводим уменьшенную копию картинки
                                            //И помщяем ссылку на увеличенную копию изображения
                                            //при открытии которой полявляется слайдшоу
                                            //С помощью библиотеки HighSlide
											echo('<a href="'.$row['pic_path'].'" class="highslide" onclick="return hs.expand(this)">');
											echo('<img src="'.$row['pic_thumb'].'" alt="Файл изображение отсутствует!" title="Нажмите чтобы увеличить" />');
											echo('</a>');										
											echo('<form>');
											echo('<input type="button" id="white"/>');					
											echo('</form>');									
											echo('</div>');
											echo('</td>');
											echo('</tr>');
											echo('</table>');
										}
									?>
									</tr>
								</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr><td>
                        <!-- Подключение футера -->
                        <?php include("blocks/footer.php"); ?>
                    </td></tr>
			</table>
		</center>
	</body>
	
	
</html>>