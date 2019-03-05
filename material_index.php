<?php
    $qrecord = "SELECT * FROM `t_tea_material`";
    $rrecord = mysqli_query($konek, $qrecord);
    $no=1;
    while($rwrecord = mysqli_fetch_array($rrecord))
    {
?>

<?php
	echo "	<div class='inbox-status'>
			    <ul class='inbox-st-nav inbox-ft'>
			        <li><a href='tea.php?id=".$rwrecord['id']."'><i class='notika-icon'>🍵</i>".$rwrecord['name']."</a></li>
			    </ul>
			</div>";
?>

<?php } ?>