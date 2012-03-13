<table>
<tr>
	<th style="border:1px solid;background:#f2A2A2">Порядковый<br>номер</th>
	<th style="border:1px solid;background:#f2A2A2">Количество<br>комнат</th>
	<th style="border:1px solid;background:#f2A2A2">Микрорайон<br>города</th>
	<th style="border:1px solid;background:#f2A2A2">Площадь</th>
	<th style="border:1px solid;background:#f2A2A2">Этаж<br>расположения<br>в доме</th>
	<th style="border:1px solid;background:#f2A2A2">Этажность</th>
	<th style="border:1px solid;background:#f2A2A2">Серия</th>
	<th style="border:1px solid;background:#f2A2A2">Ремонт</th>
	<th style="border:1px solid;background:#f2A2A2">Цена</th>
	<th style="border:1px solid;background:#f2A2A2">Примечание</th>
</tr>
<?$j=1;?>
<?foreach($summary as $tmp):?>
<?$j++;?>
<tr <?if(fmod($j,2)==0){echo ' style="background:#A2A2A2"';}?>>
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp["id"]?></td>
	
	<?$query = $this->db->get_where('count_room', array('id' => $tmp["count_room_id"]));$tmp_res = $query->row();?>
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp_res->caption?></td>
	
	<?$query = $this->db->get_where('microregion_sity', array('id' => 1));$tmp_res = $query->row();?>
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp_res->caption?></td>
	
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp["area"]?></td>
	
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp["floors"]?></td>
	
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp["floor_of_house_id"]?></td>
	
	<?$query = $this->db->get_where('series', array('id' => $tmp["series_id"]));$tmp_res = $query->row();?>
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp_res->caption?></td>
	
	<?$query = $this->db->get_where('type_repair', array('id' => $tmp["type_indor_id"]));$tmp_res = $query->row();?>
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp_res->caption?></td>
	
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp["cost"]?></td>
	
	<td style="border-left:1px solid;border-right:1px solid;"><?=$tmp["primech"]?></td>
	
</tr>
<?endforeach?>
</table>