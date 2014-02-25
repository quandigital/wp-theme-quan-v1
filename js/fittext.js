(function( $ ){

  $.fn.fitText = function( lines ) {

    var theLines = lines || 1;

    return this.each(function(){

      // Store the object
      var $this = $(this);

      // Resizer() resizes items based on the object width divided by the compressor * 10
      var resizer = function () {
        var lineHeight = parseInt( $this.css( 'line-height'), 10 )*theLines;
        var elemHeight = $this.height();

        while( lineHeight < elemHeight ) {
          var lineHeight = parseInt( $this.css( 'line-height'), 10 )*theLines,
            elemHeight = $this.height(),
              fz = parseInt( $this.css( 'font-size' ), 10);
          
          $this.css( 'font-size', fz-1 );

          // console.log([lineHeight, elemHeight, $this.css('font-size')]);

          if( fz == 0 ) {
            return false;
          }
        };

      };

      // Call once to set.
      resizer();

      $(window).smartresize(function(){
        resizer;
      });

    });

  };

})( jQuery );
