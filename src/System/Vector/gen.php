<?php
for($i=0;$i<4;$i++) for($j=0;$j<4;$j++) {
?>
$vector->array[<?= $i * 4 + $j ?>] = $a<?= $i ?><?= $j ?>;
<?php
}