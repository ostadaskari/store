(function ($) {
    $.fn.zoomy = function(urls, options) {
        if (!urls) return;
        if (typeof urls === 'string') urls = [urls];
        if (!this.hasClass('zoom')) this.addClass('zoom');

        if (!options) options = {};
        var maxVisibleThumbs = options.maxVisibleThumbs || 4; 
        var isCarouselActive = urls.length > maxVisibleThumbs;
        
        if (urls.length < 2) options.thumbHide = 1;
        if (options.height || options.width) {
            var st = (options.height) ? 'height:' + options.height + 'px;' : '';
            if (options.width) st += 'width:' + options.width + 'px;';
            this.attr('style', st);
        }
        if (options.thumbRight || options.thumbLeft) this.addClass('zoom-right');
        if (options.thumbLeft) this.addClass('zoom-left');

        var thumbMode = (typeof urls[0] === 'string') ? 0 : 1;
        var firstImage = (thumbMode) ? urls[0].image : urls[0];
        
        var h = '<div class="zoom-main"><span class="zoom-mousemove" style="background-image: url(' + firstImage + ')">';
        h += '<img src="' + firstImage + '" /></span></div>';

        if (!options.thumbHide) {
            var thumbClasses = 'zoom-thumb';
            if (isCarouselActive) {
                thumbClasses += ' owl-carousel owl-theme';
            }
            
            h += "<div class='" + thumbClasses + "'>";
            
            $.each(urls, function(i, url) {
                var image = (thumbMode) ? url.image : url;
                var thumb = (thumbMode) ? url.thumb : url;
                
                var itemWrapperStart = isCarouselActive ? "<div class='item'>" : "";
                var itemWrapperEnd = isCarouselActive ? "</div>" : "";

                h += itemWrapperStart; 
                h += "<a class='zoom-click' data-url='" + image + "' data-index='" + i + "'><img src='" + thumb + "' /></a>";
                h += itemWrapperEnd;
            });
            h += "</div>";
        }
        
        if (options.thumbHide) this.addClass('zoom-thumb-hide');
        this.html(h);

        if (isCarouselActive && typeof $.fn.owlCarousel !== 'undefined') {
            this.find('.zoom-thumb').owlCarousel({
                rtl: true, 
                loop: false,
                margin: 5,
                nav: true, 
                dots: false, 
                responsive:{
                    0:{
                        items: maxVisibleThumbs 
                    }
                }
            });
        }

        this.on('mousemove', '.zoom-mousemove', function(e) {
            var zoomer = e.currentTarget;
            
            var offsetX, offsetY;
            if (e.originalEvent && e.originalEvent.touches) {
                offsetX = e.originalEvent.touches[0].pageX - $(zoomer).offset().left;
                offsetY = e.originalEvent.touches[0].pageY - $(zoomer).offset().top;
            } else {
                offsetX = e.offsetX;
                offsetY = e.offsetY;
            }
            
            if (typeof offsetX === 'undefined' || typeof offsetY === 'undefined') return;

            var x = offsetX / zoomer.offsetWidth * 100
            var y = offsetY / zoomer.offsetHeight * 100
            
            zoomer.style.backgroundPosition = x + '% ' + y + '%';
        });

        var event = (options.thumbHover) ? 'mouseover' : 'click';
        
        this.on(event, '.zoom-click', function(e) {
            
            var $clickedElement = $(this);
            var main = $clickedElement.closest('.zoom').find('.zoom-main > span'); 
            var imageUrl = $clickedElement.attr('data-url');

            if (isCarouselActive || event === 'click') {
                 e.preventDefault(); 
                 e.stopPropagation();
            }
            
            $(main).css("background-image", "url(" + imageUrl + ")");
            $(main).find('img').attr('src', imageUrl);
            
            $clickedElement.closest('.zoom-thumb').find('.zoom-click').removeClass('active');
            $clickedElement.addClass('active');
        });
    };
}(jQuery));