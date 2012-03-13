<div class="fullfit">     
    <div class="container">
    <div class="span-24 pt10">
    <div class="span-6"><h2 class="pagetitle objects">Мои объекты</h2></div>
    <div class="span-16"><h2 id="newobjtitle"><a id="newobjtrigger" href="#">Добавить объект</a></h2></div><div class="clear"></div>
    </div>
    
    </div>
</div>  
<script type="text/javascript">
$(document).ready(function(){
    var notriggerelem   = '<a id="newobjtrigger" href="#">Добавить объект</a>',
        notrigger       = $('#newobjtrigger'),
        notitle         = $('#newobjtitle'),
        notitletext     = 'Добавление нового объекта',
        nocancel        = $('#nocancel'),
        calc            = $('#cabinetcalc');
        
    notrigger.live('click',function(event){ 
        event.preventDefault(); 
        notitle.hide().html(notitletext).fadeIn('fast'); 
        calc.slideDown('fast');
        $('#objname').focus();
    });
    nocancel.live('click',function(event){
        event.preventDefault();
        notitle.hide().html(notriggerelem).fadeIn('fast');
        calc.slideUp('fast');
    });
    
    $('.separator').hover(function(){
        $(this).find('div.objactions').addClass('active');
    },function(){
        $(this).find('div.objactions').removeClass('active');
    });
});
</script>      
<div class="fullfit" id="cabinetcalc">     
    <div class="container">
    <div class="span-24">
        <form id="mycalcform" method="post" action="/my/addobject/">    
        <div class="row">
            <div class="span-6 right pt10"><label for="objname">Название объекта</label></div>
            <input type="text" name="objname" id="objname" class="text span-18" />
            <div class="clear"></div>
        </div>
        
        <div class="row">
            <div class="span-12">
                <div class="span-6 right"><label for="city">Город</label></div>
                <select name="city" class="chzn-select" style="width: 220px; float: left;">
        			<option selected="selected" disabled="disabled">Тюмень</option>
        		</select>
            </div>
            <div class="span-12 last">
                <div class="span-6 right"><label>Улица</label></div>
                <div class="floatLeft">
                    <select name="district" class="chzn-select" style="width:220px;">
            			<option value=""></option>
            		</select>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        
        <div class="row">
            <div class="span-12">
                <div class="span-6 right"><label for="district">Район города</label></div>
                <select name="district" style="width: 220px; float: left;" class="chzn-select">
        			<option value=""></option>
        			<?foreach($microregion_sity as $ms):?>
				    <option value="<?=$ms['id']?>"><?=$ms['caption']?></option>
				    <?endforeach;?>
        		</select>
            </div>
            <div class="span-12 last">
                <div class="span-6 right"><label for="segm">Сегмент рынка</label></div>
                <select name="segm" class="chzn-select" style="width:220px; float: left;">
        			<option></option>
        			<option value="1">Первичный</option>
                    <option value="2">Вторичный</option>
        		</select>
            </div>
            <div class="clear"></div>
        </div>

        <div class="row">
            <div class="span-8">
                <div class="span-6 right pt10"><label>Площадь квартиры, м<sup>2</sup></label></div>
                <input type="text" class="text span-2 center" />
                <div class="clear"></div>
            </div>
            <div class="span-6">
                <div class="span-4 right pt10"><label>Этажность дома</label></div>
                <input type="text" class="text span-2 center" />
                <div class="clear"></div>
            </div>
                <div class="span-4 right"><label>Серия</label></div>
                <select class="chzn-select" style="width:220px; float: left;">
        			<option value="" selected="selected">Выберите из списка</option>
        			<option value="">------------------</option>
                    <option value="">------------------</option>
        			<option value="">------------------</option>
        		</select>
            <div class="clear"></div>
        </div>
        
        <div class="row">
            <div class="span-8">
                <div class="span-6 right pt10"><label>Количество комнат</label></div>
                <input type="text" class="text span-2 center" />
                <div class="clear"></div>
            </div>
            <div class="span-6">
                <div class="span-4 right pt10"><label>Этаж квартиры</label></div>
                <input type="text" class="text span-2 center" />
                <div class="clear"></div>
            </div>
                <div class="span-4 right pt10"><label>Год постройки</label></div>
                <input type="text" class="text span-2 center" />
            <div class="clear"></div>
        </div>
        
        <div class="row">
            <div class="span-6 right"><label>Конструктивное решение<br /><span class="small-grey">(материал стен)</span></label></div>
            <select class="chzn-select" style="width: 300px; float: left;">
    			<option value="" selected="selected">Выберите из списка</option>
    			<option value="">------------------</option>
                <option value="">------------------</option>
    			<option value="">------------------</option>
    		</select>
            <div class="clear"></div>
        </div>
        
        <div class="row">            
            <div class="span-6 right"><label>Тип и состояние<br />внутренней отделки</label></div>
            <select class="chzn-select" style="width: 300px; float: left;">
    			<option value="" selected="selected">Выберите из списка</option>
    			<option value="">------------------</option>
                <option value="">------------------</option>
    			<option value="">------------------</option>
    		</select>
            <div class="clear"></div>
        </div>
        <script type="text/javascript">
         $(".chzn-select").trigger("liszt:updated");
        </script>
        
        <div class="row">
            <div class="prepend-6 span-7">
                <input type="submit" class="orangebutton large p1020i" value="Добавить объект" />
            </div>
            <div class="span-7"><h2 class="pt10"><a id="nocancel" href="#">Отмена</a></h2></div>
        </div>
        
      </form>
        
    </div>
    </div>
</div>