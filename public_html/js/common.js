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
function getUrlVars()
{
        var vars = [], hash;
            var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for(var i = 0; i < hashes.length; i++)
                        {
                                    hash = hashes[i].split('=');
                                            vars.push(hash[0]);
                                                    vars[hash[0]] = hash[1];
                                                        }
                    return vars;
}
