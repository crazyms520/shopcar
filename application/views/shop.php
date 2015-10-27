<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Shop</title>
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
    <?php if ($message = $this->session->flashdata('message')){?>
      <div class='alert alert-info'><?php echo $message;?></div>
    <?php } ?>

    <?php foreach ($books as $book) {?>
    <form action='<?php echo site_url('welcome/shop_post'); ?>' method='post'>
    <div class="row-inline">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img src="<?php echo base_url('images/book.jpeg');?>" alt="book">
          <div class="caption">
            <h3><?php echo $book->name;?></h3>
            <h4>建議售價：<?php echo $book->price ;?></h4>
              <input type='hidden' name='book_name' value="<?php echo $book->name;?>">
              <input type='hidden' name='book_price' value="<?php echo $book->price;?>">
              <input type='text' name='quantity' value='1' placeholder='請輸入數量'>
              <button class="btn btn-default" role="button">放入購物車</button>


          </div>
        </div>
      </div>
    </div>
    </form>
    <?php } ?>
  </div>
</body>
</html>