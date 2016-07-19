jQuery(function ($){


	var html = $("html");
	var buton_left = $("#cbp-spmenu-btn-left");
	var buton_right = $("#cbp-spmenu-btn-right");


	var pushBlock = $(".cbp-spmenu-push");
	var menu_left = $(".cbp-spmenu-left");
	var menu_right = $(".cbp-spmenu-right")
	
	


	//quito los anteriores eventos que pudiera haber
    buton_left.unbind('mousedown');
    buton_right.unbind('mousedown');
    pushBlock.unbind('mousedown');
    //$(".cbp-spmenu-push").hammer().off('touch');


	;


    //left panel
    buton_left.bind('mousedown', function(e){
        
        //e.preventDefault();
        e.stopPropagation();

		
        if(!menu_left.hasClass("cbp-spmenu-open")){
        
        	html.addClass("cbp-sp-open");

            menu_left.addClass("cbp-spmenu-open");
            pushBlock.addClass("cbp-spmenu-push-toright");

         }else{
         
         	html.removeClass("cbp-sp-open");

            menu_left.removeClass("cbp-spmenu-open");
            pushBlock.removeClass("cbp-spmenu-push-toright");
        }
        
        console.log("left event");
        
    });

    //right panel
    buton_right.bind('mousedown', function(e){

        //e.preventDefault();
        e.stopPropagation();
        

        
        if(!menu_right.hasClass("cbp-spmenu-open")){
        
        	html.addClass("cbp-sp-open");

            menu_right.addClass("cbp-spmenu-open");
            $(".cbp-spmenu-push").addClass("cbp-spmenu-push-toleft");

        }else{
			
			html.removeClass("cbp-sp-open");
			
            menu_right.removeClass("cbp-spmenu-open");
            pushBlock.removeClass("cbp-spmenu-push-toleft");
        }
        
        console.log("right event");
        
    });


    
    //main panel (deshace todo - volver al status al hacer click en un main)
    //touch version (previene que se haga scroll horizontal)
    /*$(".cbp-spmenu-push").hammer().on("touch", function(e) {

		//e.preventDefault();
		
        $(".cbp-spmenu-left").removeClass("cbp-spmenu-open");
        $(".cbp-spmenu-push").removeClass("cbp-spmenu-push-toright");
        $(".cbp-spmenu-right").removeClass("cbp-spmenu-open");
        $(".cbp-spmenu-push").removeClass("cbp-spmenu-push-toleft");
    });*/

    //mouse version
    pushBlock.bind('mousedown', function(e){
    
    	
    	html.removeClass("cbp-sp-open");
    
    	//e.preventDefault();
        menu_right.removeClass("cbp-spmenu-open");
        menu_left.removeClass("cbp-spmenu-open");
        pushBlock.removeClass("cbp-spmenu-push-toleft");
        pushBlock.removeClass("cbp-spmenu-push-toright");

    });



    

    /*
    $(".cbp-spmenu-push")[0].addEventListener('touchstart', function(e) {

        $(".cbp-spmenu-right").removeClass("cbp-spmenu-open");
        $(".cbp-spmenu-push").removeClass("cbp-spmenu-push-toleft");
        $(".cbp-spmenu-left").removeClass("cbp-spmenu-open");
        $(".cbp-spmenu-push").removeClass("cbp-spmenu-push-toright");

    }, false);
    */
    
    //cierro si venía de un link
    $('a[href*="#"]:not([href="#"])').click(function() {
    
    	html.removeClass("cbp-sp-open");
    
    	//e.preventDefault();
        menu_right.removeClass("cbp-spmenu-open");
        menu_left.removeClass("cbp-spmenu-open");
        pushBlock.removeClass("cbp-spmenu-push-toleft");
        pushBlock.removeClass("cbp-spmenu-push-toright");
    });



    //control de la altura de los contenedores
    $(window).bind('resize', function(){

		menu_left.height($(this).height());
		menu_right.height($(this).height());
       // $(".cbp-spmenu-left, .cbp-spmenu-right").height($(this).height());

    });

    $(window).trigger('resize');
    
});