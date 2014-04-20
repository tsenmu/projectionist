    function generate_alert(selector, type, message)
    {
        $(selector).load('logic/ajax_target.php', {'func' : 'utils_generate_alert','type' : type, 'message' : message});
        $(selector).fadeIn();
        window.setTimeout(function() { $(selector).fadeOut(); }, 2000);
    }
$.urlParam = function(name){
        var results = new RegExp('[\\?&amp;]' + name + '=([^&amp;#]*)').exec(window.location.href);
        if (results == null) return null;
            return results[1] || "";
}

