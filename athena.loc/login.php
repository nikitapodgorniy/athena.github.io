<?php
header("Content-type: text/html; charset=utf-8");
session_start(); 
//перенаправление на другу страницу
//header("Location: http://123.com/view_cat.php?cat=2");

/*error_reporting(0);
mysql_query("SET NAMES utf8");*/

?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
 <title>Athena</title>
 <link rel="stylesheet" type="text/css" media="all" href="css/style_tmp.css" />
</head>
<body>

<?php
include("blocks/db_conn.php");

if (isset($_POST['login'])) {$login = $_POST['login']; if ($login == '') {unset($login);} }
if (isset($_POST['pass'])) {$pass = $_POST['pass']; if ($pass == '') {unset($pass);} }

if(isset($login) and isset($pass)){
    $result = mysql_query("SELECT * FROM userlist WHERE login='$login'");      
    $myrow = mysql_fetch_array($result);

echo $myrow['login'];
    
    if($pass==$myrow['pass']){
        $_SESSION['user']['№'] = $myrow['№'];
        $_SESSION['user']['login'] = $myrow['login'];
        $_SESSION['user']['flag'] = 'yes';
        if($myrow['status']=='1'){
          $_SESSION['user']['status']='преподаватель';
          ?>
            <script type="text/javascript">
              location.replace("http://localhost/athena.loc/teacher/");
            </script>
          <?
        }
        elseif($myrow['status']=='0'){
          $_SESSION['user']['status']='студент';
          ?>
            <script type="text/javascript">
              location.replace("http://localhost/athena.loc/student/");
            </script>
          <?
        }
    }else{echo "Ошибочка при входе, проверьте правильность введенных данных!";}
}
?>

<div id="account">
 <div id="login" class="innerBox sidebarForm" style="margin:0 auto;width: 350px;margin-top:30px;">
    <form action="login.php" method="post" style="margin:0 auto;width: 250px;">
      <p>
        <span>Телефон или email</span><br>
        <input id="email" required pattern="\S+@[a-z]+.[a-z]+" name="login" maxlength="30">
      </p>        
      <p>
        <br>
        <span>Пароль</span>
        <br>
        <input type="password" name="pass"  maxlength="20">
      </p>
      <br>
      <button type="submit" class="buttonSub">Войти</button>
    </form>
    <div id="recoveryPassword" style="margin-left: 50px;">
      <br>
      <a class="recoveryPassword" href="user.php?login=zabil">Забыли пароль?</a>
    </div>
  </div>
</div>

</body>
</html>