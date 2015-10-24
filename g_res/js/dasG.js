
var style_cookie_name = "g_albumStyle" ;
var style_cookie_duration = 30 ;
var style_domain = "" ;

function switch_style ( css_title ){
  var i, link_tag ;
  for (i = 0, link_tag = document.getElementsByTagName("link") ;
    i < link_tag.length ; i++ ) {
    if ((link_tag[i].rel.indexOf( "stylesheet" ) != -1) &&
      link_tag[i].title) {
      link_tag[i].disabled = true ;
      if (link_tag[i].title == css_title || link_tag[i].title == "base") {
        link_tag[i].disabled = false ;
      }
    }    
    set_cookie( style_cookie_name, css_title,
      style_cookie_duration, style_domain );      
  }
}
function set_style_from_cookie(){
  var css_title = get_cookie( style_cookie_name );
  if (css_title.length) {
    switch_style( css_title );
  }
}
function set_cookie ( cookie_name, cookie_value,
    lifespan_in_days, valid_domain ){
    var domain_string = valid_domain ?("; domain=" + valid_domain) : '' ;
    var cookieStr = cookie_name +"=" + encodeURIComponent( cookie_value ) +
                       "; max-age=" + 60 * 60 * 24 * lifespan_in_days +
                       "; path=/" + domain_string ;
    document.cookie = cookieStr;
//    console.log('set cookk ',cookieStr);
}
function get_cookie ( cookie_name ){    
    var cookie_string = document.cookie ;    
    if (cookie_string && cookie_string.length != 0) {
        var cookie_value = cookie_string.match ('(^|; )[\s]*'+cookie_name +'=([^;]*)' );                                   
//    console.log('get cookk ',cookie_string,cookie_value);   
     if(cookie_value instanceof Array && cookie_value.length>=3){        
//        console.log('return '+decodeURIComponent ( cookie_value[2] ));   
        return decodeURIComponent ( cookie_value[2] ) ;
      }else{                
//       console.log('return ',typeof cookie_value);   
        return '' ;    
      }
    }
    return '' ;
}
