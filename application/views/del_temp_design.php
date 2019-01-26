
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
<meta name="author" content="Coderthemes">
<title>API Hit - Recharge/Bill Payment/SMS API</title>
<link href="https://apihit.com/assets/plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
<link href="https://apihit.com/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link href="https://apihit.com/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/plugins/datatables/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/core.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/components.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/icons.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/pages.css" rel="stylesheet" type="text/css"/>
<link href="https://apihit.com/assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<script src="https://apihit.com/assets/js/modernizr.min.js"></script>
</head>
<body class="fixed-left">
<div id="wrapper">
<div class="topbar">
<div class="topbar-left">
<div class="text-center">
</div>
</div>
<div class="navbar navbar-default" role="navigation">
<div class="container">
<div class="">
<div class="pull-left">
<img src="https://apihit.com/assets/images/logo_apihit.png" href="https://apihit.com"/>
<span class="clearfix"></span>
</div>
<ul class="nav navbar-nav navbar-right pull-right">
<li><a href="https://apihit.com/profile"><i class="ti-user m-r-5"></i> Anand</a></li>
<li><a href="https://apihit.com/credit-request"><i class="ti-wallet m-r-5"></i> Wallet: ₹ 0.00</a></li>
<li class="dropdown hidden-xs">
<a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
<i class="icon-bell"></i> <span class="badge badge-xs badge-danger"></span>
</a>
<ul class="dropdown-menu dropdown-menu-lg">
<li class="notifi-title"><span class="label label-default pull-right"></span>Notification</li>
<li class="list-group nicescroll notification-list">
</li>
<li>
<a href="javascript:void(0);" class="list-group-item text-right">
<small class="font-600"></small>
</a>
</li>
</ul>
</li>
<li><a href="https://apihit.com/logout"><i class="ti-power-off m-r-5"></i> Logout</a></li>
</ul>
</div>
</div>
</div>
</div> <div class="left side-menu">
<div class="sidebar-inner slimscrollleft">
<div id="sidebar-menu">
<ul>
<li class="text-muted menu-title">Navigation</li>
<li><a href="https://apihit.com/dashboard" class="waves-effect"><i class="ti-home m-r-5"></i> <span>&nbsp;&nbsp;Dashboard</span></a></li>
<li><a href="https://apihit.com/account-balance" class="waves-effect"><i class="fa fa-rupee"></i><span>Balance</span></a></li>
<li><a href="https://apihit.com/transactions" class="waves-effect"><i class="ti-pulse"></i><span>Transactions</span></a></li>
<li><a href="https://apihit.com/business" class="waves-effect"><i class="ti-stats-up"></i><span>Business</span></a></li>
<li><a href="https://apihit.com/api-settings" class="waves-effect"><i class="ti-signal"></i><span>API Settings</span></a></li>
<li><a href="https://apihit.com/account-setting" class="waves-effect"><i class="ti-user"></i><span>Account Settings</span></a></li>
<li><a href="https://apihit.com/services" class="waves-effect"><i class="ti-medall-alt"></i><span>Services</span></a></li>
<li><a href="https://apihit.com/development-doc-menu" class="waves-effect"><i class="ti-share"></i><span>Development Docs</span></a></li>
<li><a href="https://apihit.com/invoice-menu" class="waves-effect"><i class="ti-notepad"></i><span>Invoices</span></a></li>
</ul>
<div class="clearfix"></div>
</div>
<div class="clearfix"></div>
</div>
</div> <div class="content-page">
<div class="content">
<div class="container">
<div class="row">
<div class="col-sm-12">
<h4 class="page-title">Balance Request</h4>
<ol class="breadcrumb">
<li><a href="https://apihit.com/dashboard">Dashboard</a></li>
<li>Business</li>
<li class="active">Balance Request</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-lg-4">
<div class="card-box">
<div class="bar-widget">
<div class="table-box">
<div class="table-detail">
<div class="iconbox bg-purple">
<i class="icon-energy"></i>
</div>
</div>
<div class="table-detail">
<h4 class="m-t-0 m-b-5"><b>Wallet Balance</b></h4>
<h5 id="current-api-key" class="text-muted m-b-0 m-t-0">
0.00
</h5>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="panel panel-color panel-pink">
<div class="panel-heading">
<h3 class="panel-title">credit Request Form</h3>
</div>
<div class="panel-body">
<div class="col-sm-10">
<form method="POST" action="https://apihit.com/credit-request" accept-charset="UTF-8"><input name="_token" type="hidden" value="vC4AQ9QbG9s3FaD0VHuXA9KBkBV8uVp5AN1qqshB">
<div class="form-group">
<label for="bank">Bank</label>
<select name="bank" id="bank" class="form-control" required>
<option value="">Select Bank</option>
<option value="ICICI">ICICI Bank</option>
<option value="HDFC">HDFC Bank</option>
</select>
</div>
<div class="form-group">
<label for="deposit_type">Deposit Type</label>
<select name="deposit_type" id="deposit_type" class="form-control" required>
<option value="">Select Deposit Type</option>
<option value="NEFT">NEFT</option>
<option value="RTGS">RTGS</option>
<option value="IMPS-IFSC">IMPS-IFSC</option>
</select>
</div>
<div class="form-group">
<label for="bank_transaction_id">Transaction ID</label>
<input type="text" class="form-control" id="bank_transaction_id" name="bank_transaction_id" placeholder="Transaction ID" required>
</div>
<div class="form-group">
<label for="amount">Amount</label>
<input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" required>
</div>
<div class="form-group">
<label for="datepicker">Date</label>
<div class="input-group">
<input type="text" class="form-control" placeholder="yyyy/mm/dd" id="datepicker" name="transfer_date" required>
<span class="input-group-addon bg-custom b-0 text-white"><i class="icon-calender"></i></span>
</div>
</div>
<div class="form-group">
<label for="timepicker">Time</label>
<div class="input-group m-b-15">
<div class="bootstrap-timepicker">
<input id="timepicker" type="text" class="form-control" name="transfer_time" required>
</div>
<span class="input-group-addon bg-custom b-0 text-white"><i class="glyphicon glyphicon-time"></i></span>
</div>
</div>
<button type="submit" class="btn btn-success waves-effect waves-light">Submit</button>
</form>
</div>
</div>
</div>
</div>
<div class="col-sm-6">
<div class="panel panel-color panel-purple">
<div class="panel-heading">
<h3 class="panel-title">API Hit ACCOUNTS</h3>
</div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<h3 class="text-purple">HDFC Bank</h3>
<ul>
<li>Account Name: Tech Corona</li>
<li>Account Number: 10922000000643</li>
<li>IFSC Code: HDFC0001092</li>
<li>Branch: Defence Colony, New Delhi-110024</li>
</ul>
<h3 class="text-purple">ICICI Bank</h3>
<ul>
<li>Account Name: Tech Corona</li>
<li>Account Number:- 212205500007</li>
<li>IFSC Code: ICIC0002122</li>
<li>Branch: Mayur Vihar Ph-2, New Delhi-91</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="panel panel-color panel-purple">
<div class="panel-heading">
<h3 class="panel-title">Recent Credit Requests</h3>
</div>
<div class="panel-body">
<div class="row">
<div class="col-sm-12">
<table id="credit-request-list" class="table table-striped table-bordered">
<thead>
<tr>
<th>Request ID</th>
<th>Request On</th>
<th>Bank</th>
<th>Deposit Type</th>
<th>Transaction ID</th>
<th>Transfer Date</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<tr>
<td>13</td>
<td>06 Oct 2016</td>
<td>ICICI</td>
<td>NEFT</td>
<td>1055920046</td>
<td>2016-10-06</td>
<td><span class="text-success">Allotted</span></td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<footer class="footer text-right">
2017 © API Hit.
</footer>
</div>
<div class="side-bar right-bar nicescroll">
<h4 class="text-center">Chat</h4>
<div class="contact-list nicescroll">
<ul class="list-group contacts-list">
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-1.jpg" alt="">
</div>
<span class="name">Chadengle</span>
<i class="fa fa-circle online"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-2.jpg" alt="">
</div>
<span class="name">Tomaslau</span>
<i class="fa fa-circle online"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-3.jpg" alt="">
</div>
<span class="name">Stillnotdavid</span>
<i class="fa fa-circle online"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-4.jpg" alt="">
</div>
<span class="name">Kurafire</span>
<i class="fa fa-circle online"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-5.jpg" alt="">
</div>
<span class="name">Shahedk</span>
<i class="fa fa-circle away"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-6.jpg" alt="">
</div>
<span class="name">Adhamdannaway</span>
<i class="fa fa-circle away"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-7.jpg" alt="">
</div>
<span class="name">Ok</span>
<i class="fa fa-circle away"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-8.jpg" alt="">
</div>
<span class="name">Arashasghari</span>
<i class="fa fa-circle offline"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-9.jpg" alt="">
</div>
<span class="name">Joshaustin</span>
<i class="fa fa-circle offline"></i>
</a>
<span class="clearfix"></span>
</li>
<li class="list-group-item">
<a href="#">
<div class="avatar">
<img src="https://apihit.com/assets/images/users/avatar-10.jpg" alt="">
</div>
<span class="name">Sortino</span>
<i class="fa fa-circle offline"></i>
</a>
<span class="clearfix"></span>
</li>
</ul>
</div>
</div></div>
<script>
        var resizefunc = [];
    </script>
