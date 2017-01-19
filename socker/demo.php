<?php
function getCombinations($base,$n){

    $baselen = count($base);
    if($baselen == 0){
        return;
    }
    if($n == 1){
        $return = array();
        foreach($base as $b){
            $return[] = array($b);
        }
        return $return;
    }else{
        //get one level lower combinations
        $oneLevelLower = getCombinations($base,$n-1);

        //for every one level lower combinations add one element to them that the last element of a combination is preceeded by the element which follows it in base array if there is none, does not add
        $newCombs = array();

        foreach($oneLevelLower as $oll){

            $lastEl = $oll[$n-2];
            $found = false;
            foreach($base as  $key => $b){
                if($b == $lastEl){
                    $found = true;
                    continue;
                    //last element found

                }
                if($found == true){
                    //add to combinations with last element
                    if($key < $baselen){

                        $tmp = $oll;
                        $newCombination = array_slice($tmp,0);
                        $newCombination[]=$b;
                        $newCombs[] = array_slice($newCombination,0);
                    }

                }
            }

        }

    }

    return $newCombs;

}
include 'simple_html_dom.php';
$html = file_get_html('data.html');
echo "<table>";
echo file_get_contents('data.html');
echo "</table>";

$players=array();
$playersByPostion=array();
foreach($html->find('tr') as $tr){
    $player=array();
    $player['name']= $tr->find('td.rwo-name', 0)->find('a',0)->innertext;
    $player['team']= $tr->find('td.rwo-team', 0)->innertext;
    $player['position']= $tr->find('td.rwo-pos', 0)->innertext;
    $player['sallary']= str_replace('$','',$tr->find('.salaryInput', 0)->value);
    $player['sallary']= str_replace(',','',$player['sallary']);
    $player['points']= $tr->find('.ptsInput', 0)->value;
    $player['value']= $tr->find('.rwo-value', 0)->innertext;
    $players[]=$player;

    if(!isset($playersByPostion[$player['position']])){
        $playersByPostion[$player['position']]=array();
    }
    $playersByPostion[$player['position']][]=$player;
}
foreach($playersByPostion as &$item){
    array_multisort (array_column($item, 'value'), SORT_DESC, $item);
    $item=array_slice($item, 0, 5);
}
unset($item);
$P_GK=getCombinations($playersByPostion['GK'],1);
$P_D=getCombinations($playersByPostion['D'],2);
$P_M=getCombinations($playersByPostion['M'],2);
$P_F=getCombinations($playersByPostion['F'],2);
$P_FLEX=array_merge($playersByPostion['D'],$playersByPostion['M'],$playersByPostion['F']);

$teams=array();
foreach ($P_GK as $gk){
    foreach ($P_D as $d){
        foreach ($P_M as $m){
            foreach ($P_F as $f){
                $t=array_merge($gk,$d,$m,$f);
                foreach($P_FLEX as $flex){
                    if(!in_array($flex,$t)){
                        $team=$t;
                        array_push($team,$flex);
                        $salary=0;
                        $values=0;
                        $points=0;
                        foreach($team as $player){
                            $salary+=intval($player['sallary']);
                            $values+=($player['value']);
                            $points+=($player['points']);
                        }
                        if($salary<=50000)$teams[]=array('team'=>$team,'values'=>$values,'sallary'=>$salary,'points'=>$points);


                    }else{
                        $x=1;
                    }

                }
            }
        }
    }
}
array_multisort (array_column($teams, 'points'), SORT_DESC, $teams);

echo "<br>";
echo "Total result count : ".count($teams);
echo "<br>";
for($i=0;$i<100;$i++){
    diplayResult($teams[$i]);
}
function diplayResult($teams){
    echo '<br/><hr><table border="1">';
    foreach($teams['team'] as $player){
        echo '<tr><td>'.$player['name'].'</td>
        <td>'.$player['team'].'</td>
        <td>'.$player['position'].'</td>
        <td>'.$player['sallary'].'</td>
        <td>'.$player['points'].'</td>
        <td>'.$player['value'].'</td>
        </tr>';
    }
echo '
<tr>
<td colspan="3"></td>
<td >$'.number_format($teams['sallary']).'</td>
<td>'.$teams['points'].'</td>
<td >'.$teams['values'].'</td>
</tr>
</table>';
}