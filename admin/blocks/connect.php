<?
mysql_connect("localhost","root","") OR DIE("Не могу создать соединение ");
mysql_query("SET SESSION character_set_results = cp1251;");
mysql_query("SET SESSION Character_set_client = cp1251;");
mysql_query("SET SESSION Character_set_results = cp1251;");
mysql_query("SET SESSION Collation_connection = cp1251_general_ci;");
mysql_query("SET SESSION Character_set_connection = cp1251;"); 
mysql_select_db("badm_db") or die(mysql_error());
?>