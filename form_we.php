<?php
session_start();
$mode = 'input';
$errmessage = array();
if (isset($_POST['back']) && $_POST['back']) {
  // 何もしない
} else if (isset($_POST['confirm']) && $_POST['confirm']) {
// 確認画面
if (!$_POST['name']) {
  $errmessage[] = "名前を入力してください";
} else if (mb_strlen($_POST['name']) > 100) {
  $errmessage[] = "名前は100文字以内にしてください";
}
$_SESSION['name']  = htmlspecialchars($_POST['name'], ENT_QUOTES);
if (!$_POST['fullname']) {
  $errmessage[] = "名前を入力してください";
} else if (mb_strlen($_POST['fullname']) > 100) {
  $errmessage[] = "名前は100文字以内にしてください";
}
$_SESSION['fullname']  = htmlspecialchars($_POST['fullname'], ENT_QUOTES);

  $_SESSION['co']     = $_POST['co'];
  $_SESSION['position']      = $_POST['position'];
  if (!$_POST['mail']) {
    $errmessage[] = "メールアドレスを入力してください";
  } else if (mb_strlen($_POST['mail']) > 200) {
    $errmessage[] = "メールアドレスは200文字以内にしてください";
  } else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    $errmessage[] = "メールアドレスが不正です";
  }
  $_SESSION['mail']  = htmlspecialchars($_POST['mail'], ENT_QUOTES);
  
  $_SESSION['tel']     = htmlspecialchars($_POST['tel'], ENT_QUOTES);
  $_SESSION['radio']  = htmlspecialchars($_POST['radio'], ENT_QUOTES);
  $mode = 'confirm';
} else if (isset($_POST['send']) && $_POST['send']) {
  // 送信ボタンを押したとき
  $message  = "お問い合わせを受け付けました \r\n"
    . "名前: " . $_SESSION['name'] . "\r\n"
    . "ふりがな: " . $_SESSION['fullname'] . "\r\n"
    . "会社名: " . $_SESSION['co'] . "\r\n"
    . "役職: " . $_SESSION['position'] . "\r\n"
    . "メール: " . $_SESSION['mail'] . "\r\n"
    . "電話番号: " . $_SESSION['tel'] . "\r\n"
    . "ご希望日時: " . $_SESSION['radio'] . "\r\n";
  mail($_SESSION['mail'], 'お問い合わせありがとうございます', $message);
  mail('ikimon445sugoi@gmail.com', 'お問い合わせありがとうございます', $message);
  session_destroy();
  $mode = 'send';
} else {
  $_SESSION['name']     = "";
  $_SESSION['fullname'] = "";
  $_SESSION['co']     = "";
  $_SESSION['position']      = "";
  $_SESSION['mail']      = "";
  $_SESSION['tel']     = "";
  $_SESSION['radio']  = "";
}
?>





<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>すごい会議どすえ　採用サイト</title>
  <link rel="icon" type="image/x-icon" href="img/favicon.jpg">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/sp.css">

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/vivus/0.4.4/vivus.min.js" type="text/javascript"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>


  <?php if ($mode == 'input') { ?>

    <!-- 入力画面 -->

    <form action="./form_we.php" method="post">

      <div class="form f_we">

        <h2>ウェビナー募集フォーム</h2>

        <div class="Form">
          <div class="Form-Item">
          <?php
              if ($errmessage) {
                echo '<div style="color:red;">';
                echo implode('<br>', $errmessage);
                echo '</div>';
              }
              ?>


            <p class="Form-Item-Label label">
              名前<span>*</span>
            </p>

            <input type="text" class="Form-Item-Input" required name="name" value="<?php echo (htmlspecialchars($_SESSION['name'])) ?>">
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label">ふりがな<span>*</span></p>
            <input name="fullname" type="text" class="Form-Item-Input" required value="<?php echo (htmlspecialchars($_SESSION['fullname'])) ?>">
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label">会社名</p>
            <input name="co" type="text" class="Form-Item-Input" required value="<?php echo (htmlspecialchars($_SESSION['co'] ))?>">
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label">役職</p>
            <input name="position" type="text" class="Form-Item-Input" required value="<?php echo (htmlspecialchars($_SESSION['position'])) ?>">
          </div>
          <div class="Form-Item">
            <p class="Form-Item-Label">メールアドレス<span>*</span></p>
            <input name="mail" type="email" class="Form-Item-Input" required value="<?php echo (htmlspecialchars($_SESSION['mail'] ))?>">
          </div>


          <div class="Form-Item">
            <p class="Form-Item-Label">電話番号</p>
            <input type="tel" class="Form-Item-Input" name="tel" required value="<?php echo (htmlspecialchars($_SESSION['tel'])) ?>">
          </div>


          <div class="Form-Item">
            <label class="Form-Item-Label"><span></span>ご希望日時</label>

            <div>
              <div class="check">
                <label>
                  <input type="checkbox" name="radio[]" value="&nbsp;10月&nbsp;&nbsp;7日（水）16:00~18:00" />
                  &nbsp;10月&nbsp;&nbsp;7日（水）16:00~18:00
                </label>
              </div>

              <div class="check">
                <label>
                  <input type="checkbox" name="radio[]" value="&nbsp;10月14日（水）17:00~19:00">
                  &nbsp;10月14日（水）17:00~19:00
                </label>
              </div>

              <input type="submit" class="Form-Btn" name="confirm" value="入力内容を確認する">
            </div>

          </div>

          </from>

        <?php } else if ($mode == 'confirm') { ?>


          <!-- 確認画面 -->
          <form class="send" action="./form_we.php" method="post">
            名前 <?php echo $_SESSION['name'] ?><br>
            ふりがな <?php echo $_SESSION['fullname'] ?><br>
            会社名 <?php echo $_SESSION['co'] ?><br>
            役職 <?php echo $_SESSION['position'] ?><br>
            メールアドレス <?php echo $_SESSION['mail'] ?><br>
            電話番号 <?php echo $_SESSION['tel'] ?><br>
            ご希望日時：<?php foreach($_SESSION['radio'] as $value) { ?>
              <?= htmlspecialchars($value) ?>
            <?php } ?>
            <br>

            <input class="Form-Btn send_btn" type="submit" name="back" value="戻る" />
            <input class="Form-Btn send_btn" type="submit" name="send" value="送信" />

          </form>

        <?php } else { ?>

          <!-- 完了画面 -->
          <br>
          <br>
          送信しました。ご応募ありがとうございます。
          <br>
          <br>
        <?php } ?>






</body>

</html>