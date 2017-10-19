<?php
header("Content-type: text/html; charset=utf-8");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Athena</title>
  <link rel="stylesheet" type="text/css" media="all" href="css/teacher_css_tmp.css" />
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
$login=$_SESSION['user']['login'];
//echo "s=".$login;
$result=mysql_query("SELECT id from userlist WHERE login='$login'");
$data=mysql_fetch_assoc($result);
$idTU=$data['id'];
//echo $idTU;

if (isset($_GET['id'])) {$id = $_GET['id']; if ($id == '') {unset($id);} }
if (isset($_GET['idCO'])) {$idCO = $_GET['idCO']; if ($idCO == '') {unset($idCO);} }

if(isset($id) and isset($idCO)){
  include("blocks/messageHW.php");
}
else{
  ?>
    <div class='groupe_box'>
  <?
    if (isset($_GET['group'])) {$group = $_GET['group']; if ($group == '') {unset($group);} }
    if(isset($group)){
      if (isset($_GET['course'])) {$course = $_GET['course']; if ($course == '') {unset($course);} }
      if(isset($course)){

      $result=mysql_query("SELECT * from homework WHERE (idTU='$idTU' and idCO='$course' and idGR='$group') ORDER BY deadline");
      $data=mysql_fetch_assoc($result);
      /*echo "<h1>".$data['idHW']."</h1>";*/
      if($data['idHW']==''){
        echo "<p style='color:black;padding-left:20px;'><br>Вы еще не создали задания этой группе по этому предмету.</p>";
      }
      else{
        $result=mysql_query("SELECT * from userlist WHERE idGR='$group' ORDER BY last_name");
        $data=mysql_fetch_assoc($result);
        printf("<div class='title'>Выберите студента</div>");
        $i=1;
        do{
          $fio=$data['last_name']." ".$data['first_name']." ".$data['middle_name'];
          printf("<div class='group_list'>%s <a href='?id=%s&idCO=%s'> %s</a></div>",$i,$data['id'],$course,$fio);
          $i++;
        }
        while ($data=mysql_fetch_assoc($result));
      }
    }
    else{
      echo "<div class='title'>Выберите предмет</div>";
      $result=mysql_query("SELECT * from courses WHERE (idGR='$group' and idTU='$idTU') ORDER BY name_course");
      $data=mysql_fetch_assoc($result);
      do{
        printf("<div class='group'><a href='?group=%s&course=%s'>%s</a></div>",$group,$data['idCO'],$data['name_course']);
      }
      while($data=mysql_fetch_assoc($result));
      echo "<div class='clear'></div>";
    }
  }
  else{
    /*$result=mysql_query("SELECT * from userlist WHERE idGR='$group' ORDER BY last_name");
      $data=mysql_fetch_assoc($result);
      //добавить выборку групп из базы
      */
    printf("
        <div class='title'>Выберите группу</div>
        <div class='group'><a href=''>2.1 САУ</a></div>
        <div class='group'><a href='?group=5843566489b19'>3.1 САУ</a></div>
        <div class='group'><a href=''>4.1 САУ</a></div>
        <div class='clear'></div>
    ");
  }
}
?>
  </div>









  <div id="left"></div>
  <div id="right"></div>
  <div id="centr"></div>
  <div id="footer"></div>
  <div id="element"></div>
</body>
</html>