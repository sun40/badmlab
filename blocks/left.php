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
