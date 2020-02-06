<!DOCTYPE html>
<?php
$about = "";
$title = "";
$body = "";

if (isset($_POST['send']) === true){
  $about = $_POST['about'];
  $title = $_POST['title'];
  $body = $_POST['body'];
  $fp = fopen("index.txt", "a");
  fwrite($fp, date("Y/m/d")."\t".$about."\t".$title."\t".$body."\n");
  fclose($fp);
}

$fp = fopen("index.txt", "r");

$index_array = [];
while($line = fgets($fp)){
  $temp = explode("\t", $line);
  $temp_array = [
    "date" => $temp[0],
    "about" => $temp[1],
    "title" => $temp[2],
    "body" => $temp[3]
  ];
  $index_array[] = $temp_array;
}
 ?>
<html>
<head>
  <meta charset="utf-8">
  <title>MYSELF</title>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="header">
    <div class="header-logo">Myself <p>自分のための日記</p></div>
  </div>

  <div class="main">
    <div class="form">
      <form method="post" action="index.php">
        <?php
          $category = array('今日の出来事', '本について', '映画について', '貰ったもの');
        ?>
        <select name="about">
          <option value="未選択">選択してください</option>
          <?php foreach($category as $value){
            echo "<option value='$value'>$value</option>";
           }
          ?>
        </select>
        <div class="form-item">タイトル</div>
        <input type='text' name='title'>
        <div class="form-item">内容</div>
        <textarea name='body'></textarea>
        <input type="submit" name="send" value="更新">
      </form>
    </div>
  </div>
  <ul class='form'>
    <?php
    foreach ($index_array as $key) {
      echo "<div class='date_border'>{$key['date']}</div>";
      echo $key['about']."\t".$key['title'].$key['body'];
    }
     ?>
  </ul>
</body>
</html>
