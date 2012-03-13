$(document).ready(function(){
    var show_cities = false;    
    var OrganisatorsArray = '-';
    $('.item-list li, .multy-list li').hover(function(){
        $(this).addClass('hover');
    });
    $('.item-list li, .multy-list li').mouseout(function(){
        $(this).removeClass('hover');
    });
    
    $('.item-list li').live('click',function(){
        $(this).parent().children('li').each(function(){
            $(this).removeClass('curent');
        });
        $(this).addClass('curent');
    });
    
    $('.multy-list li').live('click',function(){
        $(this).toggleClass('curent');
        
    });
    
 
    
    // аяксим список дочерних городов в блок
    $('#EventRegionList li').live('click',function(){
        if (show_cities == false) {
            $('#children_cities').fadeIn('medium');
            show_cities = true;
        }
        var pid = $(this).children('i').html();
        if (pid == '') {
            return (false);
        } else {       
        $('#EventCityList li').fadeOut('medium');
        $('#EventCityList').html('<li class="empty">В этом регионе пока нет городов</li>');
        var url = '/cms/get_cities_buy/';
        $.post(url,"parent_region_id="+pid, function(result){
            if (result.type == 'error'){
                return(false);
            }
            else
            {
              var cities = '';
              $(result.cities).each(function(){
                    cities += '<li>'+$(this).attr('name')+'<i>'+$(this).attr('id')+'</i></li>';
              });   
              $('#EventCityList li.empty').fadeOut('fast');
              $('#EventCityList').html(cities);
            }
        },"json"); 
        $('#pid').val(pid); // назначаем pid для формы добавления нового города        
        }       
        
        
    });
        // добавляем новый регион
        $('#addRegionSubmit').live('click',function(){
        var region_name = $('#addRegionValue').val();
        if (region_name == '') {
            return (false);
        }        
        $('#EventRegionList li').fadeOut('medium');
        $('#EventRegionList').html('<li class="empty">Обновляем список ...</li>');
        var url = '/cms/add_x_region_buy/';
        
        $.post(url,"region_name="+region_name, function(result){
            if (result.type == 'error'){
                return(false);
            }
            else
            {
                
              var options = '';
              $(result.regions).each(function(){
                    options += '<li>' + $(this).attr('name')+ '<i>'+$(this).attr('id')+'</i></li>';
              });   
              $('#EventRegionList li.empty').fadeOut('fast');
              $('#EventRegionList').html(options);
              $('#addRegionValue').attr('value','');
                
            }
        },"json"); 
    });
    
    // добавляем новый город в выбранный регион
    $('#addCitySubmit').click(function(){
        var city_name = $('#addCityValue').val();
        var parid = $('#pid').val();
        if (city_name == '') {
            return (false);
        }        
        $('#EventCityList li').fadeOut('fast');
        $('#EventCityList').html('<li class="empty">Обновляем список ...</li>');
        var url = '/cms/add_x_city_buy/';
        
        $.post(url,{city_name:city_name,pid : parid}, function(result){
            if (result.type == 'error'){
                return(false);
            }
            else
            {
                
              var options = '';
              $(result.cities).each(function(){
                    options += '<li>' + $(this).attr('name')+ '<i>'+$(this).attr('id')+'</i></li>';
              });   
              $('#EventCityList li.empty').fadeOut('fast');
              $('#EventCityList').html(options);
              $('#addCityValue').attr('value','');
                
            }
        },"json"); 
    });
    
    
    // добавляем новый тип
        $('#addTypeSubmit').live('click',function(){
        var type_name = $('#addTypeValue').val();
        if (type_name == '') {
            return (false);
        }        
        $('#EventTypeList li').fadeOut('medium');
        $('#EventTypeList').html('<li class="empty">Обновляем список ...</li>');
        var url = '/cms/add_x_type_buy/';
        
        $.post(url,"type_name="+type_name, function(result){
            if (result.type == 'error'){
                return(false);
            }
            else
            {
                
              var options = '';
              $(result.types).each(function(){
                    options += '<li>' + $(this).attr('name')+ '<i>'+$(this).attr('id')+'</i></li>';
              });   
              $('#EventTypeList li.empty').fadeOut('fast');
              $('#EventTypeList').html(options);
              $('#addTypeValue').attr('value','');
                
            }
        },"json"); 
    });
    
    
    // добавляем нового организатора
        $('#addOrganisatorSubmit').live('click',function(){
        var org_name = $('#addOrganisatorValue').val();
        if (org_name == '') {
            return (false);
        }        
        $('#EventOrganisatorList li').fadeOut('medium');
        $('#EventOrganisatorList').html('<li class="empty">Обновляем список ...</li>');
        var url = '/cms/add_x_org_buy/';
        
        $.post(url,"org_name="+org_name, function(result){
            if (result.type == 'error'){
                return(false);
            }
            else
            {
                
              var options = '';
              $(result.orgs).each(function(){
                    options += '<li>' + $(this).attr('name')+ '<i>'+$(this).attr('id')+'</i></li>';
              });   
              $('#EventOrganisatorList li.empty').fadeOut('fast');
              $('#EventOrganisatorList').html(options);
              $('#addOrganisatorValue').attr('value','');
                
            }
        },"json"); 
    });
    

// добавление новоe событиe
$('#event_add').click(function(){
        var is_errors = false;
        var errors = '';
        
        var  event_name     = $('#event_name').val();
        var  event_key      = $('#event_key').val();
        var  event_desc     = $('#event_desc').val();
        tinyMCE.triggerSave(); // записывает в textarea значение из tinyMCE.
        var event_date      = $('#date_y').val();
        var event_time      = $('#date_h').val();
        var event_excerpt   = $('#event_excerpt').val();
        var event_text      = $('#event_text').val();
        var event_img       = $('#x_imgname').val();
        var event_region    = $('#EventRegionList li.curent i').html();
        var event_city      = $('#EventCityList li.curent i').html();
        var event_location  = '-'+event_region+'--'+event_city+'-';
        var event_type      = '-'+$('#EventTypeList li.curent i').html()+'-';
        
        OrganisatorsArray = '-';
        $('.multy-list li.curent i').each(function(){
            OrganisatorsArray += $(this).html()+'-';            // формируем масив id-ов организаторов
        });
        
        var event_organiosators = OrganisatorsArray;
        
        if (event_name == ''){errors+='<div class="error">Не указано название материала</div><br />';is_errors=true}
        if (event_type == '' || event_type == '-' || event_type == '--'){errors+='<div class="error">Не указана рубрика</div><br />';is_errors=true}
        if (event_organiosators == '-'){errors+='<div class="error">Не указаны категории</div><br />';is_errors=true}
        if (is_errors != false) {$('#errors').html(errors); return false} else {$('#errors').html('');
        
        
        var url = '/cms/add_x_event_buy/';
        $.post(url,{
        name:event_name,date:event_date,time:event_time,img:event_img,desc:event_desc,key:event_key,excerpt:event_excerpt,
        text:event_text,type:event_type,org:event_organiosators,region:event_location
        }, function(result){
            if (result.type == 'error'){
                
                return(false);
            }
            else
            {
                var success_msg = '<div class="success" style="padding:10px;">материал успешно добавлен</div>';
                var redirect_msg = '<div class="empty"  style="padding:10px; text-align:left;">Возвращаемся в список...</div>';
                    $('#adding_form').slideUp('fast', function(){
                            $('#success_message').html(success_msg);
                            $('#success_message').fadeIn('fast').delay(700).fadeOut('fast',function(){
                                $('#success_message').html(redirect_msg).fadeIn('fast').delay(700).fadeOut('fast',function(){
                                   $(window.location).attr('href','/cms/extra_events_buy/');    
                                });    
                            });
                          
                          });
   
              
              
            }
        },"json"); 
        
        
        
        }
    });

// обновление события
$('#event_update').click(function(){
        var is_errors = false;
        var errors = '';
        
        var  event_id     = $('#event_id').val();
        var  event_name     = $('#event_name').val();
        var  event_key      = $('#event_key').val();
        var  event_desc     = $('#event_desc').val();
        tinyMCE.triggerSave(); // записывает в textarea значение из tinyMCE.
        var event_date      = $('#date_y').val();
        var event_time      = $('#date_h').val();
        var event_excerpt   = $('#event_excerpt').val();
        var event_text      = $('#event_text').val();
        var event_img       = $('#x_imgname').val();
        var event_region    = $('#EventRegionList li.curent i').html();
        var event_city      = $('#EventCityList li.curent i').html();
        var event_location  = '-'+event_region+'--'+event_city+'-';
        var event_type      = '-'+$('#EventTypeList li.curent i').html()+'-';
        
        OrganisatorsArray   = '-';
        $('.multy-list li.curent i').each(function(){
            OrganisatorsArray += $(this).html()+'-';            // формируем масив id-ов организаторов
        });
        
        var event_organiosators = OrganisatorsArray;
        
        if (event_name == ''){errors+='<div class="error">Не указано название мематериала</div><br />';is_errors=true}
        if (event_type == '' || event_type == '-' || event_type == '--'){errors+='<div class="error">Не указана рубрика</div><br />';is_errors=true}
        if (event_organiosators == '-'){errors+='<div class="error">Не указана категория</div><br />';is_errors=true}
        if (is_errors != false) {$('#errors').html(errors); return false} else {$('#errors').html('');
        
        
        var url = '/cms/update_x_event_buy/';
        $.post(url,{
        id:event_id,name:event_name,date:event_date,time:event_time,img:event_img,desc:event_desc,key:event_key,excerpt:event_excerpt,
        text:event_text,type:event_type,org:event_organiosators,region:event_location
        }, function(result){
            if (result.type == 'error'){
                
                return(false);
            }
            else
            {
                var success_msg = '<div id="success" class="success" style="padding:10px; display:none;">материал успешно обновлен</div>';
                
                $('#event_update').after(success_msg);
                $('#success').fadeIn('fast').delay(700).fadeOut('fast',function(){
                    $(this).detach();
                });
                
                
              
              
            }
        },"json"); 
        
        
        
        }
    });

  
  
    
    
    
    
});