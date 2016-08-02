<?php

class contactController extends Controller {
    
  // 到forum頁    
  function contact(){
    if (!empty($_POST['name']) && !empty($_POST['word'])) //如果名字和留言都不是空值
    {    
      $name = $_POST['name'];                                   // $name設為接收到的name            
      $word = $_POST['word'];                                   // $word設為接收到的留言
      
      date_default_timezone_set('Asia/Taipei');                 //時間設定:Taipei時間 
      $now = date("Y-m-d H:i:s");                               //時間設定(年、月、日 時、分、秒)
  
      $this->model("sqlcommand")->addword($name,$word,$now);    // 寫入talk資料表
    }
    $numrows=$this->model("sqlcommand")->showword();      // 從talk資料表最新資料開始取

    $this->view("contact",$numrows[0],$numrows[1],$numrows[2],$numrows[3]);  // 到forum頁(data1:留言數、data2:留言者名array、data3:留言時間array、data4：留言內容array)
  }
  
  // 到新增留言頁
  function goenter(){
      $this->view("contact_send");
  }
}

?>
