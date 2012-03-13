<div class="fullfit" id="calc">     
    <div class="container">
    
    <div class="span-18 pt10">
			<div style="height:32px;">
		&nbsp;</div>
<form action="index.php" method="post">
        <!--<div class="row">
            <div class="span-6 right"><label for="district">Административный округ</label></div>
            <select name="city_region_administrat" id="f" class="chzn-select" style="width: 380px; float: left;">
    			<option value="" <?if(!isset($resultat)){echo'selected="selected"';}?>>Выберите из списка</option>
				<?foreach($city_region_administrat as $mic_sit):?>
				<option value="<?=$mic_sit['id']?>"<?if((isset($resultat))&&($mic_sit['id']==$new_input_flat['microregion_sity_id'])){echo 'selected="selected"';}?>><?=$mic_sit['caption']?></option>
				<?endforeach;?>
    		</select>
            <div class="clear"></div>
        
        </div>-->
		
		<div class="row">
            <div class="span-6 right"><label for="district">Город</label></div>
            <select class="chzn-select" style="width: 380px; float: left;" name="microregion_sity" data-placeholder="Выберите из списка">
				<option></option>
				<option selected="selected">Тюмень</option>
    		</select>
            <div class="clear"></div>
        
        </div>
		
        <div class="row">
            <div class="span-6 right"><label for="district">Район города</label></div>
            <select class="chzn-select" style="width: 380px; float: left;" name="microregion_sity" data-placeholder="Выберите из списка">
				<option></option>
    			<?foreach($microregion_sity as $mic_sit):?>
				<option value="<?=$mic_sit['id']?>" <?if((isset($resultat))&&($mic_sit['id']==$new_input_flat['microregion_sity_id'])){echo 'selected="selected"';}?>><?=$mic_sit['caption']?></option>
				<?endforeach;?>
    		</select>
            <div class="clear"></div>
        
        </div>
		<!--<div class="row">
        
            <div class="span-16">
                <div class="span-6 right pt10"><label>Месторасположение</label></div>
                <input type="text" class="text span-10 center"  name="placement"/>
                <div class="clear"></div>
            </div>
            
        </div>-->
		
        <div class="row">
            <div class="span-6 right"><label for="district">Этажность дома</label></div>
			<div style="float:left;"><select class="chzn-select" style="width: 100px;float: left;" name="floors" data-placeholder="Выберите из списка" id="floors_flat">
				<option></option>
                <?for($i=1;$i<=24;$i++):?>
				<option value="<?=$i?>" <?if(isset($resultat)&&$floor_target_ball==$i){echo 'selected="selected"';}?>><?=$i?></option>
				<?endfor;?>
			</select></div>
			<!--<input type="text" class="text span-3 center"  name="floors" value="" style="float:left;margin-top:0px;"/>-->
			<div class="span-5 right" style="margin-left:0px;width:170px;"><label>Площадь,&nbsp;м²</label></div>
            <input type="text" class="text span-3 center"  name="area" style="float:left;margin-top:0px;" value=<?if(isset($new_input_flat['area'])){echo '"'.$new_input_flat['area'].'"';}else{echo'"0"';}?>/>
        </div>
		<div class="row">
			<div class="span-6 right"><label for="district">Этаж квартиры</label></div>
			<div style="float:left;"><select class="chzn-select" style="width: 100px;float: left;" name="floor_of_house" data-placeholder="Выберите из списка" id="select_floor_flat">
				<option></option>
                <?
				if(isset($resultat)){$n=$floor_target_ball;}else{$n=24;}
				for($i=1;$i<=$n;$i++):?>
				<option value="<?=$i?>" <?if((isset($resultat))&&($i==$new_input_flat['floor_of_house_id'])){echo 'selected="selected"';}?>><?=$i?></option>
				<?endfor;?>
			</select></div>
				<script>
			$("#floors_flat").chosen().change(function(){
			var s =$('#floors_flat').val();
			var optimus_prime = "<option></option>";
			var i = 1;
			for (i=1;i<=s;i++)
			{
				optimus_prime = optimus_prime + "<option>" + i + "</option>";
			}
			$('#select_floor_flat').html(optimus_prime);
			//$('#input_floor_form_city').val(3);
			$("#select_floor_flat").chosen();
			$("#select_floor_flat").trigger("liszt:updated");
			});
		</script>
			<div class="span-5 right" style="margin-left:0px;width:170px;"><label>Количество комнат</label></div>
			<div style="float:left"><select class="chzn-select" style="width: 100px; float: left;" name="count_room" data-placeholder="Выберите из списка">
				<option></option>
    			<?foreach($count_room as $mic_sit):?>
				<option value="<?=$mic_sit['id']?>" <?if((isset($resultat))&&($mic_sit['id']==$new_input_flat['count_room_id'])){echo 'selected="selected"';}?>><?=$mic_sit['caption']?></option>
				<?endforeach;?>
    		</select></div>
			<div class="clear"></div>
		</div>
		<div class="row">
        
            <div class="span-5 right" style="margin-left:40px;line-height: 13px;padding-top:8px;"><label>Серия дома</label></div>
            <select class="chzn-select" style="width: 380px; float: left;" name="type_indor" data-placeholder="Выберите из списка">
				<option></option>
    			<?foreach($series as $mic_sit):?>
				<option value="<?=$mic_sit['id']?>" <?if((isset($resultat))&&($mic_sit['id']==$new_input_flat['type_indor_id'])){echo 'selected="selected"';}?>><?=$mic_sit['caption']?></option>
				<?endforeach;?>
    		</select>
            <div class="clear"></div>
            
        </div>
        <div class="row">
        
            <div class="span-5 right" style="margin-left:40px;line-height: 13px;"><label>Тип и состояние внутренней отделки</label></div>
            <select class="chzn-select" style="width: 380px; float: left;" name="type_repair" data-placeholder="Выберите из списка">
				<option></option>
    			<?foreach($type_repair as $mic_sit):?>
				<option value="<?=$mic_sit['id']?>" <?if((isset($resultat))&&($mic_sit['id']==$new_input_flat['type_indor_id'])){echo 'selected="selected"';}?>><?=$mic_sit['caption']?></option>
				<?endforeach;?>
    		</select>
            <div class="clear"></div>
            
        </div>
		<div style="height:30px;">
		<?if(isset($resultat)){?>
		<div class="row">
        
            <div class="span-8">
				<div class="span-20 center"><label>
				<?
				$resultat_sum = round($resultat_sum,-4);
				$res = number_format($resultat_sum, 0, ',', ' ' );
				echo "<b><font color='red' style=\"padding-left:25px;\">".$res." рублей</b></font>";
				?></label></div>
				<div class="span-20 center pt10"></div>
                <div class="clear"></div>
            </div>
            
        </div>
<?}?>		
&nbsp;</div>
        <div class="row">
        <div class="prepend-7 span-10">
			<input type="hidden" name="status" value="ready">
            <input type="submit" class="orangebutton large p1020i" value="Рассчитать стоимость" />
        </div>
        </div>	
    </div>
    </form>
    <div class="span-6">
    <img src="<?=base_url()?>images/regbanner.gif" style="margin-bottom: 40px;" />
    <input type="submit" class="bluebutton large p1020i" value="РЕГИСТРИРУЙСЯ!" style="width:230px;" />
    </div>
    
    
    
    
    <div class="clear"></div>

    </div>
