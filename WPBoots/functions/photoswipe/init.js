jQuery(function ($) {

		$(document).ready(function() {
		
			$('body').append('<!-- Root element of PhotoSwipe. Must have class pswp. --><div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">       <div class="pswp__bg"></div>    <!-- Slides wrapper with overflow:hidden. -->    <div class="pswp__scroll-wrap">             <div class="pswp__container">            <div class="pswp__item"></div>            <div class="pswp__item"></div>            <div class="pswp__item"></div>        </div>        <div class="pswp__ui pswp__ui--hidden"><div class="pswp__top-bar">                <div class="pswp__counter"></div>                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>                <button class="pswp__button pswp__button--share" title="Share"></button>                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>                <div class="pswp__preloader">                    <div class="pswp__preloader__icn">                      <div class="pswp__preloader__cut">                        <div class="pswp__preloader__donut"></div>                      </div>                    </div>                </div>            </div>            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">                <div class="pswp__share-tooltip"></div>             </div>            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">            </button>            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">            </button>            <div class="pswp__caption">                <div class="pswp__caption__center"></div>            </div>        </div></div></div>');
			

			var openPhotoSwipe = function(elm) {
			
				//console.log('openPhotoSwipe();')
			
			    var pswpElement = document.querySelectorAll('.pswp')[0];
			
			    // build items array
			    
			    var galleryName = $(elm).data('fancybox-group');
				var galleryItems = $('[data-fancybox-group="'+galleryName+'"]');
			    var items = [];
			    var index = galleryItems.index(elm);
			    
			    galleryItems.each(function(){
				    
				    items.push({
			            src: $(this).attr('href'),
			            w: $(this).data('img-width'),
			            h: $(this).data('img-height')
					});
			    });
			    
			    // define options (if needed)
			    var options = {
			             // history & focus options are disabled on CodePen        
			        history: false,
			        focus: false,
			
			        showAnimationDuration: 0,
			        hideAnimationDuration: 0,
			        index: index
			        
			    };
			    
			    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
			    
			    gallery.init();
			};
			
			
			$('.fancybox').click(function(e){
			
				e.preventDefault();
				
				openPhotoSwipe(this);
				
			});
			
		});
});