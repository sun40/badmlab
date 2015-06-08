<?php session_start(); ?> <!-- Cтарт сессии пользователя -->
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

                            <table id="regdone">
                                <tr>
                                    <td>
                                        <!-- Вывод формы для выбора изображения -->
                                        <form method="post" enctype="multipart/form-data">
                                            <p>Загрузить файл:</p>

                                            <!-- кнопка для выбора файла изображения -->
                                            <p><input name="file" size="18" type="file" value=""></p>

                                            <!-- кнопка для подтверждения загрузки изображения на сервер -->
                                            <p><input name="submit" type="submit" value="Загрузить"></p>

                                            <?php
                                            //Получение переменных содержащих пути к файлам из глоб переменной $_FILES
                                            $file = $_FILES['file']['tmp_name'];
                                            //Получение переменных содержащих имена файлой из глоб переменной $_FILES
                                            $filename = $_FILES['file']['name'];

                                            //Если пременная с путями файла не пуста, пробуем загрузить картинку
                                            if (!empty($file)) {
                                                //Устанавливаем предел используемой памяти в 32 МБ
                                                ini_set('memory_limit', '32M');

                                                //Максимальный размер файла = 10мб (задано в байтах)
                                                $maxsize = "83886080";

                                                //Допустимые разширения изображения
                                                $extentions = array("gif", "jpg", "jpeg", "png");

                                                //получаем размер загружаемого файла
                                                $size = filesize($_FILES['file']['tmp_name']);

                                                //получаем разшерение загружаемого файла
                                                $type = strtolower(substr($filename, 1 + strrpos($filename, ".")));

                                                //формируем имя файла, которое будет на сервере у загруженного файла
                                                //в формате file-текущее-время.разширение
                                                $new_name = 'file-' . time() . '.' . $type;

                                                //если размер загружаемого файла больше допустимого
                                                //выводим сообщение об ошибке
                                                if ($size > $maxsize) {
                                                    echo "Файл больше 10 мб. Уменьшите размер вашего файла или загрузите другой. <br><a href='' onClick=window.close();>Закрыть окно</a>";

                                                //проверяем соответсвует раширение файла одному из допустимых
                                                //если нет вывовдим сообщение об ошибке
                                                } elseif (!in_array($type, $extentions)) {
                                                    echo ' <b>Файл имеет недопустимое расширение</b>. Допустимыми являются форматы "gif","jpg","jpeg","png". <br>';

                                                //Если ошибок не обнаружено - загружаем файл на сервер
                                                } else {

                                                    //возвращаемся в корневую директорию сайта
                                                    $dots = "../";

                                                    //Копируем выбранный файл в директорию
                                                    //img/photo/имя_файла_на_сервере
                                                    //если функция copy - вернула значение true - загрузка успешна
                                                    //выводим соответсвующее сообщение и ссылки
                                                    // к уменьшенной копиии и оригиналу на сайте
                                                    //Если функция вернула - false - значит возникла ошибка и выводим
                                                    //соответсвующее сообщение
                                                    if (copy($file, $dots . "img/photo/" . $new_name)) {
                                                        echo "<br><center>Файл загружен!</center>";
                                                        include('blocks/includes/Thumbnail.php');
                                                        //переменные содержащие пути к оригиналу и
                                                        // будующей уменьшенной копии
                                                        //на сервере
                                                        $input_file = $dots . "img/photo/" . $new_name;
                                                        $output_file = $dots . "img/photo/thumbs/thumb-" . $new_name;
                                                        //создаем уменьшенную копию изображения
                                                        //с помощью библиотеки для обрезки изображения
                                                        Thumbnail::output($input_file, $output_file);

                                                        $tt = "http://badm.ua/";
                                                        //переменные содержащие ссылки на оригинальное изображение и
                                                        //уменьшенную копию
                                                        $tfull = $tt . "img/photo/" . $new_name;
                                                        $tthumb = $tt . "img/photo/thumbs/thumb-" . $new_name;

                                                        //вывод ссылок на загруженный оригинал и уменьшенную копию
                                                        echo("<br><center><font color='green'>адрес файла: <a href='" . $tfull . "' >" . $tfull . "</a></font></center>");
                                                        echo("<center><font color='green'>уменьшенная копия: <a href='" . $tthumb . "' >" . $tthumb . "</a></font></center>");

                                                        //подключение к БД
                                                        include("blocks/connect.php");

                                                        //переменные содержащие пути к оригиналу и уменьшенной копии
                                                        //на сервере
                                                        $fullpath = "/img/photo/" . $new_name;
                                                        $thumbpath = "/img/photo/thumbs/thumb-" . $new_name;

                                                        //Формирование запроса на вставку данных о картинке в базу данных
                                                        $query = "INSERT INTO pics (`pic_id`, `pic_path`, `pic_thumb`) VALUES (NULL, '$fullpath', '$thumbpath')";
                                                        //отпрака запроса в базу данных, в случае ошибки вывести ее на экран
                                                        mysql_query($query) or die(mysql_error());
                                                    } else
                                                        //Вывод ошибки если оригинальный файл не был загружен
                                                        echo "<br><center><font color='red'>Файл НЕ был загружен.</font></center>";
                                                }

                                            }

                                            ?>


                                        </form>
                                    </td>
                                </tr>
                            </table>


                            <a href=''></a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td><?php include("blocks/footer.php"); ?></td>
        </tr>
    </table>
</center>

</body>


</html>