<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Shopcar</title>
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
  <?php echo $navbar; ?>
  <div class='container'>
    <?php $total = 0 ;?>
    <table class="table table-striped">
      <tr><td colspan='3' align="center">訂單明細</td></tr>
      <tr><th>書名</th><th>數量</th><th>價格</th></tr>
      <?php for ($i=0; $i < count($books); $i++) { ?>
      <?php if($books[$i]){ ?>
        <tr><td><?php echo $books[$i] ;?></td><td><?php echo $quantitys[$i] ;?></td><td><?php echo $prices[$i] ;?></td></tr>
      <?php } $total += $prices[$i]; } ?>
      <tr><th></th><th></th><th>小計</th></tr>
      <tr><th></th><th></th><th><?php echo $total ;?></th></tr>
    </table>

  </div>
</body>
</html>