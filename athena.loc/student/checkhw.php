<?php
header("Content-type: text/html; charset=utf-8");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Athena</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/student_css_tmp.css" />
  <script>
window.onload=function(){
     window.scrollTo(0,document.body.scrollHeight);
}

  </script>
</head>
<body>
<div class="db_hide" style="display: none;">
  <?php include("blocks/db_conn.php");?>
</div>
<?php include("blocks/SitebarL_Header.php");?>

<?
if (isset($_POST['message'])) {$message = $_POST['message']; if ($message == '') {unset($message);} }
if (isset($_POST['idHW'])) {$idHW_P = $_POST['idHW']; if ($idHW_P == '') {unset($idHW_P);} }
if (isset($_POST['id'])) {$id_P = $_POST['id']; if ($id_P == '') {unset($id_P);} }




if(isset($message) and isset($idHW_P) and isset($id_P)){
  $res_ins = mysql_query("INSERT INTO `messagehw` (sender,idST,idHW,message) VALUES ('0','$id_P','$idHW_P','$message')");
  if(!$res_ins){echo "Ошибка отправки сообщения.";}
}
?>
  
  <div id="checkhw">
<?php
/*
echo "1".$message."<br>";
echo "2".$idHW_P."<br>";
echo "3".$id_P."<br>";
*/


$name_course='fizika';// ключ 1. вырорка HW
$login=$_SESSION['user']['login'];

$result=mysql_query("SELECT id,idGR from userlist WHERE login='$login'");
$data=mysql_fetch_assoc($result);

$id=$data['id'];
$idGR=$data['idGR'];// ключ 2. вырорка HW
/*echo $id."<br>";
echo $idGR."<br>";*/

$result=mysql_query("SELECT idHW,idTU,theme,descr,link from homework WHERE (idGR='$idGR' and name_course='$name_course')");
$data=mysql_fetch_assoc($result);
/*
echo $data['idHW']."<br>";
echo $data['idPR']."<br>";
echo $data['theme']."<br>";
echo $data['descr']."<br>";
echo $data['link']."<br>";*/
$theme=$data['theme'];
$descr=$data['descr'];
//********************************************************
$idHW=$data['idHW'];//key 1
//$id   key 2

$result=mysql_query("SELECT sender,message,link from messagehw WHERE (idHW='$idHW' and idST='$id')");
$data=mysql_fetch_assoc($result);

?>

<div id="name_discipline">Физика. Герасимов А.Н. ------> д/з на 16.11.2016</div>
<div id="theme"><?php echo $theme;?></div>
<div id="discription_box">
  <div id="discription">
    <?php echo $descr;?>
  </div>
  <div class="clear"></div>
</div>
<?php

do{
  if($data['sender']==0){
  printf("
    <div class='message'>
      <div class='you'>%s</div>
      <div class='clear'></div>
    </div>

  ",$data['message']);
  }
  else{
printf("
    <div class='message'>
      <div class='he'>%s</div>
      <div class='clear'></div>
    </div>

  ",$data['message']);
  }
  /*echo "1".$data['message']."<br>";*/
}
while($data=mysql_fetch_assoc($result));
?>



<div class="input_message">
  <form action="checkhw.php" method="post" style="position:relative;"> 
    <textarea class="text" name="message"></textarea>
    <input type="hidden" name="" value="">
    <?php
      printf("<input type='hidden' name='id' value='%s'>",$id);
      printf("<input type='hidden' name='idHW' value='%s'>",$idHW);
    ?>
    <br>
    <button type="submit" class="buttonSub">Send</button>
  </form>
</div>







<?
/*echo $id = uniqid("");
/*
генерация уникального id в зависимости от текущего времни
echo $better_token = md5(uniqid(rand(),1)); // лучше, труднее взломать*/
?>


  <div id="left"></div>
  <div id="right"></div>
  <div id="centr"></div>
  <div id="footer"></div>
  <div id="element"></div>
</body>
</html>