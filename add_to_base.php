<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
<title>Оценка рыночной стоймости объекта</title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="">
<meta name="keywords" content="">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
</head>
<body>
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

function add_to_selected_table($table,$arr_row){
$query = mysql_query("INSERT INTO ".$table."
VALUES (4,'Nilsen', 'Johan', 'Bakken 2', 'Stavanger');");
}

function add_to_base_summary(){
}

?>
</body>
</html>