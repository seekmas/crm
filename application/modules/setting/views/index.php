      <div class="row-fluid nav">
       <div class="span3 pull-left">
            <ul class="nav nav-list">
              <li class="nav-header">系统设置</li>
              <li <?php if( 'industry' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/industry');?>">行业-Industry</a></li>
              <li <?php if( 'source' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/source');?>">来源-Source</a></li>
              <li <?php if( 'country' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/country');?>">国家-Country</a></li>
              <li <?php if( 'province' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/province');?>">省市-Province</a></li>
              <li <?php if( 'level' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/level');?>">级别-Level</a></li>
            </ul>
        </div>
        
                
        <div class="span3 pull-left">
            <ul class="nav nav-list">
              <li class="nav-header">销售机会</li>
              <li <?php if( 'stage' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/stage');?>">销售阶段-Sales Stage</a></li>
              <li <?php if( 'category' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/category');?>">产品-Product</a></li>
            </ul>
       </div>
       
        <div class="span3 pull-left">
            <ul class="nav nav-list">
              <li class="nav-header">用户设置</li>
              <li <?php if( 'user' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/user');?>">用户列表-User List</a></li>
              <li <?php if( 'group' === $action) {?>class="active"<?php }?>><a href="<?php echo site_url('setting/group');?>">用户组-User group</a></li>
               <li <?php if( 'edit_user' === $action) {?>class="active"<?php }?>><a href="#">编辑用户-Edit group</a></li>
            </ul>
       </div>
      </div>
<hr/>