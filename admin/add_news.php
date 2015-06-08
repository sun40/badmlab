<?php session_start(); ?><!-- Cтарт сессии пользователя -->
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
                            <!-- скрипт для проверки длины введенного текста -->
                            <script type="text/javascript">
                                function isNotMax(e) {
                                    e = e || window.event;
                                    var target = e.target || e.srcElement;
                                    var code = e.keyCode ? e.keyCode : (e.which ? e.which : e.charCode)

                                    switch (code) {
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

                                <!-- Скрипт для проверки заполения полей
                                 заголовка новости, краткого содержания и полного содержания -->
                                function validate(frm) {
                                    if (frm.title.value.length == 0) {
                                        alert("Заполните заголовок!");
                                        return false;
                                    }

                                    if (frm.preview.value.length == 0) {
                                        alert("Заполните предпросмотр!");
                                        return false;
                                    }

                                    if (frm.full.value.length == 0) {
                                        alert("Заполните текст статьи!");
                                        return false;
                                    }
                                    return true;
                                }
                            </script>

                            <!-- форма для ввода содержимого новости -->
                            <form name="addnewsform" action="process.php" method="post"
                                  onsubmit="return validate(this)">
                                <div id="adder">Введите заголовок(max 70 символов!)</div>
                                <!-- Поле для ввода заголовка новости -->
                                <input size="70" name="title" type="text" maxlength="70" id="text"/>

                                <div id="adder">Введите текст предпосмотра новости(max 700 символов!)</div>
                                <!-- Поле для ввода краткого содержания новости -->
                                <textarea id="text" name="preview" rows="10" cols="100" maxlength="700"
                                          onkeypress="return isNotMax(event)"></textarea>

                                <div id="adder">Введите полный текст новости</div>
                                <!-- Поле для ввода полного текста новости -->
                                <textarea id="text" name="full" rows="15" cols="100"></textarea>
                                <input type="hidden" name="action" value="add_news"/>
                                <input type="submit" value="Отправить" id="asubmit"/>
                            </form>


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