<?php
require_once(dirname(__FILE__).'/../database.php');
function movie_management_insert_film()
{
    // Input variables
    $film_name = $_REQUEST['film-name'];
    $film_userdefine_id = $_REQUEST['film-userdefine-id'];
    $chain_name = $_REQUEST['chain-name'];
    $film_path = $_REQUEST['film-path'];
    $chain_id = get_chain_id_by_name($chain_name);
    $ret = insert_film($film_userdefine_id, $film_name, $film_path, $chain_id);    
    echo $ret;
}
function movie_management_insert_chain()
{
    $chain_name = $_REQUEST['chain-name'];
    $ret = insert_chain($chain_name);
    echo $ret; // ERROR_CHAIN_EXIST or INSERT_CHAIN_SUCCESS
}
function movie_management_get_chain_list()
{
    $chains = get_all_chain_info();
    if (count($chains) == 0)
    {

echo "<thead><tr><th>暂无院线</th></tr></thead>";
        return;
    }
    $ret = '<thead><th>院线名称</th><th>操作</th></thead>';
    foreach ($chains as $chain)
    {
        $chain_name = $chain['chain_name'];
        $chain_id = $chain['chain_id'];
        $append_str= <<<EOA
<tr><td>$chain_name</td><td>
<button role="update-chain" class="btn btn-primary open-update-chain-dialog" type="button" data-toggle="modal"data-target="#update-chain" data-id="$chain_id">
<span class="glyphicon glyphicon-pencil"></span>
编辑
</button>
<button role="delete-chain" class="btn btn-danger open-delete-chain-dialog" type="button" data-toggle="modal" data-target="#delete-chain" data-id="$chain_id">
<span class="glyphicon glyphicon-trash"></span>
删除
</button>
</td>
</tr>
EOA;
        $ret = $ret . $append_str;
    }
    echo $ret;
}

function movie_management_get_chain_name_options()
{
    $chains = get_all_chain_info();
    if (count($chains) == 0)
    {

        return;
    }
    $ret = '';
    foreach ($chains as $chain)
    {
        $chain_name = $chain['chain_name'];
        $append_str = '<option>'.$chain_name.'</option>';
        $ret = $ret . $append_str;
    }
    echo $ret;
}

function movie_management_get_film_list()
{
    $films = get_all_film_info();
    if (count($films) == 0)
    {
        echo "<thead><tr><th>暂无电影</th></tr></thead>";
        return;
    }
    $ret= '<thead><tr><th>电影名称</th><th>电影编号</th><th>电影院线</th><th>电影路径</th><th>操作</th></tr></thead><tbody>';
    foreach ($films as $film)
    {
        $film_id = $film['film_id'];
        $film_userdefine_id = $film['film_userdefine_id'];
        $film_name = $film['film_name'];
        $film_path = $film['film_path'];
        $chain_name = get_chain_name_by_id($film['chain_id']);
        $append_str = <<<EOD
<tr><td>$film_name</td><td>$film_userdefine_id</td><td>$chain_name</td><td>$film_path</td>
<td>
<button role="update-film" class="btn btn-primary open-update-film-dialog" type="button" data-toggle="modal"data-target="#update-film" data-id="$film_id">
<span class="glyphicon glyphicon-pencil"></span>
编辑
</button>
<button role="delete-film" class="btn btn-danger open-delete-film-dialog" type="button" data-toggle="modal" data-target="#delete-film" data-id="$film_id">
<span class="glyphicon glyphicon-trash"></span>
删除
</button>
</td>
</tr>
EOD;
        $ret = $ret . $append_str;
    }
	$ret = $ret . '</tobdy>';
    echo $ret;
}
function movie_management_load_film_info()
{
    $film_id = $_REQUEST['film-id'];
    $film_info = get_film_info_by_id($film_id);
    $film_info['chain_name'] = get_chain_name_by_id($film_info['chain_id']);
    echo json_encode($film_info);
}
function movie_management_load_chain_info()
{
    $chain_id = $_REQUEST['chain-id'];
    $chain_info = array();
    $chain_info['chain_id'] = $chain_id;
    $chain_info['chain_name'] = get_chain_name_by_id($chain_id);
    echo json_encode($chain_info);
}
function movie_management_update_film()
{
    $film_id = $_REQUEST['film-id'];
    $film_userdefine_id = $_REQUEST['film-userdefine-id'];
    $film_name = $_REQUEST['film-name'];
    $film_path = $_REQUEST['film-path'];
    $chain_id = get_chain_id_by_name($_REQUEST['chain-name']);
    $ret = update_film($film_id, $film_userdefine_id, $film_name, $film_path, $chain_id);
    echo $ret;
}
function movie_management_update_chain()
{
    $chain_id = $_REQUEST['chain-id'];
    $old_chain_name = get_chain_name_by_id($chain_id);
    $new_chain_name = $_REQUEST['chain-name'];
    $ret = update_chain($old_chain_name, $new_chain_name);
    echo $ret;
}


function movie_management_delete_film()
{
    $film_id = $_REQUEST['film-id'];
    $ret = delete_film($film_id);
    echo $ret;
}

function movie_management_delete_chain()
{
    $chain_id = $_REQUEST['chain-id'];
    $ret = delete_chain(get_chain_name_by_id($chain_id));
    echo $ret;
}
?>
