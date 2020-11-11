<?php
  require_once "connect.php";

  $config = new Config();
  date_default_timezone_set('Asia/Jakarta');

  $amountTotal = 0;
  $taxAmount = 0;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Invoice</title>
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
        <li><a class="app-menu__item" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
      </ul>
    </aside>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> Invoice</h2>
                </div>
              </div>
              <?php
                foreach ($config->selInvoice($_GET['id']) as $row) {
              ?>
              <div class="row invoice-info">
                <div class="col-4">
                  <b>Invoice #<?= $row['invoiceCd']; ?></b><br>
                  <b>Issue Dt:</b> <?= $row['issueDt']; ?><br>
                  <b>Due Date:</b> <?= $row['dueDt']; ?><br>
                  <b>Subject:</b> <?= $row['subject']; ?><br>
                  <b>Status: <?php
                      if($row['status'] == "Y" )
                      {
                        echo "Paid";
                      } else {
                        echo "Unpaid";
                      }
                   ?></b><br>
                </div>
                <div class="col-4">From
                  <address>
                    <strong><?= $row['fromNm']; ?></strong><br>
                    <?= $row['fromStreet']; ?><br>
                    <?= $row['fromCity']; ?><br>
                    <?= $row['fromCountry']; ?><br>
                  </address>
                </div>
                <div class="col-4">To
                  <address>
                    <strong><?= $row['forNm']; ?></strong><br>
                    <?= $row['forStreet']; ?><br>
                    <?= $row['forCity']; ?><br>
                    <?= $row['forCountry']; ?><br>
                  </address>
                </div>
              </div>
              <?php
                }
              ?>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Item Type</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                        foreach ($config->selInvoiceDtl($_GET['id']) as $row) {

                        $amountTotal = $amountTotal + $row['amount'];
                        $taxAmount = ($amountTotal * 10) / 100;
                          
                      ?>
                      <tr>
                        <td><?= $row['type']; ?></td>
                        <td><?= $row['description']; ?></td>
                        <td><?= $row['qty']; ?></td>
                        <td><?= $row['unitPrice']; ?></td>
                        <td><?= $row['amount']; ?></td>
                      </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="4" align="right" style="font-weight: bold">Subtotal</td>
                        <td style="font-weight: bold"><?= $amountTotal; ?></td>
                      </tr>
                      <tr>
                        <td colspan="4" align="right" style="font-weight: bold">Tax (10%)</td>
                        <td style="font-weight: bold"><?= $taxAmount; ?></td>
                      </tr>
                      <tr>
                        <td colspan="4" align="right" style="font-weight: bold">Payment</td>
                        <td style="font-weight: bold"><?= $amountTotal - $taxAmount; ?></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
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
    
  </body>
</html>