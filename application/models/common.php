<?
class Common extends CI_Model {

    function __construct()
    {
		$this->load->database();
        // Call the Model constructor
        parent::__construct();
    }
    
	function get_by_id($table,$summary_col){
		$query = $this->db->get_where($table, array('id' => $summary_col));
		$row = $query->row();
		return $row->caption;
	}
	
	function get_indor_by_id($summary_col,$params=false){
		$query = $this->db->get_where("state_indor", array('id' => $summary_col));
		$row = $query->row_array();
		$col_row_age = array(
			'wall_age' => $row['wall_age'] ,
			'floor_age' => $row['floor_age'] ,
			'roof_age' => $row['roof_age'] ,
			'door_age' => $row['door_age'] ,
			'window_age' => $row['window_age'],
			'internal_devices_age' => $row['internal_devices_age']);
		$col_row_state = array(
			'wall_age_id' => $row['wall_id'] ,
			'floor_age_id' => $row['floor_id'] ,
			'roof_age_id' => $row['roof_id'] ,
			'door_age_id' => $row['door_id'] ,
			'window_age_id' => $row['window_id'],
			'internal_devices_age_id' => $row['internal_devices_id']);
		if($params){$col_row=$col_row_age;}else{$col_row=$col_row_state;}
		return $col_row;
	}
	
	function get_field($table){
		$query = $this->db->get($table);
		return $query->result_array();
	}
	
	function add_to_selected_table($table,$arr_row){
		$query = mysql_query("INSERT INTO ".$table."
			VALUES (4,'Nilsen', 'Johan', 'Bakken 2', 'Stavanger');");
	}
	
	function get_houses($from){
	$query = $this->db->get("summary",1,$from);
	return $query->result_array();
	}

	/*function get_arr_field(){
		$file_array = file( "emls.ru-flats.csv" );
		if(!$file_array)
		{
			echo("Ошибка открытия файла");
		}
		else
		{
			for($i=0; $i < count($file_array); $i++)
			{
				$arr[] = explode(";", $file_array[$i]);
			}
		}
	return $arr;
	}*/
	
	function get_id_by_caption($caption,$table){
		$query = $this->db->get_where($table, array('caption' => $caption));
		$row = $query->row_array();
		if(!isset($row["id"])){
			$data = array('caption' => $caption);
			$this->db->insert($table, $data);
			$row["id"] = mysql_insert_id();
		}
		return $row["id"];
	}
	
	function get_arr_fromcsv(){
		//$file = $_POST['file'];
		$skip_char = false;
		$column = "";
		$csv_lines  = file("http://testscript.su/emls.ru-flats.csv");
		if(is_array($csv_lines))
		{
			//разбор csv
			$cnt = count($csv_lines);
			for($i = 0; $i < $cnt; $i++)
			{
				$line = $csv_lines[$i];
				$line = trim($line);
				//указатель на то, что через цикл проходит первый символ столбца
				$first_char = true;
				//номер столбца
				$col_num = 0;
				$length = strlen($line);
				for($b = 0; $b < $length; $b++)
				{
					//переменная $skip_char определяет обрабатывать ли данный символ
					if($skip_char != true)
					{
						//определяет обрабатывать/не обрабатывать строку
						///print $line[$b];
						$process = true;
						//определяем маркер окончания столбца по первому символу
						if($first_char == true)
						{
							if($line[$b] == '"')
							{
								$terminator = '";';
								$process = false;
							}
							else
								$terminator = ';';
						$first_char = false;
						}

						//просматриваем парные кавычки, опредляем их природу
						if($line[$b] == '"')
						{
							$next_char = $line[$b + 1];
							//удвоенные кавычки
							if($next_char == '"')
								$skip_char = true;
							//маркер конца столбца
							elseif($next_char == ';')
							{
								if($terminator == '";')
								{
									$first_char = true;
									$process = false;
									$skip_char = true;
								}
							}
						}

						//определяем природу точки с запятой
						if($process == true)
						{
							if($line[$b] == ';')
							{
								if($terminator == ';')
								{

									$first_char = true;
									$process = false;
								}
							}
						}

						if($process == true)
						$column .= $line[$b];

						if($b == ($length - 1))
						{
							$first_char = true;
						}

						if($first_char == true)
						{

							$values[$i][$col_num] = $column;
							$column = '';
							$col_num++;
						}
					}
					else
						$skip_char = false;
				}
			}
		}
   return $values;
	}
}
?>