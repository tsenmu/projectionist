    function generate_alert(selector, type, message)
    {
        $(selector).load('logic/ajax_target.php', {'func' : 'utils_generate_alert','type' : type, 'message' : message});
        $(selector).fadeIn();
        window.setTimeout(function() { $(selector).fadeOut(); }, 2000);
    }