</div>    
    
    
<div class="container">   
    <div class="span-18 pt10">
   
        <h2 style="height:25px;"><div style="float:left;">Последние расчеты</div>
		<div style="float:left;width:495px;text-align:right;" id="pricen">&nbsp;<input type="text" class="text span-3 center" style="" name="check_cost" id="check_cost" />
				<input type="submit" class="orangebutton strong p510i" value="Прицениться" style="margin-top:6px;" id="check_submit"/></div>
		</h2>
				<!--<div id="check_cost" style="display:none;">
					<center>
					<label for="district">Введите стоймость </label><br />
					<input type="text" class="text"  name="cost" id="cost" /><br />
					<input type="submit" class="orangebutton strong p510i" value="Прицениться" id="check_cost_button"/>
					<div id="test"></div>
					</center>
				</div>-->
		<script>
		/*$("#pricen").hover(function(){
			$("#check_cost").fadeIn("fast");
		},function(){
			$("#check_cost").fadeOut("fast");
		});*/
		</script>
        <div class="clear"></div>
        <div class="grad-grey p10">
        <table>
            <tr>
            <th class="tdate" style="text-align:center;">Дата</th>
            <th class="tao" style="width:340px;text-align:center;">Район</th>
            <th class="tfloor" style="text-align:center;">Этаж</th>
            <th class="trooms" style="text-align:center;">Комнат</th>
            <th class="tsq" style="text-align:center;">Площадь</th>
            <th class="twalls" style="width:140px;text-align:center;">Отделка</th>
            <th class="tcost last-child" style="text-align:center;">Стоимость</th>
            </tr>
        </table>
        </div>
        
        <table style="margin-bottom:0px;" class="p9">
        <tr>
            <th class="tdate"><label class="sort-triger active asc"></a></th>
            <th class="tao" style="width:270px;text-align:center;"><label class="sort-triger"></a></th>
            <th class="tfloor"><label class="sort-triger"></a></th>
            <th class="trooms"><label class="sort-triger"></a></th>
            <th class="tsq"><label class="sort-triger"></a></th>
            <th class="twalls"  style="width:140px;"><label class="sort-triger"></a></th>
            <th class="tcost"><label class="sort-triger"></a></th>
        </tr>
		</table>
		
		<table class="p10" id="last_result" style="padding:0px;">
        </table>
    
    </div>
    <div class="span-6 pt10">
	<h3 class="title"><a href="">Советы эксперта по оценке</a></h3>
    <div class="mb10"><a href="">Незаконная продажа</a><br />
    <a href="">Как защитить недвижимость</a><br />
    <a href="">Принятие обеспечительных мер</a>
    </div>
    <a class="bluebutton large dblock">ЗАКАЗАТЬ ОЦЕНКУ</a>
    
    <h3 class="title"><a href="">Советы эксперта по недвижимости</a></h3>
    <div class="mb10"><a href="">Незаконная продажа</a><br />
    <a href="">Как защитить недвижимость</a><br />
    <a href="">Принятие обеспечительных мер</a>
    </div>
    
    <a href="purchase" rel="700" class="bluebutton large dblock showmodal getform">КУПИТЬ / ПРОДАТЬ<br />КВАРТИРУ</a>
    
    <h3 class="title"><a href="#">Советы эксперта по страхованию</a></h3>
    <div class="mb10"><a href="">Незаконная продажа</a><br />
    <a href="">Как защитить недвижимость</a><br />
    <a href="">Принятие обеспечительных мер</a>
    </div>
    
    <a class="bluebutton large dblock">ЗАСТРАХОВАТЬ</a>
    
	<h3 class="title"><a href="#">Советы эксперта по ипотеке</a></h3>
    <div class="mb10"><a href="">Незаконная продажа</a><br />
    <a href="">Как защитить недвижимость</a><br />
    <a href="">Принятие обеспечительных мер</a>
    </div>
	
    <a class="bluebutton large dblock">ОФОРМИТЬ ИПОТЕКУ</a>
    
    
    </div>
    <div class="clear"></div>
    
    
