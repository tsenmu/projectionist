$(document).ready(function() {
update_record();
update_film();
update_chain();
update_user();
function update_record()
{
    update_record_list();
}
function update_record_list()
{
    $('#panel-record #record-list').load('logic/ajax_target.php', {
        'func' : 'records_get_record_list'
    });
}   
function update_film()
{
    update_film_options();
}
$('#insert-record #chain-name').change( function (){
    update_film_options();
});
$('#update-record #chain-name').change( function() {
    update_film_options();
});
function update_film_options()
{
    $('#insert-record #film-name').load('logic/ajax_target.php', {'func': 'records_get_film_options', 'chain-name': $('#insert-record #chain-name').val() });
    $('#update-record #film-name').load('logic/ajax_target.php', {'func': 'records_get_film_options', 'chain-name': $('#update-record #chain-name').val() });
}
function update_chain()
{
    update_chain_options();
}
function update_user()
{
    update_user_name_options();
}
function update_chain_options()
{
    $('#insert-record #chain-name').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
    $('#update-record #chain-name').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
}
function update_user_name_options()
{
    $('#insert-record #user-name').load('logic/ajax_target.php', {'func' : 'records_get_user_name_options'});
    $('#update-record #user-name').load('logic/ajax_target.php', {'func' : 'records_get_user_name_options'});
}
$("#update-record-submit").click(function(event) {
    init_validation();
    if (!validate_update_record()) {
        return;
    }
    film_name = $("#update-record #film-name").val();
    chain_name = $("#update-record #chain-name").val();
    date_time = $("#update-record #date-time").val();
    the_location = $("#update-record #location").val();
    user_name = $("#update-record #user-name").val();
    $.post(
        "logic/ajax_target.php",
        {
            'func' : 'records_update_record',
        'film-name' : film_name,
        'chain-name' : chain_name,
        'date-time' : date_time,
        'location' : the_location,
        'user-name' : user_name
        'record-id' : update_record_id
        },
        function(data, status) {
            console.log(data);
            if (data.indexOf('SUCCESS') != -1) {
                generate_alert('#update-record #alert', 'alert-success', '记录添加成功');
                update_record();
            }
            else{
                generate_alert('#update-record #alert', 'alert-danger', '记录添加失败：不匹配的电影和院线记录或服务器发生错误');
            }
        }
        );
});

$("#insert-record-submit").click(function(event) {
    init_validation();
    if (!validate_insert_record()) {
        return;
    }
    film_name = $("#insert-record #film-name").val();
    chain_name = $("#insert-record #chain-name").val();
    date_time = $("#insert-record #date-time").val();
    the_location = $("#insert-record #location").val();
    user_name = $("#insert-record #user-name").val();
    $.post(
        "logic/ajax_target.php",
        {
            'func' : 'records_insert_record',
        'film-name' : film_name,
        'chain-name' : chain_name,
        'date-time' : date_time,
        'location' : the_location,
        'user-name' : user_name
        },
        function(data, status) {
            console.log(data);
            if (data.indexOf('SUCCESS') != -1) {
                generate_alert('#insert-record #alert', 'alert-success', '记录添加成功');
                update_record();
            }
            else{
                generate_alert('#insert-record #alert', 'alert-danger', '记录添加失败：不匹配的电影和院线记录或服务器发生错误');
            }
        }
        );
});
function trim_all_white_space(str) {
    return str.replace(/\s+/g, '');
}
function validate_update_record()
{
    chain_name = $('#update-record #chain-name');
    film_name = $('#udpate-record #film-name');
    user_name = $('#udpate-record #user-name');
    date_time = $('#udpate-record #date-time');
    the_location = $('#udpate-record #location');
    ret = true;
    if (chain_name.val() == null || trim_all_white_space(chain_name.val()).length == 0) {
        $('#udpate-record #div-chain-name').addClass('has-error');
        ret = false;
    }
    
    if (film_name.val() == null || trim_all_white_space(film_name.val()).length == 0) {
        $('#udpate-record #div-film-name').addClass('has-error');
        ret = false;
    }
    if (user_name.val() == null || trim_all_white_space(user_name.val()).length == 0) {
        $('#udpate-record #div-user-name').addClass('has-error');
        ret = false;
    }
    if (date_time.val() == null || trim_all_white_space(date_time.val()).length == 0) {
        $('#udpate-record #div-date-time').addClass('has-error');
        ret = false;
    }
    if (the_location.val() == null || trim_all_white_space(the_location.val()).length == 0) {
        $('#udpate-record #div-location').addClass('has-error');
        ret = false;
    }
    if (!ret) {
        generate_alert('#udpate-record #alert', 'alert-danger', '添加失败：信息填写不完整');
    }
    return ret;
}
function validate_insert_record()
{
    chain_name = $('#insert-record #chain-name');
    film_name = $('#insert-record #film-name');
    user_name = $('#insert-record #user-name');
    date_time = $('#insert-record #date-time');
    the_location = $('#insert-record #location');
    ret = true;
    if (chain_name.val() == null || trim_all_white_space(chain_name.val()).length == 0) {
        $('#insert-record #div-chain-name').addClass('has-error');
        ret = false;
    }
    
    if (film_name.val() == null || trim_all_white_space(film_name.val()).length == 0) {
        $('#insert-record #div-film-name').addClass('has-error');
        ret = false;
    }
    if (user_name.val() == null || trim_all_white_space(user_name.val()).length == 0) {
        $('#insert-record #div-user-name').addClass('has-error');
        ret = false;
    }
    if (trim_all_white_space(date_time.val()).length == 0) {
        $('#insert-record #div-date-time').addClass('has-error');
        ret = false;
    }
    if (trim_all_white_space(the_location.val()).length == 0) {
        $('#insert-record #div-location').addClass('has-error');
        ret = false;
    }
    if (!ret) {
        generate_alert('#insert-record #alert', 'alert-danger', '添加失败：信息填写不完整');
    }
    return ret;
}
var update_record_id;
$(document).on('click', '.open-insert-record-dialog', function() {
    update_film_options();
});
$(document).on('click', '.open-update-record-dialog', function() {
    update_record_id = $(this).data('id');
    console.log('hello');
    load_record_info_on_update_dialog();
});
function load_record_info_on_update_dialog()
{
    $.post('logic/ajax_target.php', {
        'func' : 'records_load_record_info',
        'record-id' : update_record_id
    }, function(data, status) {
        if (status == "success") {
            info = jQuery.parseJSON(data);
            $('#update-record #chain-name').val(info.chain_name);
            $('#update-record #date-time').val(info.date_time);
            $('#update-record #location').val(info.location);
            update_user_name_options();
            $('#update-record #user-name').val(info.user_name);
            update_film_options(); 
            $('#update-record #film-name').val(info.film_name);
        }
    });
}

$('.modal').on('hidden.bs.modal', function() {
    init_validation(); 
});
$("#update-record-submit").click(function(event) {
    film_name = $("#update-record #film-name").val();
    chain_name = $("#update-record #chain-name").val();
    date_time = $("#update-record #date-time").val();
    the_location = $("#update-record #location").val();
    user_name = $("#update-record #user-name").text();
    $.post(
        "logic/ajax_target.php",
        {
            'func' : 'records_update_record',
        'record-id' : update_record_id,
        'film-name' : film_name,
        'chain-name' : chain_name,
        'date-time' : date_time,
        'location' : the_location,
        'user-name' : user_name
        },
        function(data, status) {
            console.log(data);
            if (data.indexOf('SUCCESS') != -1) {
                generate_alert('#update-record #alert', 'alert-success', '记录更新成功');
                update_record();
            }
            else{
                generate_alert('#update-record #alert', 'alert-danger', '记录更新失败：不匹配的电影和院线记录或服务器发生错误');
            }
        }
        );
});

function init_validation()
{
    $('.form-group').removeClass('has-error');
}
});
