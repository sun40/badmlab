<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body>
	<form method="post" enctype="multipart/form-data">
		<p>Загрузить файл:</p>
	    <p><input name="file" size="18" type="file" value=""></p>
	    <p><input name="submit" type="submit" value="Загрузить"></p>
	</form>
	<div align='center'>
	<?php
	$file = $_FILES['file']['tmp_name'];
	$filename = $_FILES['file']['name'];
	if(!empty($file))
	{
		ini_set('memory_limit', '32M');
		$maxsize = "100000000";
		$extentions = array("gif","txt","tpl","jpg","jpeg","png","zip","rar","7z","tif","psd","swf","flv","avi","mpeg","mp4","mp3","wav","ogg","ogm","doc","xls","ppt");
			
		$size = filesize ($_FILES['file']['tmp_name']);
		$type = strtolower(substr($filename, 1 + strrpos($filename, ".")));
		$new_name = 'file-'.time().'.'.$type;

		if($size > $maxsize)
		{
	 		echo "Файл больше 100 мб. Уменьшите размер вашего файла или загрузите другой. <br><a href='' onClick=window.close();>Закрыть окно</a>";
		}
	    elseif(!in_array($type,$extentions))
	    {
	    	echo '<b>Файл имеет недопустимое расширение</b>. Допустимыми являются форматы изображений, видеофайлов, флэш-роликов и текстовых документов. <br>';
	    }
		else 
		{
			if (copy($file, "uploads/".$new_name))
				echo "Файл загружен!<br>Скопируйте адрес файла<br> <a href=\"uploads/$new_name\"><b>http://site.com/uploads/$new_name</b></a><br> и нажмите<br><a href='' onClick=history.back();>Вернуться назад</a>";
			else echo "Файл НЕ был загружен.";
		}
		
	}
	?>
	</div>
</body>
</html>