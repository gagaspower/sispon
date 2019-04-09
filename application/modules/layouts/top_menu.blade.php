<nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
          <?php
          $ci = &get_instance();
          if($ci->session->userdata('is_logged_in') && $ci->session->userdata('email')){ ?>
            <a href="<?php echo base_url('dashboard');?>" class="navbar-brand"><b>SISPON</b></a>
          <?php }else{ ?>
            <a href="<?php echo base_url();?>" class="navbar-brand"><b>SISPON</b></a>
          <?php } ?>
          
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <?php
            $ci = &get_instance();
            if($ci->session->userdata('komunitas_id') == 0  && $ci->session->userdata('role') == 1){
            $main_menu = $ci->db->get_where('tbl_menu', array('parent_id' => 0,'menu_role_id'=> '1'));
            foreach ($main_menu->result() as $main) {
                $sub_menu = $ci->db->get_where('tbl_menu', array('parent_id' => $main->id));
                if ($sub_menu->num_rows() > 0) { ?>
                <li class="dropdown">
                    <a href="<?php echo base_url($main->link_menu);?>" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="<?php echo $main->icon_menu;?>"></i> <?php echo $main->nama_menu; ?> 
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                      <?php  foreach ($sub_menu->result() as $sub) { ?>
                      <li><a href="<?php echo base_url($sub->link_menu);?>"><i class="<?php echo $sub->icon_menu;?>"></i>  <?php echo $sub->nama_menu; ?></a></li>
                      <?php } ?>
                    </ul>
                  </li>
                 <?php } else { ?>
                  <li><a href="<?php echo base_url($main->link_menu);?>"><i class="<?php echo $main->icon_menu;?>"></i>  <?php echo $main->nama_menu; ?></a></li>
                  <?php
                }
            }
          }if( $ci->session->userdata('role') == 2){
            $main_menu = $ci->db->get_where('tbl_menu', array('parent_id' => 0,'menu_role_id'=> '2'));
            foreach ($main_menu->result() as $main) {
                $sub_menu = $ci->db->get_where('tbl_menu', array('parent_id' => $main->id));
                if ($sub_menu->num_rows() > 0) { ?>
                <li class="dropdown">
                    <a href="<?php echo base_url($main->link_menu);?>" class="dropdown-toggle" data-toggle="dropdown">
                      <i class="<?php echo $main->icon_menu;?>"></i> <?php echo $main->nama_menu; ?> 
                      <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                      <?php  foreach ($sub_menu->result() as $sub) { ?>
                      <li><a href="<?php echo base_url($sub->link_menu);?>"><i class="<?php echo $sub->icon_menu;?>"></i>  <?php echo $sub->nama_menu; ?></a></li>
                      <?php } ?>
                    </ul>
                  </li>
                 <?php } else { ?>
                  <li><a href="<?php echo base_url($main->link_menu);?>"><i class="<?php echo $main->icon_menu;?>"></i>  <?php echo $main->nama_menu; ?></a></li>
                  <?php
                }
            }
          }
            ?>
        </ul>
      </div>
      <!-- Navbar Right Menu -->
        <?php
        $ci = &get_instance();
          if($ci->session->userdata('is_logged_in') && $ci->session->userdata('email')){ ?>
            <div class="navbar-custom-menu">
              <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url('komunitas/logout');?>"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </div>
          <?php } ?>
    </div>
  </nav>
</header>