<?php

require_once('funcs.php');
$pdo = db_conn();

//1.  DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=kadai_db;charset=utf8;host=localhost','root','root');
// } catch (PDOException $e) {
//   exit('DBConnectError'.$e->getMessage());
// }

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status == false) {
  sql_error($status);
} else {
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
      //GETデータ送信リンク作成
      // <a>で囲う。
      $view .= '<p>';
      // 詳細ページリンク
      $view .= '<a href="bm_update.php?id=' . $result['id'] . '">';
      $view .= $result["indate"] . "：" . $result["title"];
      $view .= '</a>';
      // 削除ページリンク
      $view .= '<a href="delete.php?id=' . $result['id'] . '">';
      $view .= '【削除】';
      $view .= '</a>';
      $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>本のブックマーク</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bm_list_view.php">データ登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?= $view ?></div>
</div>
<!-- Main[End] -->

</body>
</html>