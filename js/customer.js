$(document).ready( function() {
    var modalBlock = $('#modal');
    $('.blockOverlay').live('click', $.unblockUI); 
    
    function getForm(obj){
        modalBlock.html("");
        var frm = false;
        if (obj.attr('href')){frm = obj.attr('href');} else {
            if (obj.attr('action')) {frm = obj.attr('action');}
        }
        $.post('/getform/',{form:frm}, function(result){
                modalBlock.html(result);
        },'json');
    }
    
    function showModal(mwidth){
        var modwidth = 800;
        if (mwidth){modwidth=parseInt(mwidth);}
        var leftpos = ( $(window).width()/2 - modwidth/2 ) + 'px';
        $.blockUI({ 
            message: modalBlock,
            css: { cursor: 'default', top: '50px', left: leftpos, width: modwidth+'px'},
            overlayCSS: { backgroundColor: '#000',cursor:'default'}
        });
    }
    
    $(".getform").live('click', function(event){ 
        event.preventDefault();
        getForm($(this)); 
    });
    $(".showmodal").live('click', function(event){ 
        event.preventDefault(); 
        showModal($(this).attr('rel')); 
        });

    $('#modal form').live('submit', function(event){
        event.preventDefault();
        var url     = $(this).attr('action');
        var data    = $(this).serializeArray();
        $.post(url,fields,function(result){
            if(result.status=='success'){} else {}
        },'json');
    });

    $(".chzn-select").chosen();
    $('.tipsy').tipsy({ title: 'title', gravity: $.fn.tipsy.autoNS, fade: false });    
});

$(function() {
	$('#foo4').carouFredSel({
		responsive: true,  width: '100%',
		items: { width: 200,/*height: '30%',*/ visible: { min: 4, max: 4 } },
		scroll : { items : 4, easing : "easeInOutCirc", duration : 1000, pauseOnHover : true }
	});
});