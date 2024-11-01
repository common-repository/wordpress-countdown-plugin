<?php
/*
Plugin Name: Wordpress Countdown Plugin
Plugin URI: http://wordpress.org/
Description: Boost your sales with this countdown timer.
Author: Pepijn de Vos
Version: 1.3
Author URI: http://metapep.wordpress.com/
*/

function countdown($atts, $content = null) {
	extract(shortcode_atts(array('date' => date('H:i:s n/j/Y')), $atts));
    
	$content = explode("[after]", $content);
	$tempzone = date_default_timezone_get();
	date_default_timezone_set('UTC');
	$time = call_user_func_array("mktime", preg_split('#[^0-9]#', $date));
	
	if($time > time()) {
	   $time -= time();
	   $return = str_replace("[counter]", '<span class="counter" title="'.$time.'">'.date('z', $time)." <span class=\"timeunit\">days,</span> ".(date('H', $time) * 1)." <span class=\"timeunit\">hours,</span> ".(date('i', $time) * 1)." <span class=\"timeunit\">minutes and</span> ".(date('s', $time) * 1)." <span class=\"timeunit\">seconds</span></span>" , $content[0]);
	   date_default_timezone_set($tempzone);
	   return do_shortcode($return);
	} else {
	   date_default_timezone_set($tempzone);
	   return do_shortcode($content[1]);
	}
}

function count_script() {
    ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        Date.prototype.getDOY = function() {
            var onejan = new Date(this.getUTCFullYear(),0,1);
            return Math.ceil((this - onejan) / 86400000);
        }
        var time = 0
        var elements;
        
        if(typeof(document.addEventListener) == "function") {
            document.addEventListener("DOMContentLoaded", start, false);
        } else {
            window.onload = start; //TODO find alternative 
        }
        
        function start() {
            if (document.getElementsByClassName == undefined) {
            	document.getElementsByClassName = function(className)
            	{
            		var hasClassName = new RegExp("(?:^|\\s)" + className + "(?:$|\\s)");
            		var allElements = document.getElementsByTagName("*");
            		var results = [];
            
            		var element;
            		for (var i = 0; (element = allElements[i]) != null; i++) {
            			var elementClass = element.className;
            			if (elementClass && elementClass.indexOf(className) != -1 && hasClassName.test(elementClass))
            				results.push(element);
            		}
            
            		return results;
            	}
            }
            
            elements = document.getElementsByClassName("counter")
            for(el in elements) {
                if(parseInt(el) + 1) {
                    setInterval("counter_decrease("+el+")", 1000);
                }
            }
        }
        
        function counter_decrease(el) {
            var co = new Date();
            elements[el].title -= 1;
            
            if(elements[el].title == 0) {
                window.location.reload();
            }
            
            co.setTime(elements[el].title * 1000);
            elements[el].innerHTML = (co.getDOY()-1)+" <span class=\"timeunit\">days,</span> "+co.getUTCHours()+" <span class=\"timeunit\">hours,</span> "+co.getUTCMinutes()+" <span class=\"timeunit\">minutes and</span> "+co.getUTCSeconds()+" <span class=\"timeunit\">seconds</span>";
        }
        /* ]]> */
    </script>
    <?php
}

add_action('wp_head', 'count_script');
add_shortcode('countdown', 'countdown');
add_shortcode('countdown2', 'countdown');
add_shortcode('countdown3', 'countdown');
?>
