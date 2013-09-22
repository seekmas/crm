       <h3>省市-Province </h3>
<form class="form-inline" action="" method="post">
<input type="hidden" name="country" value="1" />
添加
    中国 <input name="province" type="text" placeholder="Type something…">
<button name="create_item" class="btn  btn-primary" type="submit" value="1">确定</button>
</form>

<table class="table table-striped">
        <tbody>
        	<tr>
            	<th>ID</th>
            	<th>国家</th>
                <th>省市 -Province</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $province) {?>
            <tr>
                <td><?php echo $province['id']?></td>
                <td>中国</td>
                <td><?php echo $province['province'];?></td>
                <td><a class="btn btn-mini" href="<?php echo site_url('setting/'.$action.'/del_item/'.$province['id']);?>">删除 Remove</a></td>
            </tr>  
            <?php }?>
        </tbody>
</table>