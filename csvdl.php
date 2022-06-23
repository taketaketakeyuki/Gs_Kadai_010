<?php
  $mode = $_POST["mode"];

  if ($mode == "output") {
    $filepath = 'data/data.csv';
    $dldate = date("Ymd");
    header("Content-Type: application/octet-stream");
    header('Content-Length: '.filesize($filepath));
    header("Content-Disposition: attachment; filename=CSVデータ一覧_{$dldate}.csv");
  
  // 変数の初期化
  $allsjss = array();
  $csv = null;
  
  // 1行目のラベルを作成
  $csv = '"DB番号", 登録タイトル, youtubeURL, 登録タイミング' . "\n";
  $csv = mb_convert_encoding($csv, "SJIS", "utf8");// SJSS変換
  $stmt2 = $pdo->prepare("SELECT * FROM gs_yt_table WHERE unread = 0 AND loginID =  $loginID ");// DB取得
  $status2 = $stmt2->execute();// まじない
  $all = $stmt2->fetchAll(PDO::FETCH_ASSOC);// DBにふぇっち
  $allsjss = mb_convert_encoding($all, "SJIS", "utf8");// SJSS変換
  foreach ($allsjss as $value) {
    $csv .= '"' . $value['id'] . '","' . $value['title'] . '","' . 'https://www.youtube.com/watch?v=' . $value['URL'] . '","' . $value['date'] . '"' . "\n";
  }
  // CSVファイル出力
  echo $csv;
  return;
  }

    //５．index.phpへリダイレクト

    header('Location: index.php');
    //リダイレクト処理
?>