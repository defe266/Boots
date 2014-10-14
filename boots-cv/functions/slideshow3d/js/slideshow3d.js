
var slideshow3d;


jQuery(function($){

	
	
	
	
	slideshow3d = function slideshow3d(selector){
	
		var self = this;
		
		this.index = 0;
		this.el = $(selector);
		this.body = $('body');
		this.scroller = this.el.find('.slideshow3d-container')
		this.el.addClass('slideshow3d');
		this.items = this.el.find('li');
		this.length = this.items.length;
		
		this.transformZ = 300;
		
		this.transformPrefixed = Modernizr.prefixed('transform').replace(/([A-Z])/g, function(str,m1){ return '-' + m1.toLowerCase(); }).replace(/^webkit-/,'-webkit-').replace(/^moz-/,'-moz-').replace(/^ms-/,'-ms-').replace(/^o-/,'-o-');//Modernizr.prefixed("transform");
		
		this.transformRulePrevOut = "";
		this.transformRuleNextOut = "";
		this.transformRulePrev = "";
		this.transformRuleNext = "";
		
		
		//detectar soporte de transform -> usar left right en su lugar
		
		//reajustar transforms segun pantalla
		
		//iniciar desde una pos
		
		
		this.show = function(){
		
		
			this.body.addClass('modal-open');
			
			this.el.css('display','block');	
			
			setTimeout(function(){
			
				self.el.addClass('open');
				
			},10);
			
		};
		
		this.hide = function(){
		
			this.body.removeClass('modal-open');
		
			this.el.removeClass('open');
			
			setTimeout(function(){
			
				self.el.css('display','none');
				
			},500);
		};
		
		this.calculateBounds = function(){
			
			var ww = $(window).width();

			
			if( this.items.length > 0 ){
				
				var iw = this.items.eq(0).outerWidth();
			}
			
			
			this.bounds = {
				
				"2d" : {
					
					inside: 	Math.round( (iw + (ww - iw)/4) ),
					outside: 	Math.round( (iw + (ww - iw)) )
				},
				
				"3d" : {
					
					inside: 	Math.round( (iw + (ww - iw)/4) * 1.17 ), //1.09
					outside: 	Math.round( (iw + (ww - iw)) * 1.17 ) //1.09
				}
			};
			
			
			
			if(Modernizr.csstransforms3d){
			
				/*
				transformRulePrev = transformPrefixed + ": translate3d(-"+this.bounds['3d'].inside+"px, 0px, -150px);";
				transformRulePrev = '#projectOverlay-container ul li.prev {' + transformRulePrev + '}';
				
				transformRuleNext = transformPrefixed + ": translate3d("+this.bounds['3d'].inside+"px, 0px, -150px);";
				transformRuleNext = '#projectOverlay-container ul li.next {' + transformRuleNext + '}';
				
				transformRulePrevOut = transformPrefixed + ": translate3d(-"+this.bounds['3d'].outside+"px, 0px, -150px);";
				transformRulePrevOut = '#projectOverlay-container ul li.prev {' + transformRulePrevOut + '}';
				
				transformRuleNextOut = transformPrefixed + ": translate3d("+this.bounds['3d'].outside+"px, 0px, -150px);";
				transformRuleNextOut = '#projectOverlay-container ul li.next {' + transformRuleNextOut + '}';
				*/
				

				
				this.transformRuleOpen = "translate3d(0px, 0px, 0px)";
				
				this.transformRulePrev = "translate3d(-"+this.bounds['3d'].inside+"px, 0px, -"+this.transformZ+"px)";
				
				this.transformRulePrev = "translate3d(-"+this.bounds['3d'].inside+"px, 0px, -"+this.transformZ+"px)";
				this.transformRuleNext = "translate3d("+this.bounds['3d'].inside+"px, 0px, -"+this.transformZ+"px)";

				this.transformRulePrevOut = "translate3d(-"+this.bounds['3d'].outside+"px, 0px, -"+this.transformZ+"px)";
				this.transformRuleNextOut = "translate3d("+this.bounds['3d'].outside+"px, 0px, -"+this.transformZ+"px)";
				
			}else{
			
				if(Modernizr.csstransitions){
				/*
					transformRulePrev = transformPrefixed + ": translate(-"+this.bounds['2d'].inside+"px, 0px);";
					transformRulePrev = '#projectOverlay-container ul li.prev {' + transformRulePrev + '}';
					
					transformRuleNext = transformPrefixed + ": translate("+this.bounds['2d'].inside+"px, 0px);";
					transformRuleNext = '#projectOverlay-container ul li.next {' + transformRuleNext + '}';
					
					transformRulePrevOut = transformPrefixed + ": translate(-"+this.bounds['2d'].outside+"px, 0px);";
					transformRulePrevOut = '#projectOverlay-container ul li.prev {' + transformRulePrevOut + '}';
					
					transformRuleNextOut = transformPrefixed + ": translate("+this.bounds['2d'].outside+"px, 0px);";
					transformRuleNextOut = '#projectOverlay-container ul li.next {' + transformRuleNextOut + '}';
					*/
					
					/*
					transformRulePrev = transformPrefixed + ": translate(-"+this.bounds['2d'].outside+"px, 0px);";
					transformRulePrev = '#projectOverlay-container ul li.prev {' + transformRulePrev + '}';
					
					transformRuleNext = transformPrefixed + ": translate("+this.bounds['2d'].outside+"px, 0px);";
					transformRuleNext = '#projectOverlay-container ul li.next {' + transformRuleNext + '}';
					
					*/
				}
			}
			
			/*
			
			var my_html =  '<style type="text/css">';
				my_html += 			transformRulePrevOut
				my_html += 			transformRuleNextOut
				my_html += 			transformRulePrev
				my_html += 			transformRuleNext
				my_html += '</style>';
			
			
			$('body').prepend(my_html);
			
			*/
			
			
			this.scroller.scrollTop(0);
				  
		};
		
		this.refreshBound = function(){
			
			
			this.calculateBounds();
			//this.gotoPos(this.index);
			
		};
		
		this.gotoPos = function(pos){
		
			this.index = pos;
		
			//var elms = this.el.find('li'); //.projectOverlay-item-container
			
			var elms = this.items;
			
			
			
			elms.each(function(index){
			
				if(index != pos)
					//$(this).find('.hidden-elm').slideUp(400);
					$(this).find('.hidden-elm').hide();
			});		
			
			
			setTimeout(function(){
			
				//elms.eq(pos).find('.lazy-img').imageloader();
				
				
				var hiddenElm = elms.eq(pos).find('.hidden-elm');
				
				hiddenElm.imageloader({
			        selector: '.lazy-img'/*,
			        callback: function (elm) {
			          $(elm).slideDown();
			        }*/
			    });
				
				if( !hiddenElm.is(':visible') )
					//hiddenElm.slideDown(0);//1000
					hiddenElm.show();
			
			
			},200);
			
			
			
			//reiniciamos sus clases
			/*
			elms.each(function(){
			
				$(this).removeClass('show prev next nextOut prevOut open');
			});*/
			
			
			
			if(pos > 0){

				elms.eq(pos - 1).removeClass('show prev next nextOut prevOut open');
				elms.eq(pos - 1).addClass('show prev').css(this.transformPrefixed, this.transformRulePrev);
			}
			

			elms.eq(pos).removeClass('show prev next nextOut prevOut open');
			elms.eq(pos).addClass('show open').css(this.transformPrefixed, this.transformRuleOpen);
			
			

			
			setTimeout(function(){
			
				//elms.eq(pos).css('height','auto');
				
			},0.5);
			
			
			
			if(pos < elms.length - 1){
				
				elms.eq(pos + 1).removeClass('show prev next nextOut prevOut open');
				elms.eq(pos + 1).addClass('show next').css(this.transformPrefixed, this.transformRuleNext);
			}
			
			
			/*
			if(pos-1 > 0){

				elms.eq(pos-2).removeClass('show prev next nextOut prevOut open');
				elms.eq(pos-2).addClass('prevOut').css(this.transformPrefixed, this.transformRulePrevOut);
			}
			
			if(pos+1 < elms.length - 1){
				
				elms.eq(pos+2).removeClass('show prev next nextOut prevOut open');
				elms.eq(pos+2).addClass('nextOut').css(this.transformPrefixed, this.transformRuleNextOut);
			}
			*/
			

			
			
			for(var i = pos-2; i >= 0; i--){
				
				elms.eq(i).removeClass('show prev next nextOut prevOut open');
				elms.eq(i).addClass('prevOut').css(this.transformPrefixed, this.transformRulePrevOut);

			}			
			

				
			for(var i = pos+2; i < elms.length; i++){
				
				elms.eq(i).removeClass('show prev next nextOut prevOut open');
				elms.eq(i).addClass('nextOut').css(this.transformPrefixed, this.transformRuleNextOut);
			}
			
			// Pruebas
			
			
			//elms.eq(pos).css('height','auto');
			
			
			//this.el.find('.hidden-elm').hide();
			
			
			
			/*
			setTimeout(function(){
				
				elms.eq(pos).find('.projectOverlay-item-gal img').fadeIn();
				
				
				elms.eq(pos).animate({
				  height: "auto"
				},200, 'swing', function(){
					
					//self.gotoPos(self.index);
					
				});
				
			},800);*/
			
			// END Pruebas
			
			
		}
		
		this.gotoPosAndShow = function(pos){
		
			this.gotoPos(pos);
			this.show();
		};
		
		
		this.moveLeft= function(){
		
			var self = this;
		
			if(this.index > 0){
			
				this.index--;
			
				
				
				this.scroller.animate({
				  scrollTop: 0
				},50, 'swing', function(){
					
					self.gotoPos(self.index);
					
				});
				
			}		
		}
		
		
		this.moveRight= function(){
		
			
			if(this.index < this.length-1){
			
				this.index++;

				this.scroller.animate({
				  scrollTop: 0
				},50, 'swing', function(){
					
					self.gotoPos(self.index);
					
				});
				
				self.gotoPos(self.index);
	
			}
			
		}
		
		
		
		
		//### Eventos
		
		this.el.find('.outOverlay, .closeBlock').on('click',function(){
		
		    self.hide();
		});
		
		this.el.on('click', '.prev, .moveLeft', function(e) {
			
			self.moveLeft();
		});
		
		this.el.on('click', '.next, .moveRight', function(e) {
		
			self.moveRight();
		});
		
		
		$(document).on('keydown', function(ev){
	 	
			//controlar sólo si se ve!!
		 	var keyCode = ev.keyCode || ev.which;
		 	
		 	
		 	if(keyCode == 27){
		 		
		 		self.hide();
		 	}

		 	if(keyCode == 37){
		 	
		 		self.moveLeft();
		 	}
		 	
		 	
		 	if(keyCode == 39){
		 		
		 		self.moveRight();
		 	}
		 	
		 	
		 	
		 });
		
		
		return this;
	
	}
	
	
	
	
		
	


	
	
});




