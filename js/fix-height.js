(function($) {
 $.fn.tile = function(columns) {
  var tiles, max, c, h, last = this.length - 1, s;
  if(!columns) columns = this.length;
  this.each(function() {
   s = this.style;
   if(s.removeProperty) s.removeProperty("height");
   if(s.removeAttribute) s.removeAttribute("height");
  });
  return this.each(function(i) {
   c = i % columns;
   if(c == 0) tiles = [];
   tiles[c] = $(this);
   h = tiles[c].height();
   if(c == 0 || h > max) max = h;
   if(i == last || c == columns - 1)
    $.each(tiles, function() { this.height(max); });
  });
 };
})(jQuery);
// page top
$(window).load(function(){
 $('.style_list01  .list01_title').tile(5);
});
// page flow
$(window).load(function(){
 $('.style_list01  .box_list01').tile(12);
});