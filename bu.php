<?php
$db = mysqli_connect('localhost','root','root','solohaplaza');
//execute the SQL query and return records
$result = $db->query("SELECT * FROM `metatag` WHERE entity_id>=33 LIMIT 0 , 9999");
$data=array();
while ($row=$result->fetch_assoc()){
    $data=unserialize($row['data']);
    $d=array(
        'title'=>array('value'=>$data['title']['value']),
        'description'=>array('value'=>$data['keywords']['value']),
        'keywords'=>array('value'=>$data['description']['value']),
        );
   $d=serialize($d);
    // $sql="UPDATE metatag set data='{$d}' WHERE `entity_type`='node' AND entity_id={$row['entity_id']} AND revision_id={$row['revision_id']}";
    //$db->query($sql);
}

?>