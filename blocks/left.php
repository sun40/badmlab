<!-- Список меню слева -->
<div id="menu">
	<ul>
		<li><a href="../index.php">Главная</a></li>
		<li><a href="../news.php">Новости</a></li>
		<li><a href="../articles.php">Статьи</a></li>
		<li><a href="../photo.php">Фото</a></a></li>
		<li><a href="../about.php">Про сайт</a></li>
	</ul>
</div>

<?php
    //Если пользователь авторизирован и является
    // администратором либо модератором, тогда
    // отобразить расширенное меню
    if(isset($_SESSION['name']) && (($_SESSION['priv']) == "a" || ($_SESSION['priv']) == "m")){
        echo("<div id='menu2'>");
        echo("<ul>");
        echo("<li><a href='../admin/add_news.php'>Добавить новость</a></li>");
        echo("<li><a href='../admin/add_article.php'>Добавить статью</a></li>");
        echo("<li><a href='../admin/add_img.php'>Добавить фото</a></li>");
        echo("</ul>");
        echo("</div>");
    }
?>

<!-- Отображение рекламных баннеров под меню слева -->
<div align="center">
	<br>
	<br>
	<br>
	<a href=""><img src="../img/banner/hitec.jpg" width="120" height="40" alt="" /></a>
	<br>
	<a href=""><img src="../img/banner/aeroplan.jpg" width="120" height="40" alt="" /></a>
	<br>
	<a href=""><img src="../img/banner/fukuda.jpg" width="120" height="40" alt="" /></a>
	<br>
	<a href=""><img src="../img/banner/tret.gif" width="120" height="40" alt="" /></a>
	<br>
	<a href=""><img src="../img/banner/wilson.gif" width="120" height="40" alt="" /></a>
	<br>
	<a href=""><img src="../img/banner/tronex.gif" width="120" height="40" alt="" /></a>
	<br>
	<a href=""><img src="../img/banner/wmaster.gif" width="120" height="40" alt="" /></a>
</div>