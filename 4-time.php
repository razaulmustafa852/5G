<!DOCTYPE html>
<html>
<body><table style="width:100%">

<tr>

<th>exp</th>
<th>column</th>
<th>user_no</th>
<th>algo</th>
<th>rtt_qos</th>
<th>tp_qos</th>
<th>p_qos</th>
<th>P1203</th>
<th>Clae</th>
<th>Duanmu</th>
<th>Yin</th>
<th>Yu</th>
</tr>

<?php
include "config.php";
/**
 * 
 * @param Array $list
 * @param int $p
 * @return multitype:multitype:
 * @link http://www.php.net/manual/en/function.array-chunk.php#75022
 */
function partition(Array $list, $p) {
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}


function return_diff_buff($exp_id, $intUser,$return){
$query = "select * from dashoutput where intExpID=".$exp_id." and intUser= ".$intUser."   ";
$sql = mysql_query($query);
$buff= array();
while($rows = mysql_fetch_assoc($sql)){

$buff[] = (int)$rows[$return];
}	
return $buff;
}


function aggregate_1($exp_ID, $user ){
$array = array();

$query = mysql_query("SELECT rtt_qos,tp_qos,p_qos,P1203,intID,intExpID,intUser, Duanmu, Clae, Yin, Yu from dashoutput  where rtt_qos!=0 and intExpID= ".$exp_ID." and intUser= ".$user." order by intSeg asc");
$array = array();
while($row_1 = mysql_fetch_assoc($query)){
	$array[] = $row_1;
  } 
  //Here i partition 60 rows into three elements
  return partition($array, 4);
}

function avgReturn($first = array(), $total, $value ){
$sum = 0;
for($i=0;$i<$total; $i++){
	$sum = $sum + $first[$i][$value];
//echo $first[$i][$value];
}
$val =  $sum / count(array_filter($first));
return $val;
} 





$read_all = 'SELECT distinct(intExpID) from dashoutput';
$sql = mysql_query($read_all);
while($results = mysql_fetch_assoc($sql)){

	for($n=1;$n<=2;$n++ ){

	list($f_0, $f_1, $f_2, $f_3) = aggregate_1($results['intExpID'], $n );
	//this loop said, that split 60 sessions into 3 parts


	for($j = 0; $j<4; $j++ ){

		if($j==0){?>

		<tr>
			<th><?php echo $f_0[0]['intExpID']?></th>
			<th><?php echo getColumn($f_0[0]['intExpID'],'column_name'); ?></th>
			<th><?php echo $n;?></th>
			<th><?php echo getColumn($f_0[0]['intExpID'],'algo'); ?></th>	
			<th><?php echo avgReturn($f_0, 20, 'rtt_qos'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'tp_qos'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'p_qos'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'P1203'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Clae'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Duanmu'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yin'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yu'); ?></th>
			
		</tr>

		<?php }elseif($j==1){?>

			<tr>
			<th><?php echo $f_1[0]['intExpID']?></th>
			<th><?php echo getColumn($f_1[0]['intExpID'],'column_name'); ?></th>
			<th><?php echo $n;?></th>
			<th><?php echo getColumn($f_1[0]['intExpID'],'algo'); ?></th>	
			<th><?php echo avgReturn($f_1, 20, 'rtt_qos'); ?></th>
			<th><?php echo avgReturn($f_1, 20, 'tp_qos'); ?></th>
			<th><?php echo avgReturn($f_1, 20, 'p_qos'); ?></th>
			<th><?php echo avgReturn($f_1, 20, 'P1203'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Clae'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Duanmu'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yin'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yu'); ?></th>
			
		</tr>



		<?php }elseif($j==2){?>

			<tr>
			<th><?php echo $f_2[0]['intExpID']?></th>	
			<th><?php echo getColumn($f_2[0]['intExpID'],'column_name'); ?></th>
			<th><?php echo $n;?></th>
			<th><?php echo getColumn($f_2[0]['intExpID'],'algo'); ?></th>
			<th><?php echo avgReturn($f_2, 20, 'rtt_qos'); ?></th>
			<th><?php echo avgReturn($f_2, 20, 'tp_qos'); ?></th>
			<th><?php echo avgReturn($f_2, 20, 'p_qos'); ?></th>
			<th><?php echo avgReturn($f_2, 20, 'P1203'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Clae'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Duanmu'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yin'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yu'); ?></th>
			
		</tr>

		<?php }elseif($j==3){?>
				<tr>
				<th><?php echo $f_3[0]['intExpID']?></th>	
				<th><?php echo getColumn($f_3[0]['intExpID'],'column_name'); ?></th>
				<th><?php echo $n;?></th>
				<th><?php echo getColumn($f_3[0]['intExpID'],'algo'); ?></th>
				<th><?php echo avgReturn($f_3, 20, 'rtt_qos'); ?></th>
				<th><?php echo avgReturn($f_3, 20, 'tp_qos'); ?></th>
				<th><?php echo avgReturn($f_3, 20, 'p_qos'); ?></th>
				<th><?php echo avgReturn($f_3, 20, 'P1203'); ?></th>
				<th><?php echo avgReturn($f_0, 20, 'Clae'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Duanmu'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yin'); ?></th>
			<th><?php echo avgReturn($f_0, 20, 'Yu'); ?></th>
			
				</tr>


		<?php }



	}

}//first for loop for users



}

?>

</table>
</body>
</html>