<script src="https://apihit.com/assets/js/jquery.min.js"></script>
<script src="https://apihit.com/assets/js/bootstrap.min.js"></script>
<script src="https://apihit.com/assets/js/detect.js"></script>
<script src="https://apihit.com/assets/js/fastclick.js"></script>
<script src="https://apihit.com/assets/js/jquery.slimscroll.js"></script>
<script src="https://apihit.com/assets/js/jquery.blockUI.js"></script>
<script src="https://apihit.com/assets/js/waves.js"></script>
<script src="https://apihit.com/assets/js/wow.min.js"></script>
<script src="https://apihit.com/assets/js/jquery.nicescroll.js"></script>
<script src="https://apihit.com/assets/js/jquery.scrollTo.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/buttons.flash.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/jszip.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/pdfmake.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/vfs_fonts.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="https://apihit.com/assets/plugins/datatables/buttons.print.min.js"></script>
<script src="https://apihit.com/assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="https://apihit.com/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="https://apihit.com/assets/js/jquery.core.js"></script>
<script src="https://apihit.com/assets/js/jquery.app.js"></script>
<script type="text/javascript">
        $(document).ready(function () {
            $('#timepicker').timepicker({defaultTIme : false});
            $('#datepicker').datepicker({format: 'yyyy/mm/dd'});
            $('#credit-request-list').dataTable({
                "aaSorting": [],
                order: [[ 0, 'desc' ]]
            });
        });
    </script>
<script src="https://apihit.com/assets/plugins/notifyjs/dist/notify.min.js"></script>
<script src="https://apihit.com/assets/plugins/notifications/notify-metro.js"></script>
</body>
</html>