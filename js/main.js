var dc;
(function($){
  dc = 
  {
    dom : {
      header : $('#header'),
      mobileMenuWrap : $('#mobile-menu-wrap'),
      window : $(window).height()
    },
    init: function()
    { 
      this.methods.buildMobileMenu();
      if( $('body.logged-in').length > 0 )
        this.methods.stickyElements();
      this.methods.circleStats();
      this.methods.chat();
      this.methods.bxsliders();
      this.methods.timeline();
      this.methods.checkboxes();

      if( $('.form-select').length > 0 ){
        $('.form-select').sSelect({
          ddMaxHeight : 200
        });
      }

      if( $('.contacts-list .friends-list').length > 0 ){
        var _newH = parseInt(dc.dom.window-dc.dom.header.height());
        $('.contacts-list .friends-list').height( _newH );
      }

      if( $('.fancybox').length > 0 ){
        $(".fancybox").fancybox({
          type: 'ajax', 
          autoScale:false, 
          padding:0,
          afterShow : function(){
            if( $('.custom-scroll').length > 0 ){
              $('.custom-scroll').jScrollPane();
            }
            dc.methods.albumSlider();
            if( $('.form-select').length > 0 ){
              $('.form-select').sSelect({
                ddMaxHeight : 200
              });
            }
          }
        });

      }
      if( $('.lightbox').length > 0 ){
        $('.lightbox').fancybox({
          autoScale:false, 
          padding:0,
        })
      }

      if( $('.custom-scroll').length > 0 )
        $('.custom-scroll').jScrollPane();

      if( $('.date-picker').length > 0 )
        $('.pick-date').off('click').on('click', function(e){
          e.preventDefault();
          $(this).siblings('.date-picker').datepicker('show');
        })

      if( $('.form-uploader').length > 0 )
        $('.form-uploader').simpleFileInput({
          placeholder : 'Upload picture',
          buttonText : 'Upload picture',
          width: 330,
          allowedExts : [ 'png', 'jpg', 'jpeg', 'gif' ],
          onInit : function(){
            console.log('Init :)')
          },

          onError : function(){
            console.log('Whoops! an error has been occured')
          },

          onFileSelect : function(){
            console.log('Great News! it works pretty well')
          }
        });


    },

    methods:
    {
      chat : function(){
        var _trigger = $('.contacts-list-trigger');
        if( _trigger.length > 0 ){
          _trigger.off('click').on('click', function(e){
            var _self = $(this),
                _friendsList = _self.siblings('.friends-list-wrap');
            e.preventDefault();
            if(_friendsList.is(':hidden') ){
              _self.addClass('list-trigged');
            }else{
              _self.removeClass('list-trigged');
            }
          })
        }
      },
      albumSlider : function(){
        _album = $('#album-photos');
        if( _album.length > 0 ){
          // alert('album is ON')
          var _currentMedia = $('#current-media'),
              _listItem = $('#list-medias .album-img');

          _listItem.off('click').on('click', function(e){
            _src = $(this).attr('href');
            
            e.preventDefault();
            _currentMedia.attr('src', _src);
          });

          $('.show-full-screen').off('click').on('click', function(e){
            e.preventDefault();
            dc.methods.useOnfullScreen('current-media');
          })
        }
      },
      useOnfullScreen : function(_id){
        var i = document.getElementById(_id);
         
        // go full-screen
        if (i.requestFullscreen) {
            i.requestFullscreen();
        } else if (i.webkitRequestFullscreen) {
            i.webkitRequestFullscreen();
        } else if (i.mozRequestFullScreen) {
            i.mozRequestFullScreen();
        } else if (i.msRequestFullscreen) {
            i.msRequestFullscreen();
        }
      },
      checkboxes : function(){
        var _checkbox = $('.checkbox');
        if( _checkbox.length > 0 ){
          var _el = null;
          _checkbox.off('click').on('click', function(e){
            _input = $(this).find('input').val();
            if( $('#'+_input).length > 0 ){
              _el = $('#'+_input);
              if( _el.is(':hidden') ){
                _el.show();
              }
            }else if( _el != null && _el.is(':visible') ){
              _el.hide();
            }
          })
        }
      },
      bxsliders : function(){
          if( $('.bx-slider').length > 0 )
              $('.bx-slider').each(function(key, el){
                  var _el = $(el);
                  var _hasPager = (  _el.attr('data-has-pager') )? _el.attr('data-has-pager') : 0,
                      _hasControls = ( _el.attr('data-has-controls') )? _el.attr('data-has-controls') : 0,
                      _nextLabel = ( _el.attr('data-nlabel') )? _el.attr('data-nlabel') : 'Next',
                      _prevLabel = ( _el.attr('data-plabel') )? _el.attr('data-plabel') : 'Prev',
                      _isauto = ( _el.attr('data-auto') )? _el.attr('data-auto') : 0,
                      _useCSS = ( _el.attr('data-css') )? _el.attr('data-css') : true,
                      _hasLoop = ( _el.attr('data-loop') )? _el.attr('data-loop') : false,
                      _hasCounter = ( _el.attr('data-has-counter') )? $(_el.attr('data-has-counter')) : false,
                      _showSlides = ( _el.attr('data-show-slides') )? _el.attr('data-show-slides') : 1,
                      _slideWidth = ( _el.attr('data-el-width') )? _el.find($(_el.attr('data-el-width'))).eq(0).width() : 0,
                      _elmPagerThumb = ( _el.attr('data-pager-custom') )? _el.attr('data-pager-custom') : null;
                  
                      if( _el.parents('.bx-wrapper').length === 0 ){
                        _el.bxSlider({
                            pager : parseInt(_hasPager),
                            controls : parseInt(_hasControls),
                            pagerCustom: _elmPagerThumb,
                            infiniteLoop : _hasLoop,
                            easing : 'linear',
                            auto : _isauto,
                            useCSS : ( _el.parents('.ct-slider-commun').length > 0 || _useCSS === 'false' )? false : true,
                            minSlides: _showSlides,
                            maxSlides: _showSlides,
                            slideWidth: _slideWidth,
                            nextText : _nextLabel,
                            prevText : _prevLabel,
                            onSlideAfter: function(el, oldIndex, activeIndex){
                              if( _hasCounter != false && _hasCounter.length > 0 ){
                                _hasCounter.find('span').text(activeIndex+1)
                              }
                            }
                        })
                      }
              })
      },

      timeline: function(){
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
                  _that.goToEl(_commentsWrap, null, -(_headerHeight+260) );
                });
              }else{
                _commentsWrap.slideUp(function(){
                  _that.goToEl(_self.parents('.story-wrap'));
                });
              }
          });
        }
      },
      goToEl: function(_el, callback, _margin){
        _margin = ( _margin === undefined )? 0 : _margin;
        if( _el.length > 0 ){
          var _EloffsetTop = parseInt(_el.offset().top)
          $('html, body').animate({scrollTop: _EloffsetTop+_margin }, 1000);
        }

        if( callback !== undefined && typeof(callback) === "function" ){
          callback();
        }
      },
      circleStats : function(){
        _circleStats = $('.circle-stats');
        if( _circleStats.length > 0 ){
          _circleStats.circliful();
        }
      },
      buildMobileMenu: function(){
        var _wrap = dc.dom.mobileMenuWrap,
            _actions = _wrap.siblings('.profile-actions'),
            _menus = $('#bpmenu'),
            _width = -screen.width+'px';

        _wrap.append(_actions.clone());
        _wrap.append(_menus.clone().attr('id', 'bpmenu-mobile'));
        _wrap.css('right', _width);
        $('<span />', {
          'id' : 'menu-overlay',
          'style' : 'height:'+$(window).outerHeight()+'px;'
        }).appendTo('body');

        $('.mobile-actions').off('click').on('click', function(e){
          var _this = $(this),
              _profileActionsH = $('.profile-actions-wrap').height()+15;
          e.preventDefault();
          if( $('#mobile-menu-wrap.opened').length > 0 ){

            _wrap.stop().animate(
              {
                right: _width,
                opacity: '0'
              }, 800, function(){
              $('#menu-overlay').hide();
              $(this).removeClass('opened');
              dc.dom.mobileMenuWrap.height('auto');
              $(this).animate({opacity: 1});
              $('body').removeClass('menu-opened').height('auto');
            });
          }else{
            _wrap.addClass('opened');
            _wrap.stop().animate({right: 0}, 800);
            $('#menu-overlay').show();
            $('body').addClass('menu-opened')
            $('body').height($(window).height());
            $('#bpmenu-mobile').height($(window).height()).css('padding-bottom', '140px');
          }
        })
      },

      stickyElements: function(){
        if( $('body.home').length == 0 ){
          $('#head-container').sticky({
            topSpacing : 0
          });

          $('.profile-avatar-contain').sticky({
            topSpacing : 0
          });
        }
      }
    }
  }

})(jQuery); 
  
jQuery(document).ready(function(){
  dc.init();
});
