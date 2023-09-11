<!--
$(document).ready(function () { 
							
$("a.ajax-link").click(function (event) { 
var $this = $(this);
var url = $this.attr("href");
var lang = $this.attr("lang"); 
var current_link = "";
if(url=="http://localhost/waiupdate/"){
current_link = url; 
}else{
current_link = "/waiupdate/" + url; 
}
$(document.body).load(url); 
event.preventDefault(); 
window.history.pushState({urlPath:window.location.href}, lang, current_link);
document.title = lang;
return false;
}); 

window.onpopstate = function(event) {
var full_url = String(document.location);
var part_url = full_url.replace("http://localhost/waiupdate/", "");
if(full_url=="http://localhost/waiupdate/"){
$(document.body).load("http://localhost/waiupdate/");  
}else{
$(document.body).load(part_url);  
}
};

}); 


    function loadXMLDoc(theURL)
    {
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari, SeaMonkey
            xmlhttp=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function()
        {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.writeln(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET", theURL, false);
        xmlhttp.send();
    }
--> 