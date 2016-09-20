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

$headers="MIME-Version:1.0\r\n";
$headers.="Content-type:text/$format;charser=Gb2312\r\n";
$headers.="To:$to_name<$to_email>\r\n";
$headers.="From:$from_name<$from_email>\r\n";

mail($to_email,$subject,$message,$headers);