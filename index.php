<?php
  require_once "connect.php";

  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>ESB - Test</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="index.html"></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-cog fa-lg"></i> Settings</a></li>
            <li><a class="dropdown-item" href="page-user.html"><i class="fa fa-user fa-lg"></i> Profile</a></li>
            <li><a class="dropdown-item" href="page-login.html"><i class="fa fa-sign-out fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <ul class="app-menu">
        <li>
          <a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Invoice</span></a>
        </li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Invoice List</h1>
          <p>Daftar invoice yang dibuat</p>
        </div>
        <div>
          <button class="btn bg-primary" style="color :white;" data-toggle="modal" data-target="#addData">Add Data &nbsp;<i class="fa fa-plus" aria-hidden="true" style="color:white"></i></button>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="invoiceTable">
                  <thead>
                    <th>No Inv</th>
                    <th>Subject</th>                    
                    <th>From</th>
                    <th>For</th>
                    <th>Issue Date</th>
                    <th>Due Date</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php

                      foreach ($config->selInvoice() as $row) {
                        
                    ?>
                    <tr>
                      <td><?= $row['invoiceCd']; ?></td>
                      <td><?= $row['subject']; ?></td>
                      <td><?= $row['fromNm']; ?></td>
                      <td><?= $row['forNm']; ?></td>
                      <td><?= $row['issueDt']; ?></td>
                      <td><?= $row['dueDt']; ?></td>
                      <td>
                        <a href="edit.php?id=<?= $row['invoiceCd'];?>" class="btn bg-warning"><i class="fa fa-pencil" aria-hidden="true" style="color:white"></i></a>
                        <a href="print.php?id=<?= $row['invoiceCd'];?>" class="btn bg-info"><i class="fa fa-print" aria-hidden="true" style="color:white"></i></a>
                        <a href="delete.php?id=<?= $row['invoiceCd'];?>" class="btn btn-danger" onclick="return confirm('Yakin Ingin Menghapus Data?');"><i class="fa fa-trash" aria-hidden="true"></i></a>
                      </td>
                    </tr>

                    <?php
                      }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Add Data-->
      <div class="modal fade" id="addData">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add Data Invoice</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              <div class="tile">
                <div class="tile-body">
                  <form class="form-horizontal" action="invoice.php?action=add" method="POST" >
                    <div id="addItemView">
                      <div class="form-group row">
                        <label class="control-label col-md-3">Subject</label>
                        <div class="col-md-8">
                          <input class="form-control" type="text" name="subject" id="subject" placeholder="Enter your subject name" maxlength="50" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">From Destination</label>
                        <div class="col-md-8">
                          <select class="form-control" id="from_dest" name="from_dest" required>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">For Destination</label>
                        <div class="col-md-8">
                          <select class="form-control" id="for_dest" name="for_dest" required>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Issue Date</label>
                        <div class="col-md-8">
                          <input class="form-control" id="issue_dt" name="issue_dt" type="text" placeholder="Pilih issue date" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-3">Due Date</label>
                        <div class="col-md-8">
                          <input class="form-control" id="due_dt" name="due_dt" type="text" placeholder="Pilih due date" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="control-label col-md-4">Item</label>
                        <label class="control-label col-md-2">Qty</label>
                        <label class="control-label col-md-2">Unit Price</label>
                        <label class="control-label col-md-2">Amount</label>
                        <div class="btn bg-primary" style="color :white;" id="addItem">Add Item &nbsp;<i class="fa fa-plus" aria-hidden="true" style="color:white"></i></div>
                      </div>
                      <div class="form-group row">
                        <div class="col-md-4">
                          <select class="form-control itemCd" name="itemCd" required>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control qty" id="qty" name="qty" type="number" placeholder="Enter qty" required>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control unitPrice" id="unitPrice" name="unitPrice" type="number" placeholder="Enter unit price" required>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control amount" id="amount" name="amount" type="number">
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <input type="submit" class="btn btn-primary" value="Save"> &nbsp;&nbsp;&nbsp;&nbsp;
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="assets/js/plugins/chart.js"></script>

    <script type="text/javascript" src="assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/bootstrap-datepicker.min.js"></script>

    <script type="text/javascript">
      $('#invoiceTable').DataTable();

      $('#issue_dt').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });

      $('#due_dt').datepicker({
        format: "yyyy-mm-dd",
        autoclose: true,
        todayHighlight: true
      });

      $(document).ready(function () {
        //$('#ruko').select2();
        function load() {            
            $("#from_dest").load('destination.php');
            $("#for_dest").load('destination.php');
            $(".itemCd").load('item.php');
        }

        load(); //if you don't want the click
      });

      $('#addItem').on('click', function(){

        $('#addItemView').append('<div class="form-group row"><div class="col-md-4"><select class="form-control itemCd" name="itemCd"></select></div><div class="col-md-2"><input class="form-control qty" name="qty" type="number" placeholder="Enter qty"></div><div class="col-md-2"><input class="form-control unitPrice" name="unitPrice" type="number" placeholder="Enter unit price"></div><div class="col-md-2"><input class="form-control amount" name="amount" type="number" disabled></div></div>');
        $(".itemCd").load('item.php');
      });
      $('.qty').on('change', function(){
        var qty = $('.qty').val();
        var unitPrice = $('.unitPrice').val();
        var amount = Number(qty) * Number(unitPrice);
        $('.amount').val(amount);
      });

      $('#unitPrice').on('change', function(){
        var qty = $('.qty').val();
        var unitPrice = $('.unitPrice').val();
        var amount = Number(qty) * Number(unitPrice);
        $('.amount').val(amount);
      });
    </script>
  </body>
</html>