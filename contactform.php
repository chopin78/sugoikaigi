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
  if (!$_POST['mail']) {
    $errmessage[] = "メールアカウントを入力してください";
  } else if (mb_strlen($_POST['mail']) > 200) {
    $errmessage[] = "メールアドレスは200文字以内にしてください";
  } else if (!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
    $errmessage[] = "メールアドレスが不正です";
  }
  $_SESSION['mail']  = htmlspecialchars($_POST['mail'], ENT_QUOTES);

  $_SESSION['sex']      =  htmlspecialchars($_POST['sex'], ENT_QUOTES);
  $_SESSION['day']      = htmlspecialchars($_POST['day'], ENT_QUOTES);
  $_SESSION['day1']     = htmlspecialchars($_POST['day1'], ENT_QUOTES);
  $_SESSION['day2']     = htmlspecialchars($_POST['day2'], ENT_QUOTES);
  $_SESSION['address']  = htmlspecialchars($_POST['address'], ENT_QUOTES);
  $_SESSION['tel']      = htmlspecialchars($_POST['tel'], ENT_QUOTES);

  if (!$_POST['message']) {
    $errmessage[] = "学歴・職歴を入力してください";
  } else if (mb_strlen($_POST['message']) > 500) {
    $errmessage[] = "学歴・職歴は500文字以内にしてください";
  }
  $_SESSION['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);

  if ($errmessage) {
    $mode = 'input';
  } else {
    $mode = 'confirm';
  }
} else if (isset($_POST['send']) && $_POST['send']) {
  // 送信ボタンを押したとき
  $message  = "お問い合わせを受け付けました \r\n"
    . "名前: " . $_SESSION['name'] . "\r\n"
    . "ふりがな: " . $_SESSION['fullname'] . "\r\n"
    . "email: " . $_SESSION['mail'] . "\r\n"
    . "性別: " . $_SESSION['sex'] . "\r\n"
    . "年: " . $_SESSION['day'] . "\r\n"
    . "月: " . $_SESSION['day1'] . "\r\n"
    . "日: " . $_SESSION['day2'] . "\r\n"
    . "住所: " . $_SESSION['address'] . "\r\n"
    . "電話番号: " . $_SESSION['tel'] . "\r\n"
    . "学歴・職歴:\r\n"
    . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
  mail($_SESSION['mail'], 'お問い合わせありがとうございます', $message);
  mail('ikimon445sugoi@gmail.com', 'お問い合わせありがとうございます', $message);
  $_SESSION = array();
  $mode = 'send';
} else {
  $_SESSION['name']     = "";
  $_SESSION['fullname'] = "";
  $_SESSION['mail']     = "";
  $_SESSION['sex']      = "";
  $_SESSION['day']      = "";
  $_SESSION['day1']     = "";
  $_SESSION['day2']     = "";
  $_SESSION['address']  = "";
  $_SESSION['tel']     = "";
  $_SESSION['message']  = "";
}
?>




