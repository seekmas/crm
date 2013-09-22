<h3>国家 - Country </h3>

<form class="form-inline" action="" method="post">        
添加  
    <input name="<?php echo $action;?>" class="span8" type="text" placeholder="添加你想要的条目 some item's name you want"> 
    <button name="create_item" class="btn btn-primary" type="submit" value="1">确定</button>
</form>

      	<table class="table table-striped">
        <tbody>
        	<tr>
            	<th>ID</th>
                <th>国家 - Country </th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $country) {?>
            <tr>
                <td><?php echo $country['cid'];?></td>
                <td><?php echo $country['country'];?></td>
                <td><a class="btn btn-mini" href="<?php echo site_url('setting/'.$action.'/del_item/'.$country['cid']);?>">删除 Remove</a></td>
            </tr>           
            <?php }?>
        </tbody>
   		</table>