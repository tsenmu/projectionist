$(document).ready(function() {
    set_active_navbar_button('#home');  
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii"
    });
    
    update_chain();
    update_film();
    update_user();

   $('#search-record-submit').click( function(){
        film_name = $("#search-record #film-name").val();
        chain_name = $("#search-record #chain-name").val();
        date_time_begin = $("#search-record #date-time-begin").val();
        date_time_end = $("#search-record #date-time-end").val();
        the_location = $("#search-record #location").val();
        user_name = $("#search-record #user-name").val();
        window.location.replace("records.php?search=1&film="+film_name+"&chain="+chain_name+"&from="+date_time_begin+"&to="+date_time_end+"&location="+the_location+"&user="+user_name+"&page=1"); 
    });
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
$(document).on('click', '.open-insert-record-dialog', function() {
        update_film_options();
    });
   $('.modal').on('hidden.bs.modal', function() {
        init_validation(); 
    });
    function init_validation()
    {
        $('.form-group').removeClass('has-error');
    }
});
       



