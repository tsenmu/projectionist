<?php
require_once('control_record.php');


/**
    * ��������Ϊexcel���
    *@param $data    һ����ά����,�ṹ��ͬ�����ݿ�����������
    *@param $title   excel�ĵ�һ�б���,һ������,���Ϊ����û�б���
    *@param $filename ���ص��ļ���
    *@examlpe 
    $stu = M ('User');
    $arr = $stu -> select();
    exportexcel($arr,array('id','�˻�','����','�ǳ�'),'�ļ���!');
*/
 function exportexcel($data=array(),$title=array(),$filename='report')
 {
    header("Content-type:application/octet-stream");
    header("Accept-Ranges:bytes");
    header("Content-type:application/vnd.ms-excel");  
    header("Content-Disposition:attachment;filename=".$filename.".xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    //����xls ��ʼ
    if (!empty($title)){
        foreach ($title as $k => $v) {
           // $title[$k]=iconv("UTF-8", "GB2312",$v);
        }
        $title= implode("\t", $title);
        echo "$title\n";
    }
    if (!empty($data)){
        foreach($data as $key=>$val){
            foreach ($val as $ck => $cv) {
                $data[$key][$ck]=iconv("UTF-8", "GB2312", $cv);
            }
            $data[$key]=implode("\t", $data[$key]);
            
        }
        echo implode("\n",$data);
    }
 }
 export_record_excel(1);

 function export_record_excel($user_id)
 {
	$res=output_record($user_id);
	exportexcel($res,array('��Ӱ',"Ժ��",'��ӳԱ','��ӳʱ��','�ص�'),'��ӳ��¼');
 }
?>