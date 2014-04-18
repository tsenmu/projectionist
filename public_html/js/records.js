$(document).ready(function() {
update_record();
update_film();
update_chain();
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
function update_film_options()
{
    $('#insert-record #film-name').load('logic/ajax_target.php', {'func': 'records_get_film_options' });
    $('#update-record #film-name').load('logic/ajax_target.php', {'func': 'records_get_film_options' });
}
function update_chain()
{
    update_chain_options();
}
function update_chain_options()
{
    $('#insert-record #chain-name').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
    $('#update-record #chain-name').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
}
$("#insert-record-submit").click(function(event) {
    film_name = $("#insert-record #film-name").val();
    chain_name = $("#insert-record #chain-name").val();
    date_time = $("#insert-record #date-time").val();
    the_location = $("#insert-record #location").val();
    user_name = $("#insert-record #user-name").text();
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
            if (data.indexOf('INSERT_RECORD_SUCCESS') != -1) {
                generate_alert('#insert-record #alert', 'alert-success', '记录添加成功');
                update_record();
            }
            else{
                generate_alert('#insert-record #alert', 'alert-danger', '记录添加失败：不匹配的电影和院线记录或服务器发生错误');
            }
        }
        );
});
});
