<?php
$db = mysqli_connect('localhost','root','root','cttt');
//execute the SQL query and return records
$result = $db->query("SELECT id,title FROM `tbl_menu` WHERE section='news' LIMIT 0 , 9999");
$data=array();
while ($row=$result->fetch_assoc()){
    $row['tid']=0;
    $data[$row['id']]=$row;
}
//file_put_contents('tbl_menu_news.json',json_encode($data));
?>