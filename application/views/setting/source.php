    <h3>来源 - Source</h3>
    <form class="form-inline" action="" method="post">
    添加 
        <input class="span8" name="<?php echo $action;?>" type="text" placeholder="添加你想要的条目 some item's name you want"/> 
        <button name="create_item" class="btn btn-primary" type="submit" value="1">确定</button>
    </form>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th>ID</th><th>来源-Source</th><th>操作</th>
            </tr>
            <?php foreach ($list as $source) {?>

            <tr>
                <td><?php echo $source['sid']?></td>
                <td><?php echo $source['source']?></td>
                <td><a href="<?php echo site_url('setting/'.$action.'/del_item/'.$source['sid'])?>" class="btn btn-mini">删除 Remove</a></td>
            </tr>
        
            <?php }?>
        </tbody>
    </table>
