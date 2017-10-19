<?php
  //$dbase=mysql_connect('localhost', 'athena_user', '12345');
  if(!mysql_connect('localhost', 'athena_user', '12345')){

    
   /*?>
    <!DOCTYPE html>
    <html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      <title>Не могу подключиться к БД</title>
    </head>
    <body>
      <br /><br /><br />
      <h1 align="center">Проверьте настройки подключения к БД</h1>
    </body>
    </html>
    <?php*/
      echo "<h1 style='color:red;'>Проверьте настройки подключения к БД<h1>";
      
  }
  else{
    //$dbase=mysql_connect('localhost', 'athena_user', '12345');
    mysql_select_db('athena_base');
    @mysql_query('set character_set_client="utf8"');
    @mysql_query('set character_set_results="utf8"');
    @mysql_query('set collation_connection="utf8_general_ci"');
    //echo "База подключена успешно!";
    echo "<span style='color:yellow;'>&#10003;</span>";
  }
?>