<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>
  </head>
  <body>
<?php
  $book = explode(',',$book);
  foreach ($book as $value) {
    echo $value;
  }
// echo $book;

  $a=explode(',','a,b,c');
  $b='s,e,r';
  $c='e,';
  $a[]=$c;
    ?>
  </body>
</html>