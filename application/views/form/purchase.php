<div class="p20">
<form action="/" method="post">
    <h2>Оформление заявки</h2>
    
    <div class="row">
        <div class="span-3 right">
            <label for="appname">Тип сделки:</label>
        </div>
        <div class="span-5">
            <select class="chzn-select" style="width: 180px;">
                <option value="1" selected="selected">Покупка</option>
                <option value="1">Продажа</option>
            </select>
        </div>
    
        <div class="span-2 right">
            <label for="appname">Объект:</label>
        </div>
        <div class="span-6">    
            <select class="chzn-select" style="width: 220px;">
                <option value="17">Квартира</option>
                <option value="18">Квартира в новостройке</option>
                <option value="26">Kомната</option>
                <option value="27">Офис, магазин, склад</option>
                <option value="28">Дом, коттедж, участок</option>
                <option value="29">Другое</option>
            </select>
        </div>
        <div class="clear"></div>
    </div>
        
            <div class="span-3 right pt10">
                <label for="appname">Имя:</label>
            </div>
            <input name="appname" type="text"  class="span-13 last text" />
        <div class="clear"></div>
        
        <div class="span-8">
            <div class="span-3 right pt10">
                <label for="appmail">E-mail:</label>
            </div>
            <input name="appmail" type="text"  class="span-5 text" />
            <div class="clear"></div>
         </div>
        
        <div class="span-2 right pt10">
            <label for="appphone">Телефон:</label>
        </div>
        <input name="appphone" type="text"  class="span-6 text" />
        <div class="clear"></div>
        <div class="span-3 right pt10">
            <label for="appinfo">Дополнительная информация:</label>
        </div>
        <textarea class="round-3" name="appinfo" style="height: 100px; width: 488px; float: left;"></textarea>
        <div class="clear"></div>
		<div class="prepend-3 span-14">
        <div class="span-3">
            <a href="http://advecs-tmn.ru/" target="_blank"><img src="<?=base_url()?>images/adveks_logo.gif"/></a>
        </div>
        <div class="span-11 last">
            Ваша заявка будет отправлена <br>в <a href="http://advecs-tmn.ru/" target="_blank">Агенство недвижимости "Адвекс"</a>
        </div>
        <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="prepend-3 span-13"><input type="submit" class="orangebutton strong span-13" value="Отправить заявку" /></div>
</form>        
</div>    
<script type="text/javascript">
$(".chzn-select").chosen();
</script>
