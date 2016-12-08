<?php
$db = mysqli_connect('localhost','root','root','cttt');
//execute the SQL query and return records
$result = $db->query("SELECT * FROM `tbl_products` WHERE 1 LIMIT 0 , 9999");
$data=array();
while ($row=$result->fetch_assoc()){
    $row['tid']=0;
    $data[$row['p_id']]=$row;
}
file_put_contents('tbl_products.json',json_encode($data));

?>