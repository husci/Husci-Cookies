<?php
/**
 * @copyright	Copyright © 2018 - All rights reserved.
 * @license		GNU General Public License v2.0
 */
defined('_JEXEC') or die;
?>
<?php if ($params->get('GA_enable',1)): ?>
  <script type="text/plain" data-starcookie="statistics">
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $params->get('google_analytics_code'); ?>', 'auto');
  ga('send', 'pageview');

</script>
<?php endif; ?>
<?php if ($params->get('fb_pixel_enable',1)): ?>
<!-- Facebook Pixel Code -->
<script type="text/plain" data-starcookie="marketing">
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
  n.queue=[];t=b.createElement(e);t.async=!0;
  t.src=v;s=b.getElementsByTagName(e)[0];
  s.parentNode.insertBefore(t,s)}(window, document,'script',
  'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '<?php echo $params->get('fb_pixel_code'); ?>');
  fbq('track', 'PageView');
</script>
<noscript>
  <img height="1" width="1" style="display:none" 
       src="https://www.facebook.com/tr?id=<?php echo $params->get('fb_pixel_code'); ?>&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->
<?php endif; ?>
<script>
var cookiesPolicy = {
	popupdesc: '<?php echo $params->get('popup_desc'); ?>',
	popupTitle: '<?php echo $params->get('popup_title'); ?>',
    popupZIndex: "10000",
    popupTitleFontSize: '<?php echo $params->get('title_font_size'); ?>',
    popupTextFontSize: '<?php echo $params->get('desc_font_size'); ?>',
	popupcolor:'<?php echo $params->get('popup_color'); ?>',
    colorOfButton: "#007bce",
    cookieGeneral: '<?php echo $params->get('cookie_name'); ?>',
    cookieCheckPref: "preferences",
    cookieCheckStat: "statistics",
    cookieCheckMark: "marketing",
    urlCookiePolicy: '<?php echo $params->get('cookie_policy_link'); ?>',
    cookieExpiresDays: '<?php echo $params->get('cookies_expires_days'); ?>',
    prefCheckValue: "checked",
    statCheckValue: "checked",
    markCheckValue: "checked",
    cookieValue: "0",
    showPopup: false,
    popup: null, 
  
    start: function() {
        window.addEventListener("load", cookiesPolicy.onLoad, false);
    },
    onLoad: function() {
        console.log("LOADED " + window.location.href);
        cookiesPolicy.getCookie();
        cookiesPolicy.createPopup();
    },
    getCookie: function() {
        var nameOfGeneral = cookiesPolicy.cookieGeneral+ "=";
        var nameOfPreferences = cookiesPolicy.cookieCheckPref+ "=";
        var nameOfStatistics = cookiesPolicy.cookieCheckStat+ "=";
        var nameOfMarketing = cookiesPolicy.cookieCheckMark+ "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for (var i = 0; i <ca.length; i++) {
            var c = ca[i];
                while (c.charAt(0) == ' ') {
                        c = c.substring(1);
                }
                if (c.indexOf(nameOfGeneral) == 0) {
                    cookiesPolicy.cookieValue = c.substring(nameOfGeneral.length, c.length);
                }
                if (c.indexOf(nameOfPreferences) == 0) {
                    cookiesPolicy.prefCheckValue = c.substring(nameOfPreferences.length, c.length);
                }
                if (c.indexOf(nameOfStatistics) == 0) {
                    cookiesPolicy.statCheckValue = c.substring(nameOfStatistics.length, c.length);
                }
                if (c.indexOf(nameOfMarketing) == 0) {
                    cookiesPolicy.markCheckValue = c.substring(nameOfMarketing.length, c.length);
                }
 
        }
        return "";
    },
    createPopup: function() {
        cookiesPolicy.popup = document.createElement("div");
        var cssElement = document.createElement("style");
        cookiesPolicy.popup.id = "cookiePopup";
        cookiesPolicy.popup.innerHTML = cookiesPolicy.loadPopupContent();
        cssElement.innerHTML = cookiesPolicy.loadCSS();        
        var element = document.getElementsByTagName("body")[0];
        element.appendChild(cookiesPolicy.popup);
        element.appendChild(cssElement);
        if (window.location.href===cookiesPolicy.urlCookiePolicy) {
            cookiesPolicy.popup.style.display="none";
            if (cookiesPolicy.cookieValue==="1") {
                cookiesPolicy.loadScript();
            }
        } else if (cookiesPolicy.cookieValue==="1") {
            cookiesPolicy.popup.style.display="none"; 
            cookiesPolicy.loadScript();
        }
    },
    loadPopupContent: function() {
        var checkForPref = "<input type=\"checkbox\" name=\"preferences\" value=\"preferences\" " + cookiesPolicy.prefCheckValue + "><span class=\"checkboxtext\">Preferenze</span>";
        var checkForStat = "<input type=\"checkbox\" name=\"statistics\" value=\"statistics\" " + cookiesPolicy.statCheckValue + "><span class=\"checkboxtext\">Statistics</span>";
        var checkForMark = "<input type=\"checkbox\" name=\"marketing\" value=\"marketing\" " + cookiesPolicy.markCheckValue + "><span class=\"checkboxtext\">Marketing</span>";
        var allPrefScript = document.querySelectorAll("script[data-starcookie=\"preferences\"]"); 
        if (allPrefScript.length===0) {
            checkForPref = "";
        }
        var allStatScript = document.querySelectorAll("script[data-starcookie=\"statistics\"]"); 
        if (allStatScript.length===0) {
            checkForStat = "";
        }
        var allMarkScript = document.querySelectorAll("script[data-starcookie=\"marketing\"]"); 
        if (allMarkScript.length===0) {
            checkForMark = "";
        }
        var htmlCode = "<div id=\"cookieBox\">" + 
                            "<h3>"+cookiesPolicy.popupTitle+"</h3>" + 
                            "<hr>" + 
                            "<p>"+cookiesPolicy.popupdesc+"</p>" + 
                            "<p><a href=\""+cookiesPolicy.urlCookiePolicy+"\" title=\"Leggi la Policy\">View Privacy Policy</a></p>" + 
                            "<div id=\"checkboxContainer\"> " + 
                                "<div class=\"singleCheckBox\"><input type=\"checkbox\" name=\"necesse\" value=\"necesse\" checked disabled><span class=\"checkboxtext\">Cookie necessari</span></div> " + 
                                "<div class=\"singleCheckBox\">" + checkForPref + "</div>" + 
                                "<div class=\"singleCheckBox\">" + checkForStat + "</div>" + 
                                "<div class=\"singleCheckBox\">" + checkForMark + "</div>" + 
                            "</div>" + 
                            "<button onClick=\"cookiesPolicy.loadScript()\"><?php echo $params->get('button_text'); ?></button>" + 
                        "</div>";
        return htmlCode;
    },
    loadCSS: function() {
        var style = "#cookiePopup {" +
                        "font-family: sans-serif; " + 
                        "position: fixed; " + 
                        "z-index: " + cookiesPolicy.popupZIndex + ";" + 
                        "left: 0; " + 
                        "top: 0; " + 
                        "height: 100vh; " + 
                        "width: 100%; " + 
                        "padding-top: 15vh; " + 
                        "color: #ddd;" +                         
                        "background-color: rgba(0,0,0,0.6);" + 
                        "} " + 
                    "#cookiePopup #cookieBox {" + 
                        "width: 90%; " + 
                        "max-width: 640px; " + 
                        "margin: 0 auto; " + 
                        "border: 2px solid white; " + 
                        "box-shadow: 0px 0px 15px #000;" + 
                        "padding: 25px; " + 
                        "background-color: "+ cookiesPolicy.popupcolor + ";" + 
                    "} " + 
                    "#cookiePopup #cookieBox h3 {" + 
                        "margin-top: 0; " + 
                        "margin-bottom: 0; " + 
                        "font-size: "+ cookiesPolicy.popupTitleFontSize + ";" + 
                        "font-weight: bold; " + 
                        "font-family: sans-serif, arial; " + 
                    "} " + 
                    "#cookiePopup #cookieBox hr {" + 
                        "width: 60vw; " + 
                        "max-width: 250px; " + 
                        "margin-top: 0; " + 
                        "margin-left: 0; " + 
                    "} " + 
                    "#cookiePopup #cookieBox p {" + 
                        "font-size: " + cookiesPolicy.popupTextFontSize + ";" + 
                        "text-align: justify; " + 
                        "line-height: " + cookiesPolicy.popupTextFontSize + ";" + 
                        "font-family: sans-serif; " + 
                    "} " + 
                    "#cookiePopup #cookieBox p:nth-child(3) {" + 
                        "padding: 0 0 10px 0; " +                     
                    "} " +                                         
                    "#cookiePopup #cookieBox a {" + 
                        "color: #fff; " + 
                    "} " + 
                    "#cookiePopup #cookieBox #checkboxContainer {" + 
                        "padding: 15px 10px 25px 10px; " + 
                    "} " + 
                    "#cookiePopup #cookieBox #checkboxContainer div.singleCheckBox{" + 
                        "display: inline-block; " + 
                    "} " + 
                    "#cookiePopup #cookieBox #checkboxContainer input[type=checkbox] {" + 
                        "-ms-transform: scale(1.5); " + 
                        "-moz-transform: scale(1.5); " + 
                        "-webkit-transform: scale(1.5); " + 
                        "-o-transform: scale(1.5); " + 
                        "padding: 10px; " + 
                        "margin-left: 15px; " + 
                        "cursor: pointer; " + 
                    "} " + 
                    "#cookiePopup #cookieBox #checkboxContainer .checkboxtext {" + 
                        "margin-left: 5px; " + 
                        "display: inline; " + 
                        "font-size: " + cookiesPolicy.popupTextFontSize + ";" + 
                    "} " +                     
                    "#cookiePopup #cookieBox button {" + 
                        "background-color: " + cookiesPolicy.colorOfButton + "; " + 
                        "color: #fff; " + 
                        "font-size: 1rem; " + 
                        "padding: 10px 20px; " + 
                        "cursor: pointer; " + 
                        "transition: all 0.5s; " + 
                    "} " + 
                    "#cookiePopup #cookieBox button:hover {" + 
                        "background-color: white;" + 
                        "color: " + cookiesPolicy.colorOfButton + "; " + 
                    "} " + 
                    "@media screen and (max-width:768px) { " + 
                        "#cookiePopup {" +
                            "padding-top: 6vh; " + 
                        "} " + 
                        "#cookiePopup #cookieBox #checkboxContainer div.singleCheckBox{" + 
                            "display: block; " + 
                            "padding: 5px 0; " + 
                        "} " + 
                    "} ";
        return style;
    },
    loadScript: function() {
        var d = new Date();
        d.setTime(d.getTime() + (cookiesPolicy.cookieExpiresDays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        var popupIsVisible = (cookiesPolicy.popup.style.display==="block" || cookiesPolicy.popup.style.display ==="");
        if (popupIsVisible) {
            document.cookie = cookiesPolicy.cookieGeneral + "=1;" + expires + ";path=/";
        }
        if (document.querySelector("input[name=\"preferences\"]")!=null) {
            if (document.querySelector("input[name=\"preferences\"]").checked) {
                var allPrefScript = document.querySelectorAll("script[data-starcookie=\"preferences\"]"); 
                for (var i = 0; i < allPrefScript.length; i++) {
                    allPrefScript[i].setAttribute("type","text/javascript");
                    try {
                        eval(allPrefScript[i].text);
                    } catch (err) {
                        //doNothing
                    }
                }
                if (popupIsVisible) {
                    cookiesPolicy.prefCheckValue = "checked";
                    document.cookie = cookiesPolicy.cookieCheckPref + "=" + cookiesPolicy.prefCheckValue + ";" + expires + ";path=/";
                }
            } else if (popupIsVisible) {
                    cookiesPolicy.prefCheckValue = "";
                    document.cookie = cookiesPolicy.cookieCheckPref + "=" + cookiesPolicy.prefCheckValue + ";" + expires + ";path=/";
            }
        }
        if (document.querySelector("input[name=\"statistics\"]")!=null) {
            if (document.querySelector("input[name=\"statistics\"]").checked) {
                var allStatScript = document.querySelectorAll("script[data-starcookie=\"statistics\"]");
                for (var i = 0; i < allStatScript.length; i++) {
                    allStatScript[i].setAttribute("type","text/javascript");
            try {
            var newCode = document.createElement("script");
            newCode.text = allStatScript[i].text;
            document.body.appendChild( newCode );
                    eval(allStatScript[i].text);
                    } catch (err) {
            console.log(err);
                        //doNothing
                    }
                }
                if (popupIsVisible) {
                    cookiesPolicy.statCheckValue = "checked";
                    document.cookie = cookiesPolicy.cookieCheckStat + "=" + cookiesPolicy.statCheckValue + ";" + expires + ";path=/";
                }
            } else if (popupIsVisible) {
                cookiesPolicy.statCheckValue = "";
                document.cookie = cookiesPolicy.cookieCheckStat + "=" + cookiesPolicy.statCheckValue + ";" + expires + ";path=/";
            }
        }
        if (document.querySelector("input[name=\"marketing\"]")!=null) {
            if (document.querySelector("input[name=\"marketing\"]").checked) {
                var allMarkScript = document.querySelectorAll("script[data-starcookie=\"marketing\"]");
                for (var i = 0; i < allMarkScript.length; i++) {
                    allMarkScript[i].setAttribute("type","text/javascript");
            try {
                        eval(allMarkScript[i].text);
                    } catch (err) {
                        //doNothing
                    }
                }
                if (popupIsVisible) {
                    cookiesPolicy.markCheckValue = "checked";
                    document.cookie = cookiesPolicy.cookieCheckMark + "=" + cookiesPolicy.markCheckValue + ";" + expires + ";path=/"; 
                }
            } else if (popupIsVisible) {
                cookiesPolicy.markCheckValue = "";
                document.cookie = cookiesPolicy.cookieCheckMark + "=" + cookiesPolicy.markCheckValue + ";" + expires + ";path=/"; 
            }
        }
        if (popupIsVisible) {
            cookiesPolicy.popup.style.display="none";
        }
    },
    showPopup: function() {
        cookiesPolicy.popup.style.display="block"; 
    }
};
cookiesPolicy.start();
</script>
