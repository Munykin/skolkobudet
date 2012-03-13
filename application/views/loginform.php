<script type="text/javascript">
$('form#loginform').live('submit', function(event){
    event.preventDefault();     
    var url = $(this).attr('action'); var fields = $(this).serializeArray();
      $.post(url,fields,function(result){
        if(result.status=='success'){ $(window.location).attr('href','/objects/'); }else{ $.jGrowl(result.error_text); }
      },"json");
});
</script>
<form id="loginform" action="/auth/" method="post">
    <div class="span-3 right pt10"><label for="user">Логин</label></div>
    <input type="text" name="user" id="user" class="text span-4 last" />
    <div class="clear"></div>    
    <div class="span-3 right pt10"><label for="pass">Пароль</label></div>
    <input type="password" name="pass" id="pass" class="text span-4 last" />
    <div class="clear"></div>
    <div class="span-3 right pt10"><a id="kp" href="<?=base_url()?>forgotmypass/">Забыли пароль?</a></div>
    <input type="submit" id="loginsubmit" class="span-4 last orangebutton bold" value="Войти" />
    </div>
</form>