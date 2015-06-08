<?php session_start(); ?> <!-- Cтарт сессии пользователя -->
<?php include("blocks/connect.php"); ?> <!--  Подключение к базе данных --->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">

<head>
    <!-- Включение контекста html -->
    <?php include("blocks/head.php"); ?>
</head>

<body background="../img/2.png">
<center>
    <table id="maintable" background="../img/4.png">
        <tr>
            <td bgcolor="black">
                <!-- Подключение хедера -->
                <?php include("../blocks/header.php"); ?>
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

                            <?php
                            //Обработка запросов, которые пришли через
                            // глобальную переменную-массив $_POST

                            //Обработка данных для добавления новостей
                            if ($_POST[action] == "add_news") {
                                //получаем значения переменных из глобальной переменной $_POST
                                //Добавляем к тексту стрелочку перед оглавлением новости
                                $title = "&rarr;" . $_POST[title];
                                $prev = $_POST[preview];
                                $text = $_POST[full];
                                //Получение текщей даты
                                $date = date('h:i d.m.y');
                                //Получение айди пользователя из глобальной переменной сессии $_SESSION
                                $id = $_SESSION['id'];
                                //Формирование запроса для вставки новой новости в бд
                                $query = "INSERT INTO articles (`article_id`, `article_title`, `article_prev`, `article_text`, `article_type`, `user_id`, `article_date`) VALUES (NULL, '$title', '$prev', '$text', 'n', '$id', '$date')";
                                //Оправка запроса на вставку в бд, в случае ошибки вывести возникшую ошибку на экран
                                mysql_query($query) or die(mysql_error());
                                //перенаправление на страничку с новостями
                                header("Location: http://badm.ua/news.php");
                            } //Обработка данных для редактирование новости или статьи
                            elseif ($_POST[action] == "edit_news") {
                                //получаем значения переменных из глобальной переменной $_POST
                                $id = $_POST[nid];
                                $title = $_POST[title];
                                $prev = $_POST[preview];
                                $text = $_POST[full];

                                //Формирование запроса для обновления данных
                                // о статье или новости с данным айди в бд
                                $query = "UPDATE articles SET article_title = '$title', article_prev = '$prev', article_text = '$text' WHERE article_id = '$id'";
                                //Оправка запроса в бд, в случае ошибки вывести возникшую ошибку на экран
                                mysql_query($query) or die(mysql_error());
                                //перенаправление на главную страничку
                                header("Location: http://badm.ua/index.php");

                            }

                            //Обработка данных для добавления статей
                            if ($_POST[action] == "add_article") {
                                //получаем значения переменных из глобальной переменной $_POST
                                //Добавляем к тексту стрелочку перед оглавлением статьи
                                $title = "&rarr;" . $_POST[title];
                                $prev = $_POST[preview];
                                $text = $_POST[full];
                                //Получение текщей даты
                                $date = date('h:i d.m.y');
                                //Получение айди пользователя из глобальной переменной сессии $_SESSION
                                $id = $_SESSION['id'];
                                //Формирование запроса для вставки новой статьи в бд
                                $query = "INSERT INTO articles (`article_id`, `article_title`, `article_prev`, `article_text`, `article_type`, `user_id`, `article_date`) VALUES (NULL, '$title', '$prev', '$text', 'a', '$id', '$date')";
                                //Оправка запроса на вставку в бд, в случае ошибки вывести возникшую ошибку на экран
                                mysql_query($query) or die(mysql_error());
                                //перенаправление на страничку со статьями
                                header("Location: http://badm.ua/articles.php");
                            }
                            ?>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <!-- Подключение футера -->
                <?php include("blocks/footer.php"); ?>
            </td>
        </tr>
    </table>
</center>
</body>


</html>