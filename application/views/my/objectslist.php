<?
function spaceDigital($n){
	if (strlen($n)>6) $n = substr($n, 0, -6). " " . substr($n, -6);
    if (strlen($n)>3) $n = substr($n, 0, -3). " " . substr($n, -3);
    return $n;
}
?>

<div class="container">   
    <div class="span-24 pt10">
        <div class="clear"></div>
        <div class="grad-grey p10">
        <table>
            <tr>
            <th class="tthumb">Фото</th>
            <th class="tdate">Дата</th>
            <th class="tao">Административный округ /<br />Район</th>
            <th class="tfloor">Этаж /<br />Этажность</th>
            <th class="trooms">Кол-во<br />комнат</th>
            <th class="tsq">Общая<br />площадь</th>
            <th class="twalls">Констр.<br />решение</th>
            <th class="tcost last-child">Стоимость, руб.</th>
            </tr>
        </table>
        </div>
        
        <table class="p10">
        
        <tr>
            <th class="tthumb"></th>
            <th class="tdate"><a href="#" class="sort-triger active desc"></a></th>
            <th class="tao"><a href="#" class="sort-triger"></a></th>
            <th class="tfloor"><a href="#" class="sort-triger"></a></th>
            <th class="trooms"><a href="#" class="sort-triger"></a></th>
            <th class="tsq"><a href="#" class="sort-triger"></a></th>
            <th class="twalls"><a href="#" class="sort-triger"></a></th>
            <th class="tcost last-child"><a href="#" class="sort-triger"></a></th>
        </tr>
        
        <?
        $counter = 0;
        $odd = '';
        //while ( $counter <= 2){ 
        
        
        
        ($counter++ % 2 === 0) ? $odd = '' : $odd = ' odd';
        
        foreach ($objects as $object ) {
        
        
        ?>
        <tr class="separator<?=$odd?>">
            <td colspan="7" class="obrowtitle">
                <a href="<?=base_url()?>object<?=$object['object_id'];?>/"><?=$object['object_name'];?></a>
            </td>
            <td colspan="2">
                <div class="objactions">
                    <a href="<?=base_url()?>object<?=$object['object_id'];?>/edit/" title="Редактировать объект" class="tipsy objsettings"></a>
                    <a href="<?=base_url()?>object<?=$object['object_id'];?>/delete/" title="Удалить объект" class="tipsy objdel"></a>
                    <div class="clear"></div>
                </div>
            </td>
        </tr>
        <tr class="<?=$odd?>">
            <td class="tthumb"><div></div></td>
            <td class="tdate"><?=date("Y/m/d<br /> H:i:s", $object['object_creation_date']);?></td>
            <td class="tao">Ялуторовский тракт<br />Нефтемаш, Онкодиспансер</td>
            <td class="tfloor">20/24</td>
            <td class="trooms">3</td>
            <td class="tsq">150,2</td>
            <td class="twalls"><a class="tipsy" title="монолитно каркасный">М/К</a></td>
            <td class="tcost last-child"><?=spaceDigital(rand(100000,7000000))?></td>
        </tr>
        
        
        <? } // FOREACH ?>
        </table>
    </div>
    <div class="clear"></div>
    
    
</div>