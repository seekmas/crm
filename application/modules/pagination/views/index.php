<?php
echo $this->pagination->create_links();
?>
<ul class="inline">
    <li>Total Count: <?php echo $offset;?> / <?php echo $total;?></li>
    <li>Pages:<?php echo $page;?>/<?php echo ceil($total/$offset)+1;?> </li>
</ul>
