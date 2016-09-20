<?php
/**
 * Created by PhpStorm.
 * User: Lee
 * Date: 2016/9/11
 * Time: 19:28
 */
$from_name=iconv('UTF-8','Gb2312',$_POST['from_name']);
$from_email=iconv('UTF-8','Gb2312',$_POST['from_email']);
$to_name=iconv('UTF-8','Gb2312',$_POST['to_name']);
$to_email=iconv('UTF-8','Gb2312',$_POST['to_email']);
$format=$_POST['format'];
$subject=iconv('UTF-8','Gb2312',$_POST['subject']);
$message=iconv('UTF-8','Gb2312',$_POST['message']);

$mime_boundary=md5(uniqid(mt_rand(),TRUE));

$headers="MIME-Version:1.0\r\n";
$headers.="Content-type:multipart/mixed;\r\n";
$headers.="To:$to_name<$to_email>\r\n";
$headers.="From:$from_name<$from_email>\r\n";
$headers.=" boundary=".$mime_boundary."\r\n";

$content="This is a multi-part message in MIME format.\r\n";
$content.="--".$mime_boundary."\r\n";
$content.="Content-type:text/$format;charset=Gb2312\r\n";
$content.="Content-Transfer-Encoding:8bit\r\n\r\n";
$content.=$message."\r\n";
$content.="--".$mime_boundary."\r\n";

if($_FILES['myfile']['name']!=''){
    $file=$_FILES['myfile']['tmp_name'];
    $file_name=iconv('UTF-8','Gb2312',$_FILES['myfile']['name']);
    $fp=fopen($file,'rb');
    $data=chunk_split(base64_encode($data));
}

$content.="Content-type:".$_FILES['myfile']['type'].";";
$content.="name=".$file_name."\r\n";
$content.="Content-Disposition:attachment;";
$content.="filename=".$file_name."\r\n";
$content.="Content-Transfer-Encoding:BASE64\r\n\r\n";
$content.=$data."\r\n";
$content.="--".$mime_boundary."--\r\n";

mail($to_email,$subject,$content,$headers);