<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<title><?=$title?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<style>
th{
background-color:#80DD80
}
</style>
</head>
<body>
<?
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

function write_field_select($input_name,$arr_opt,$selected){
echo'
		<select name="'.$input_name.'">';
foreach($arr_opt as $a_o)
{
	if($selected==$a_o["id"])
	{
		echo'<option selected value="'.$a_o["id"].'">'.$a_o["caption"].'</option>';
	}
	else
	{
		echo'<option value="'.$a_o["id"].'">'.$a_o["caption"].'</option>';
	}
		
}				
echo'
	</select>
';
}
function get_field($table){
		$query = $this->db->get($table);
		return $query->result_array();
	}
?>
<div class="house">
<?
if(isset($_POST['index_id']))
{
$s = $_POST['index_id'];
$s++;
}
else
{
$s=0;
}
?>
<form action="http://stoymosti-test.net/show/edit/<?=$s?>" method="post">
<table border="1">
<tr>
	<th>Порядковый<br>номер</th>
	<th>Количество<br>комнат</th>
	<th>Месторасположение</th>
	<th>Административный<br>округ<br>города</td>
	<th>Микрорайон<br>города</th>
	<th>Площадь</th>
	<th>Этаж<br>расположения<br>в доме</th>
	<th>Этажность</th>
	<th>Ремонт</th>
	<th>Серия</th>
	<th>Год постройки<br>дома</th>
	<th>Цена</th>
	<th>Примечание</th>
</tr>
<?foreach($houses as $a_o):?>
<tr>
	<td><?=$a_o["id"]?><input type="hidden" value="<?=$a_o["id"]?>" name="id"></td>
	<td><?=$a_o["count_room_id"]?></td>
	<td><?=$a_o["placement"]?></td>
	<td><?=$this->common->get_by_id('city_region_administrat',$a_o['city_region_administrat_id'])?></td>
	<td><?=$this->common->get_by_id('microregion_sity',$a_o['microregion_sity_id'])?></td>
	<td><?=$a_o["area"]?></td>
	<td><?=$a_o['floor_of_house_id']?></td>
	<td><?=$a_o["floors"]?></td>
	<td><?echo write_field_select("repair", $this->common->get_field("type_repair"),$a_o["type_indor_id"]);?></td>
	<td><?=$this->common->get_by_id('series',$a_o['series_id'])?></td>
	<td><input type="text" name="age_house" size="3" value="<?=$a_o["age_house"]?>"></td>
	<td><?=$a_o["cost"]?></td>
	<td><?=$a_o["primech"]?></td>
</tr>
<?endforeach?>
</table>
<input type="hidden" name="index_id" value="<?=$s?>">
<input type="submit" value="GOOOO!!!">
</form>
<?
$data = array(
               'age_house' => $_POST['age_house'],
               'type_indor_id' => $_POST['repair']
            );

$this->db->where('id', $_POST['id']);
$this->db->update('summary', $data); 
// Produces:
// UPDATE mytable 
// SET title = '{$title}', name = '{$name}', date = '{$date}'
// WHERE id = $id
?>
</div>
</body>
</html>