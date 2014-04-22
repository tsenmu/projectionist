<?php
require_once('control_record.php');
/**
 * 导出数据为excel表格
 *@param $data    一个二维数组,结构如同从数据库查出来的数组
 *@param $title   excel的第一行标题,一个数组,如果为空则没有标题
 *@param $filename 下载的文件名
 *@examlpe 
 $stu = M ('User');
$arr = $stu -> select();
exportexcel($arr,array('id','账户','密码','昵称'),'文件名!');
 */

function exportexcel($data=array(),$title=array(),$filename='report')
{
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel");  
    header("Content-Disposition:attachment;filename=".$filename.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    //导出xls 开始
    if (!empty($title)){
        foreach ($title as $k => $v) {
            $title[$k]=iconv("UTF-8", "GB2312",$v);
        }
        $title= implode(",", $title);
        echo "$title\n";
    }
    if (!empty($data)){
        foreach($data as $key=>$val){
            foreach ($val as $ck => $cv) {
                $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
            }
            $data[$key]=implode(",", $data[$key]);

        }
        echo implode("\n",$data);
    }
}

function export_record_excel($user_id)
 {
	$res=output_record($user_id);
	exportexcel($res,array('电影',"院线",'放映员','放映时间','地点'),'放映记录');
 }
 
 function export_result_excel($result)
 {
     $ret = null;
     if (count($result) != 0 ) 
     {
         $res=get_search_result_name($result);
     }
	exportexcel($res,array('电影',"院线",'放映员','放映时间','地点'),'放映记录搜索结果');
 }
?>
