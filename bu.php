<?php
$db = mysqli_connect('localhost','root','root','ntonline');
//execute the SQL query and return records
$result = $db->query("SELECT * FROM `tbl_news` WHERE 1 LIMIT 0 , 9999");
$data=array();
while ($row=$result->fetch_assoc()){


    $data[$row['new_id']]=$row;
}
#file_put_contents('tbl_news.json',json_encode($data));

?>