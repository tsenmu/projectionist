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
    $('#insert-record #insert-film').load('logic/ajax_target.php', {'func': 'records_get_film_options' });
}
function update_chain()
{
    update_chain_options();
}
function update_chain_options()
{
    $('#insert-record #insert-chain').load('logic/ajax_target.php', {'func' : 'records_get_chain_options' });
}
$("#insert-submit").click(function(event) {
    insert_film = $("#insert-film").val();
    insert_chain= $("#insert-chain").val();
    insert_date_time = $("#insert-date-time").val();
    insert_location = $("#insert-location").val();
    insert_user_name = $("#insert-user-id").text();
    $.post(
        "logic/ajax_target.php",
        {
            'func' : 'records_insert_record',
        'film' : insert_film,
        'chain' : insert_chain,
        'date_time' : insert_date_time,
        'location' : insert_location,
        'username' : insert_user_name
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
