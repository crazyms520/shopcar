<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home</title>
	<!-- 最新編譯和最佳化的 CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- 選擇性佈景主題 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- 最新編譯和最佳化的 JavaScript -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<style type="text/css">
	body{
		padding-top: 70px;
	}
	</style>
</head>
<body>
	<?php echo $navbar ; ?>


	<div class='container'>
		<?php if($message = $this->session->flashdata('message')){?>
			<div class='alert alert-info'><?php echo $message; ?></div>
		<?php } ?>
		<div class="row">
		  <div class="col-md-4"></div>
		  <div class="col-md-4">
		  	<?php if($login){ ?>
		  		<div class="page-header">
					  <h1>首頁<small>購物車練習</small></h1>
					</div>
					<div class='text-left'>
						<?php echo 'Hi！'.$user->name.' 歡迎回來'; ?>
					</div>
		  	<?php }else{ ?>
		  		<div class="page-header">
					  <h1>首頁<small>購物車練習</small></h1>
					</div>
					<div class='text-left'>
					</div>
		  	<form role="form" action='<?php echo site_url('welcome/login'); ?>' method='post'>
				  <div class="form-group">
				    <label for="account">帳號</label>
				    <input type="text" class="form-control" name='account' id="account" placeholder="輸入帳號">
				  </div>
				  <div class="form-group">
				    <label for="Password">密碼</label>
				    <input type="password" class="form-control" name='password' id="password" placeholder="輸入密碼">
				  </div>
				  <div class="form-group text-right">
				  	<button type="submit" class="btn btn-default">送出</button>
				  </div>
				</form>
		  </div>
		  <?php } ?>
		  <div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>