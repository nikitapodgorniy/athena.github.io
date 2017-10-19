<div id="sitebarL"><div id="logo">Athena</div>
    <div id="list">
      <div class="stl"><a href="index.php">Главная <span>&#8250;</a></span></div>
      <div class="stl"><a href="analitics.php">Статистика <span>&#8250;</a></span></div>
      <div class="stl"><a href="dz.php">Домашниее задание <span>&#8250;</a></span></div>
      <div class="stl"><a href="inddz.php">Индивидуальные задания <span>&#8250;</a></span></div>
      <div class="stl"><a href="test.php">Тесты <span>&#8250;</a></span></div>
      <div class="stl"><a href="motod.php">Методические материалы <span>&#8250;</a></span></div>
      <div class="stl"><a href="lectoriy.php">Лекторий <span>&#8250;</a></span></div>
    </div>
</div>
<div id="header">
<?
$login=$_SESSION['user']['login'];
$result=mysql_query("SELECT first_name from userlist WHERE login='$login'");
$data=mysql_fetch_assoc($result);
?>
	<? echo "Сегодня ".date(" D, j F Y");/* h:i:s A*/
		echo " -----Страница студента";
	?>
	<div id="head_accaunt">
		<p>
			<span class="name"><? echo $data['first_name'];?></span>
			<br>
			<span class="status">студент</span>
		</p>
		<a id="exit">Выход</a>
		<div id="avatar"></div>
	</div>
	<div></div>
</div>