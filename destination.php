<?php
  require_once "connect.php";
  // Begin of CORS things
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
  //header('Content-Type: application/json');


  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 204 No Content');
    die;
  }
  // End of CORS things
   
  $post = json_decode(file_get_contents('php://input'),true);



  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');

  $action = "read";

  if (isset($_GET['action'])) {
    $action = $_GET['action'];
  }

  if ($action == "read") {
    $result = $config->selDestination();
    $destination = array();
    $res = "<option value=''><-- Pilih Data --></option>";
    while ($row = $result->fetch_assoc()){
      $res .= "<option value='".$row['destinationCd']."'>".$row['name']."</option>";
    }
    echo $res;
  }



  die();
 ?>