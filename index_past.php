<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<title>Оценка рыночной стоймости объекта</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
</head>

<?
$dblocation = "localhost";
$dbname = "mydb";
$dbuser = "root";
$dbpasswd = "";
$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
if (!$dbcnx) 
{
  echo( "<P>В настоящий момент сервер базы данных не доступен, поэтому 
            корректное отображение страницы невозможно.</P>" );
  exit();
}
if (!@mysql_select_db($dbname, $dbcnx)) 
{
  echo( "<P>В настоящий момент база данных не доступна, поэтому
            корректное отображение страницы невозможно.</P>" );
  exit();
}


function write_field_input($input_name,$text){
echo '
<tr>
	<td class="text">
		'.$text.'
	</td>
	<td class="input">
		<input name="'.$input_name.'">
	</td>
</tr>';
}

function write_field_select($input_name,$text,$arr_opt){
echo'
<tr>
	<td class="text">
		'.$text.'
	</td>
	<td class="input">
		<select name="'.$input_name.'">';
foreach($arr_opt as $a_o)
{
	echo'<option>'.$a_o.'</option>';
}				
echo'
	</select>
	</td>
</tr>
';
}

function get_arr_from_table($table)
{
	$query = mysql_query("select * from ".$table.";");
	while($sql_query = mysql_fetch_array($query))
	{
		$naim_ar[]=$sql_query['caption'];
	}
	return $naim_ar;
}
?>
<div class="house">
<form action="appraisal.php" method="post">
<table>
<tr>
<td colspan="2">
<hr>
</td>
</tr>
	<?
write_field_select("obj_name","Наименование объекта", get_arr_from_table("object_name"));
write_field_select("cnt_rm","Количество комнат", get_arr_from_table("count_room"));
write_field_input("plmnt","Месторасположение");
write_field_select("city_regadm","Административный округ города", get_arr_from_table("city_region_administrat"));
write_field_select("microreg","Микрорайон города", get_arr_from_table("microregion_sity"));
write_field_input("area","Площадь");
write_field_input("floors","Этажность дома");
write_field_select("floor_of_house","Этаж расположения в доме", get_arr_from_table("floor_of_house"));
write_field_select("wall_material","Конструктивное решение (материал стен)", get_arr_from_table("wall_material"));
write_field_input("age_house","Год постройки дома");
write_field_select("segment","Сегмент рынка", get_arr_from_table("segment"));
write_field_select("series","Серия", get_arr_from_table("series"));
write_field_select("type_indor","Тип и класс качества внутренней отделки", get_arr_from_table("type_indor"));
write_field_input("reapir_room","Отсутствие ремонта в части квартиры");
	?>
<tr>
<td colspan="2">
<hr>
<center>Вид и состояние внутренней отделки</center>
<hr>
</td>
</tr>
<?
write_field_select("state_indor_door","Двери", get_arr_from_table("state_indor_door"));
write_field_select("state_indor_floor","Пол", get_arr_from_table("state_indor_floor"));
write_field_select("state_indor_internal_devices","Внутренние санитарно-технические и электрические устройства", get_arr_from_table("state_indor_internal_devices"));
write_field_select("state_indor_roof","Потолок", get_arr_from_table("state_indor_roof"));
write_field_select("state_indor_wall","Стены и перегородки", get_arr_from_table("state_indor_wall"));
write_field_select("state_indor_window","Окна", get_arr_from_table("state_indor_window"));
?>
<tr>
<td colspan="2">
<hr>
<center>Возраст внутренней отделки</center>
<hr>
</td>
</tr>
<?
write_field_input("wall","Стены и перегородки");
write_field_input("floor","Пол");
write_field_input("roof","Потолок");
write_field_input("door","Двери");
write_field_input("window","Окна");
write_field_input("internal_devices","Внутренние санитарно-технические и электрические устройства");
?>
<tr>
<td colspan="2">
<hr>
</td>
</tr>
<?
write_field_input("character_price","Характер цены");
?>
<tr>
<td colspan="2">
<hr>
</td>
</tr>
<tr>
<td colspan="2">
<center><input type="submit" value="Отправить на рассмотрение"></center>
</td>
</tr>
</table>
</form>
</div>