<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

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
  <!-- へッダー -->

  <header id="header">
    <div id="header-fixed">
      <div class="logo-box">
        <h1 class="logo"><a href="index.html"><img src="img/headder.png" alt="すごい会議どすえ 採用サイト"></a></h1>
      </div>
      <div class="logo-box_sp">
        <h1 class="logo"><a href="index.html"><img src="img_sp/header.png" alt="すごい会議どすえ 採用サイト"></a></h1>
      </div>
      <div class="entry-box"><a href="form.html"><img src="img/EVTRY.png" alt=""></a></div>
    </div>
    <div class="entry-sp"><a href="form.html"><img src="img_sp/ENTRY.png" alt=""></a></div>

    <!-- ハンバーガー -->


    <div class="el_humburger">
      <div class="el_humburger_wrapper">
        <span class="el_humburger_bar top1"></span>
        <span class="el_humburger_bar middle"></span>
        <span class="el_humburger_bar bottom"></span>
      </div>
    </div>

    <header class="navi">
      <div class="navi_inner">
        <div class="navi_text">
          <div class="navi_item">Top</div>
          <div class="navi_item">
            <a href="#s_message">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;採用メッセージ</a><br>
            <a href="#human">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;求める人材</a></div>
        </div>
        <hr width="80%">
        <div class="navi_text">
          <div class="navi_item">About</div>
          <div class="navi_item">
            <a href="#about">&nbsp;&nbsp;&nbsp;&nbsp;すごい会議とは</a></div>
        </div>
        <hr width="80%">
        <div class="navi_text" class="navi_text">
          <div class="navi_item">Work</div>
          <div class="navi_item">
            <a href="#work4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;コーチングとは</a><br>
            <a href="#performance">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;・実績</a></div>
        </div>
        <hr width="80%">
        <div class="navi_text">
          <div class="navi_item">Message</div>
          <div class="navi_item"><a href="#message">代表メッセージ</a></div>
        </div>
        <hr width="80%">
        <div class="navi_text">
          <div class="navi_item">Recruit</div>
          <div class="navi_item"><a href="#recruit">&nbsp;&nbsp;&nbsp;採用について</a><br>
            <a href="#recruit_1">&nbsp;&nbsp;&nbsp;・募集要項</a><br>
            <a href="#recruit_2">&nbsp;&nbsp;&nbsp;・選考フロー</a></div>
        </div>
        <div class="nav_sns">
          <a href="https://twitter.com/dosue_info"><img class="tw navi_item nav_sns" src="img/twitter.png" alt="Twitter" width="28px" height="auto"></a>
          <a href="https://www.facebook.com/%E3%81%99%E3%81%94%E3%81%84%E4%BC%9A%E8%AD%B0%E3%81%A9%E3%81%99%E3%81%88-240519449638756/"><img class="navi_item nav_sns" src="img/fb.png" alt="Facebook" width="25px" height="auto"></a>
        </div>


      </div>




      <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>



    </header>




    <?php if ($mode == 'input') { ?>

      <!-- 入力画面 -->

      <form action="./contactform.php" method="post">
        <div class="form">

          <h2>エントリーフォーム</h2>

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

              <input type="text" class="Form-Item-Input" required name="name" value="<?php echo (htmlspecialchars( $_SESSION['name'] ))?>">
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label">ふりがな<span>*</span></p>
              <input name="fullname" type="text" class="Form-Item-Input" required value="<?php echo (htmlspecialchars($_SESSION['fullname'])) ?>">
            </div>
            <div class="Form-Item">
              <p class="Form-Item-Label">メールアドレス<span>*</span></p>
              <input name="mail" type="email" class="Form-Item-Input" required value="<?php echo (htmlspecialchars($_SESSION['mail'])) ?>">
            </div>

            <div class="Form-Item">
              <label class="Form-Item-Label">性別<span></span></label>
              <div class="md-radio">
                <input type="radio" name="sex" value="男性" style="transform:scale(1.5);" value="<?php echo (htmlspecialchars($_SESSION['sex'] ))?>"> &nbsp;男性
              </div>
              <div class="md-radio2">
                <input type="radio" name="sex" value="女性" style="transform:scale(1.5);" value="<?php echo (htmlspecialchars( $_SESSION['sex'] ))?>"> &nbsp;女性
              </div>
            </div>

            <form name="yyyymmdd" method="post" action="#" class="globalMenuSp">

              <div class="Form-Item">
                <p class="Form-Item-Label">
                  生年月日
                </p>



                <div class="cp_ipselect cp_sl01 CP">
                  <select name="day" required value="<?php echo (htmlspecialchars($_SESSION['day'] ))?>">
                    <option value="" hidden>年</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                    <option value="1967">1967</option>
                    <option value="1968">1968</option>
                    <option value="1969">1969</option>
                    <option value="1970">1970</option>
                    <option value="1971">1971</option>
                    <option value="1972">1972</option>
                    <option value="1973">1973</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>

                  </select>
                </div>


                <div class="cp_ipselect cp_sl01">
                  <select name="day1" required value="<?php echo (htmlspecialchars($_SESSION['day1'] ))?>">
                    <option value="" hidden>月</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </div>

                <div class="cp_ipselect cp_sl01">
                  <select name="day2" required value="<?php echo (htmlspecialchars($_SESSION['day'] ))?>">
                    <option value="" hidden>日</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                  </select>
                </div>
              </div>




              <div class="Form-Item">
                <p class="Form-Item-Label">住所</p>
                <input type="text" class="Form-Item-Input" name="address" value="<?php echo (htmlspecialchars($_SESSION['address'])) ?>">
              </div>
              <div class="Form-Item">
                <p class="Form-Item-Label">電話番号</p>
                <input type="tel" class="Form-Item-Input" name="tell" value="<?php echo (htmlspecialchars($_SESSION['tel'])) ?>">
              </div>
              <div class="Form-Item">
                <p class="Form-Item-Label isMsg">学歴・職歴
                </p>
                <textarea class="Form-Item-Textarea" name="message"><?php echo (htmlspecialchars($_SESSION['message'] ))?></textarea>
              </div>
              <input type="submit" class="Form-Btn" name="confirm" value="入力内容を確認する">
          </div>

      </form>

    <?php } else if ($mode == 'confirm') { ?>


      <!-- 確認画面 -->
      <form class="send" action="./contactform.php" method="post">
        名前 <?php echo (htmlspecialchars($_SESSION['name'])) ?><br>
        ふりがな <?php echo (htmlspecialchars( $_SESSION['fullname'] ))?><br>
        メールアドレス <?php echo (htmlspecialchars($_SESSION['mail'])) ?><br>
        性別 <?php echo (htmlspecialchars($_SESSION['sex'] ))?><br>
        年 <?php echo (htmlspecialchars($_SESSION['day'] ))?><br>
        月<?php echo (htmlspecialchars($_SESSION['day1'])) ?><br>
        日 <?php echo (htmlspecialchars($_SESSION['day2'])) ?><br>
        住所 <?php echo (htmlspecialchars($_SESSION['address'])) ?><br>
        電話番号 <?php echo (htmlspecialchars($_SESSION['tel'])) ?><br>
        学歴・職歴 <?php echo (htmlspecialchars(nl2br($_SESSION['message']))) ?><br>
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






    </div> <!-- フッター -->

    <footer>
      <!-- to Top -->
      <div class="footer">　

        <div class="top">
          <p class="toTop"><a href="#top">PAGE TOP</p>
          <span></span>
          </a>
        </div>



        <nav class="footernav">
          <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#work4">Work</a></li>
            <li><a href="#message">Message</a></li>
            <li><a href="#recruit">Recruit</a></li>
          </ul>
        </nav>


        <div class="follow">
          <p> FOLLOW US</p>
          <div class="sns">
            <a href="https://twitter.com/dosue_info"><img class="tw" src="img/twitter.png" alt="Twitter" width="23px" height="auto"></a>
            <a href="https://www.facebook.com/%E3%81%99%E3%81%94%E3%81%84%E4%BC%9A%E8%AD%B0%E3%81%A9%E3%81%99%E3%81%88-240519449638756/"><img src="img/fb.png" alt="Facebook" width="20px" height="auto"></a>
          </div>
        </div>


        <div class="small">

          <a class="hp" href="https://sugoikaigidosue.jp/">すごい会議どすえ</a>


          <p>COPYRIGHT&copy; すごい会議どすえ RIGHTS RESERVED. </p>

        </div>
      </div>

      <div class="footer_sp">

        <div class="top_for top_sp">
          <p class="toTop"><a href="#top">PAGE TOP</p>
          <span></span>
          </a>
        </div>
        <nav class="footernav_sp">
          <ul>
            <li><a href="#about">About</a></li>
            <li><a href="#work4">Work</a></li>
            <li><a href=”#message”>Message</a></li>
            <li><a href="#recruit">Recruit</a></li>
          </ul>
        </nav>


        <div class="follow_sp">
          <p> FOLLOW US</p>
          <div class="sns">
            <a href="https://twitter.com/dosue_info"><img class="tw" src="img/twitter.png" alt="Twitter" width="23px" height="auto"></a>
            <a href="https://www.facebook.com/%E3%81%99%E3%81%94%E3%81%84%E4%BC%9A%E8%AD%B0%E3%81%A9%E3%81%99%E3%81%88-240519449638756/"><img src="img/fb.png" alt="Facebook" width="20px" height="auto"></a>
          </div>
        </div>
        <div class="small_sp">

          <a href="https://sugoikaigidosue.jp/">すごい会議どすえ</a>


          <p>COPYRIGHT&copy; すごい会議どすえ RIGHTS RESERVED. </p>



        </div>
      </div>

    </footer>

    </div>




</body>

</html>