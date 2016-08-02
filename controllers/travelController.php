<?php

class travelController extends Controller{
 
 // 到travel頁    
 function travel(){
  if(!empty($_POST['word']))  // 如果有編輯資料
  {
      $word = ereg_replace("\n", "<br />\n", $_POST['word']); // 將換行轉成資料庫存取的換行符號
      $this->model("sqlcommand")->getedit($word);             // 將編輯資料寫入資料庫
  }
  $this->dsbutton();          // 引入dsbutton fnuction
 }
          
 // 點選地點按鈕
 function dsbutton(){
  if(isset($_POST['tain']))  // 點選Taichung按鈕
   $num=1;
  else                       // 點選Tainan按鈕
   $num=0;
  
  $row=$this->model("sqlcommand")->ds($num);       // 取地點經緯度
  
  $lat = $row['lat'];        // 取經度
  $lng = $row['lng'];        // 取緯度
  $mark = $row['mark'];      // 取標記
  
  $row2 =$this->model("sqlcommand")->showedit();    // 取編輯資料
  $result =$this->model("sqlcommand")->mylist();    // 取user選取的景點

  $this->view("travel",[$lat,$lng,$mark],$result[0],$result[1],$row2);  // 到travel頁(data1:地圖經緯度、data2:選取的景點數、data3:選取的景點array、data4:規劃資料)
 }

 // 到編輯規劃頁面
 function goedit(){
  $edit =$this->model("sqlcommand")->myedit();     // 取編輯資料
  $this->view("travel_edit",$edit);                // 到travel頁(data:規劃資料)
 }

 // 刪除景點
 function mydelete(){
  $del = $_GET['delete']; 
  $this->model("sqlcommand")->deletedb($del);      
  
  header("location:/Project_pdo/travel/travel");       // 到travel頁
 }
}

?>
