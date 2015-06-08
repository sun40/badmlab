<?
//Подключение к серверу бд, по адресу localhost пользователь root
//без пароля, в случае ошибки воводим сообщение
mysql_connect("localhost","root","") OR DIE("Не могу создать соединение ");
//Результат с бд будет приходить в кодировке cp1251
mysql_query("SET SESSION character_set_results = cp1251;");
//Установка кодировки клиента cp1251
mysql_query("SET SESSION Character_set_client = cp1251;");
mysql_query("SET SESSION Collation_connection = cp1251_general_ci;");
mysql_query("SET SESSION Character_set_connection = cp1251;");
//Подключемся к конкретной базе данных badm_db
mysql_select_db("badm_db") or die(mysql_error());
?>