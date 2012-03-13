<?
class Calc_model extends CI_Model {

    function __construct()
    {
		$this->load->database();
        // Call the Model constructor
        parent::__construct();
    }
	
	//функция возвращает среднее арифметическое(в столбец площади) для каждого поля $table.
	//$name_of_needed_column столбец из таблицы summary который соответствует столбцу из $table
	
	function count_area_array(){//посчитать массив значений площади и занести в базу
		$this->db->select_max('area');
		$query = $this->db->get('summary');
		$row = $query->row_array();
		$i = $row['area'];
		$j=1;//херня какая-то но подругому ошибку выдает
		while($i>10)
		{
			$arr[$j][1] =$i;//max
			$i=$i-10;
			$arr[$j][2] = $i+1;//min
			$j++;
		}
		$arr[$j][1]=$i;
		$arr[$j][2]=1;
		foreach($arr as $a)
		{
			$this->db->insert('area_correction', array('caption'=>$a[1].'-'.$a[2])); 
		}
		return $arr;
	}
	
	function input_area_value($arr_to_table){
		foreach($arr_to_table as $att)
		{
			$query = $this->db->query("SELECT * FROM summary WHERE `area`<".$att[1]." AND `area`>".$att[2].";");
			$arr_flat_summary[] = $query->result_array();
		}
		return	$arr_flat_summary;
	}
	
    function mid_cost($table,$name_of_needed_column){//считает среднюю стоймость
		$query = $this->db->get($table);
		$table_array = $query->result_array();
		foreach($table_array as $t_arr)
		{
			$i=1;
			$summ=0;
			
			switch($table) // переключающее выражение
			{
			case ($table=="count_room"&&$t_arr['id']==5):
				$this->db->where($name_of_needed_column.' >=', 5); 
				$query = $this->db->get('summary'); 
			break;

			case 'floor_of_house':
					switch($t_arr['id'])
					{
					case 1:
						$query = $this->db->get_where('summary', array($name_of_needed_column => '1'));
					break;
					case 2:
						$query = $this->db->query("SELECT * FROM `summary` WHERE `floor_of_house_id`<>'1' and `floors` =  `floor_of_house_id`;");
					break;
					/*case 3:
						
					break;*/
					}
			break;
			
			case 'area_correction':
					$area=explode("-",$t_arr['caption']);
					$query = $this->db->query("SELECT * FROM summary WHERE `area`<=".$area[0]." AND `area`>=".$area[1].";");
			break;
			
			default:		 
				$query = $this->db->get_where('summary', array($name_of_needed_column => $t_arr['id']));
			}
			
			$arr_needed_column = $query->result_array();
			foreach($arr_needed_column as $anc)
			{
				$summ+=(int)($anc['cost']/(int)$anc['area']);//стоимости объектов
				//if($table=="area_correction"&&$i==1){echo $t_arr['caption']."____".$anc['id']."==".$summ."<br>";}
				$i++;//количество объектов
			}
			if($i!=0){$mid_value = (int)($summ/$i);}else{$mid_value =0;}//вот это средняя площадь
				$this->db->where('id', $t_arr['id']);
				$this->db->update($table, array('mid_value' => $mid_value,'count' =>$i));
		}
	}
	
	function count_etalon($arr){//считает эталон
		$sum=0;
		$i=0;
		foreach($arr as $a_b)
		{
			$sum = $sum+($a_b['cost'])/((int)$a_b['area']);
			$i++;
		}
		$etalon_cost = (int)($sum/$i);
		return $etalon_cost;
	}
	
	function count_correct($table,$etalon_value,$name_of_needed_column){//считает корректировки
		$this->mid_cost($table,$name_of_needed_column);
		$query = $this->db->get($table);
		$table_array = $query->result_array();
		foreach($table_array as $t_arr)
		{
			$correct = $t_arr['mid_value']/$etalon_value;
			$this->db->where('id', $t_arr['id']);
			$this->db->update($table, array('correction' => $correct));
		}
	}
	
	function count_market_cost($table_id_arr){//считает рыночную стоймость
		$query = $this->db->get("summary");
		$table_array = $query->result_array();
		foreach($table_array as $t_arr)
		{
			$market_cost = $t_arr['cost'];
			foreach($table_id_arr as $ati)
			{
				if($t_arr[$ati[1]]!="")
				{
				
					if($ati[1]=='floors')
					{
					
						switch($t_arr['floors']){
						case $t_arr['floor_of_house_id']:
							$query_new = $this->db->get_where($ati[0], array('id' => 3));
							$row = $query_new->row_array();
							$market_cost = $market_cost*$row['correction'];
						break;
						case 1:
							$query_new = $this->db->get_where($ati[0], array('id' => 1));
							$row = $query_new->row_array();
							$market_cost = $market_cost*$row['correction'];
						break;
						default:	
							$query_new = $this->db->get_where($ati[0], array('id' => 2));
							$row = $query_new->row_array();
							$market_cost = $market_cost*$row['correction'];
						}
						
					}
					else
					{
						$query_new = $this->db->get_where($ati[0], array('id' => $t_arr[$ati[1]]));
						$row = $query_new->row_array();
						$market_cost = $market_cost*$row['correction'];
					}
					//echo $t_arr['id'].'<br>';
				}
			}	
			$this->db->where('id', $t_arr['id']);
			$this->db->update('summary', array('market_cost' => $market_cost));
		}
	}
}
?>