<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url(''); ?>">Home</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php echo $page == 'shop' ? 'active' : '' ; ?>"><a href="<?php echo site_url('welcome/shop');?>">Shop</a></li>
        <li class="<?php echo $page == 'shopcar' ? 'active' : '' ; ?>"><a href="<?php echo site_url('welcome/shopcar');?>">Shopcar</a></li>
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->
      <ul class="nav navbar-nav navbar-right">
        <?php if( ! $login ){ ?>
        <!-- <li><a href="#">Login</a></li> -->
        <li><a href="<?php echo site_url('welcome/register');?>">Register</a></li>
        <?php }else{?>

        <li><a href="<?php echo site_url('welcome/logout');?>">Logout</a></li>

        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>