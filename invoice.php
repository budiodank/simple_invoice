<?php
  require_once "connect.php";


  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('HTTP/1.1 204 No Content');
    die;
  }
  

  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');

  $action = "read";

  $res = array('error' => false);

  if (isset($_GET['action'])) {
    $action = $_GET['action'];
  }

  if ($action == "read") {
    $result = $config->selInvoice();
    $invoice = array();

    while ($row = $result->fetch_assoc()){
      array_push($invoice, $row);
    }
    $res['invoice'] = $invoice;
  }

 

  if ($action == "add") {
    $invoiceNo = $config->invoiceNo();
    $subject = $_POST['subject'];
    $from_dest = $_POST['from_dest'];
    $for_dest = $_POST['for_dest'];
    $issue_dt = $_POST['issue_dt'];
    $due_dt = $_POST['due_dt'];
    $status = "N";
    $date = date("Y-m-d H:i:s");//echo "date :".$date."<br />";

    if ($invoiceNo != '' && $subject != '')  {
      $add = $config->addInvoice($invoiceNo, $subject, $from_dest, $for_dest, $issue_dt, $due_dt, $status, $date);
      $maxSeq = $config->maxSeq();
      $addDtl = $config->addInvoiceItem($invoiceNo, $maxSeq, $_POST['itemCd'], $_POST['qty'], $_POST['unitPrice'], $_POST['amount'], $date);
      
      if ($add) {
        $res['message'] = "User Added successfully";
      } else {
        $res['error'] = true;
        $res['message'] = "Insert user fail";
      }
    } else {
        $res['error'] = true;
        $res['message'] = "Please input fill";
    }
  }

  if ($action == "edit") {
    $invoiceNo = $_POST['invoiceNo'];
    $subject = $_POST['subject'];
    $from_dest = $_POST['from_dest'];
    $for_dest = $_POST['for_dest'];
    $issue_dt = $_POST['issue_dt'];
    $due_dt = $_POST['due_dt'];
    $status = $_POST['status'];
    $date = date("Y-m-d H:i:s");

    if ($invoiceNo != '' && $subject != '')  {
      $edit = $config->upInvoice($invoiceNo, $subject, $from_dest, $for_dest, $issue_dt, $due_dt, $status, $date);
      $editDtl = $config->upInvoiceItem($invoiceNo, $_POST['itemCd'], $_POST['qty'], $_POST['unitPrice'], $_POST['amount'], $date);
      if ($edit) { 
        $res['message'] = "User Editted successfully";
      } else {
        $res['error'] = true;
        $res['message'] = "Edit user fail";
      }
    } else {
        $res['error'] = true;
        $res['message'] = "Please input fill";
    }
  }



  return header('Location: index.php');
  exit();
 ?>