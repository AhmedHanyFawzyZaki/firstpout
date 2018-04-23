jQuery(document).ready(function(){
	//get to the end of each chat box
	var objDiv = $('.conversation-wrap');
	objDiv.each(function(i, element) {
		element.scrollTop = element.scrollHeight; 
	});
		dc.methods.chat();//call chat
        var _commentstrigger = $('.story-comments'),
            _that = this;
        if( _commentstrigger.length > 0 ){
          _commentstrigger.off('click').on('click', function(e){
              var _self = $(this),
                  _commentsWrap = _self.parents('.story-overview').siblings('.story-trends'),
                  _header = ( $('#header.is-sticky').length > 0 )? $('#head-container-sticky-wrapper') : $('#head-container-sticky-wrapper');
              var _headerHeight = _header.outerHeight();
              e.preventDefault();
              if( _commentsWrap.is(':hidden') ){
                _commentsWrap.slideDown(function(){
                  goToEl(_commentsWrap, null, -(_headerHeight+260) );
                });
              }else{
                _commentsWrap.slideUp(function(){
                  goToEl(_self.parents('.story-wrap'));
                });
              }
          });
        }
      });
	  
function goToEl(_el, callback, _margin){
	_margin = ( _margin === undefined )? 0 : _margin;
	if( _el.length > 0 ){
	  var _EloffsetTop = parseInt(_el.offset().top)
	  $('html, body').animate({scrollTop: _EloffsetTop+_margin }, 1000);
	}

	if( callback !== undefined && typeof(callback) === "function" ){
	  callback();
	}
  }