</div>
		<script>		
		
/*$(document).ready(function() {
	$(".various").fancybox({
		//maxWidth	: 100,
		//maxHeight	: 100,
		fitToView	: false,
		width		: '10px',
		height		: '10px',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
});	*/

/*$(".chzn-container").live("click",function(){
var sort_value = $(this).children().children().html();
$(this).children().children(".wtf").css("color", "blue");
alert(sort_value);
});*/		
		
$("#check_submit").live("click",function(){//прицениться
var row = 'date_of_pub';
var url = '/search/sortit';
var title = $(".p9 .tdate label").attr("class");
var class_arr = title.split(" ");
var c_h = $("#check_cost").val();
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .tdate label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd,check_cost:c_h}, function(result){  
		var options = '';   
		var text_enter ="<tr><td>asdasd</td></tr>";
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});		
		
$("#check_cost_button").click(function() {//старье, убрать надо
var cost = $('#cost').val();
        var url = '/search';
        $.post(url,"check_cost="+cost, function(result){  
              var options = '';   
			  var text_enter = "<table border=1><tr><th>Административный округ /<br />микрорайон</th>            <th>Этаж /<br />Этажность</th>            <th>Кол-во<br />комнат</th>            <th>Общая<br />площадь</th>            <th>Констр.<br />решение</th>            <th>Примерная<br />стоимость, руб.</th>    </tr><tr><td>"+result.street+"</td><td>"+result.floor+"</td><td>"+result.count_room+"</td><td>"+result.area+"</td><td>"+result.repair+"</td><td>"+result.cost+"</td><tr></table>";
              $('#test').html(text_enter);
			  $('.fancybox-opened').css('left','141px');
        },"json"); 
		
});

