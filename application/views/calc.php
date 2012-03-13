<div>
<?
echo $this->cal_mod->count_etalon($all_base)." рублей	- средняя цена<br>";
foreach($arr_table as $a_t)
{
$this->cal_mod->count_correct($a_t[0],$this->cal_mod->count_etalon($all_base),$a_t[1]);
}
//$c = $this->cal_mod->count_area_array();
//foreach($c as $cc)
//{
//		echo "<b>".$cc[2]."</b>";
//}
//$this->cal_mod->count_market_cost($arr_table);

?>
</div>