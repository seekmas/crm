<h3>产品-Product </h3>

<form class="form-inline" action="" method="post">
<input type="hidden" name="createDate" value="<?php echo date('m/d/Y h:i:s');?>">
添加
<div class="input-prepend"><span class="add-on">产品类别</span><input class="span4" name="categoryname" type="text" placeholder="Type something…"></div> 
<div class="input-prepend"><span class="add-on">Logogram</span><input class="span4" name="logogram" type="text" placeholder="Type something…"></div>
<button name="create_item" class="btn btn-primary" type="submit" value="1">确定</button>
</form>

      	<table class="table table-striped">
        <tbody>
        	<tr>
            	<th>ID</th>
                <th>Product Category</th>
                <th>Logogram</th>
                <th>操作</th>
            </tr>
            <?php foreach ($list as $category) {?>
            <tr>
                <td><?php echo $category['categoryId'];?></td>
                <td><?php echo $category['categoryname'];?></td>
                <td><?php echo $category['logogram'];?></td>
                <td><a href="<?php echo site_url('setting/remove/'.$action.'/'.$category['categoryId'].'/categoryId');?>" class="btn btn-mini">删除</button></td>
            </tr>  
            <?php }?>
         
        </tbody>
   		</table>