function repaint(){
var arr = [".tdate",".tao",".tfloor",".trooms",".tsq",".twalls",".tcost"];
$.each(arr,function(){
$(".p9 "+this+" label").attr("class","sort-triger desc");
});
//

};



$(document).ready(function () {//загружаем последние результаты
var row = 'date_of_pub';
var url = '/search/sortit';
var title = $(".p9 .tdate label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[2]="desc";
$(".p9 .tdate label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type); 
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json");
});

/*фильтрация*/
$("#last_result .tao").live("click",function() {	
var url = '/search/sortit';
var s_f = 'microregion_sity_id';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);	
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});		
	},"json"); 
});

$("#last_result .tdate").live("click",function() {	
var url = '/search/sortit';
var s_f = 'date_of_pub';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);    
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});

$("#last_result .tcost").live("click",function() {	
var url = '/search/sortit';
var s_f = 'cost';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);    
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});

$("#last_result .tfloor").live("click",function() {	
var url = '/search/sortit';
var s_f = 'floor_of_house_id';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);    
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});

$("#last_result .trooms").live("click",function() {	
var url = '/search/sortit';
var s_f = 'count_room_id';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});

$("#last_result .tsq").live("click",function() {	
var url = '/search/sortit';
var s_f = 'area';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});

$("#last_result .twalls").live("click",function() {	
var url = '/search/sortit';
var s_f = 'type_indor_id';
var sort_value = $(this).children().html();
$.post(url,{sort_value:sort_value,sort_field:s_f}, function(result){  
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
});
/*фильтрация*/



/*сортировка*/
$(".p9 .tdate").click(function() {
var row = 'date_of_pub';
var url = '/search/sortit';
var title = $(".p9 .tdate label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .tdate label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		var text_enter ="<tr><td>asdasd</td></tr>";
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});

$(".p9 .tao").click(function() {
var row = 'microregion_sity_id';
var url = '/search/sortit';
var title = $(".p9 .tao label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .tao label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});

$(".p9 .tfloor").click(function() {
var row = 'floor_of_house_id';
var url = '/search/sortit';
var title = $(".p9 .tfloor label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .tfloor label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});

$(".p9 .trooms").click(function() {
var row = 'count_room_id';
var url = '/search/sortit';
var title = $(".p9 .trooms label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .trooms label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});

$(".p9 .tsq").click(function() {
var row = 'area';
var url = '/search/sortit';
var title = $(".p9 .tsq label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .tsq label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});

$(".p9 .twalls").click(function() {
var row = 'type_indor_id';
var url = '/search/sortit';
var title = $(".p9 .twalls label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .twalls label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});

$(".p9 .tcost").click(function() {
var row = 'cost';
var url = '/search/sortit';
var title = $(".p9 .tcost label").attr("class");
var class_arr = title.split(" ");
if(class_arr[2]=="desc")
{
sort_asd="asc";
class_arr[2]="asc";
}
else
{
sort_asd="desc";
class_arr[2]="desc";
}
class_arr[1]="active";
repaint();
$(".p9 .tcost label").attr("class",class_arr[0]+" "+class_arr[1]+" "+class_arr[2]);
$.post(url,{sort_row:row,sort_type:sort_asd}, function(result){  
		var options = '';   
		$('#last_result').html(result.type);
		$('#coda-slider-1').codaSlider({
			dynamicArrows: false
		});
	},"json"); 
		
});
/*сортировка*/
</script>