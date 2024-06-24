<?php
session_start();

if (!isset($_SESSION['emploggedin']) || $_SESSION['emploggedin'] != true) {
    header("location: emplogin.php");
    exit;
}
include '../config/db_connect.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashbord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/dataTables/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    	body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 13px;
  color: #555;
  background: #ececec;
  margin-top:20px;
}

.nav.nav-tabs-custom-colored > li.active > a, 
.nav.nav-tabs-custom-colored > li.active > a:hover, 
.nav.nav-tabs-custom-colored > li.active > a:focus {
  background-color: #296EAA;
  color: #fff;
  cursor: pointer;
}

.tab-content.profile-page {
  padding: 35px 15px;
}

.profile .user-info-left {
  text-align: center;
}

.profile .user-info-left, 
.profile .user-info-right {
  padding: 10px 0;
}

.profile .user-info-left img {
  border: 3px solid #fff;
}

.profile .user-info-left h2 {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 1.3em;
  margin-bottom: 20px;
}

.user-info-left .btn{
    border-radius:0px;    
}

.profile .user-info-left ul.social a {
  font-size: 20px;
  color: #b9b9b9;
}

.profile .user-info-right {
  border-left: 1px solid #ddd;
  padding-left: 30px;
}

.profile h3, .activity h3, .settings h3 {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 1.2em;
  margin-top: 0;
  margin-bottom: 20px;
}

.data-row .data-name, .data-row .data-value {
  display: inline-block;
  vertical-align: middle;
  padding: 5px;
}

.data-row .data-name {
  width: 12em;
    color: #fff;
  background-color: #5cb85c;
  border-color: #4cae4c;
  font-size: 0.9em;
  vertical-align: top;
}

ul.activity-list > li:not(:last-child) {
  border-bottom: 1px solid #ddd;
}

ul.activity-list > li {
  padding: 15px;
}

ul.activity-list > li .activity-icon {
  display: inline-block;
  vertical-align: middle;
  -moz-border-radius: 30px;
  -webkit-border-radius: 30px;
  border-radius: 30px;
  width: 34px;
  height: 34px;
  background-color: #e4e4e4;
  font-size: 16px;
  color: #656565;
  line-height: 34px;
  text-align: center;
  margin-right: 10px;
}

fieldset {
  margin-bottom: 40px;
}

hr {
  border-top-color: #ddd;
}

.form-horizontal .control-label {
  text-align: left;
}

.form-control, .input-group .form-control {
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../modules/home.php">TouristWebsite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="employee.php">Home</a>
                    </li>
                    <li class="nav-item">

                    </li>
                </ul>
                <div class="d-flex" role="search">
                    <button class="btn btn-outline-success" style="margin-right:10px;" type="button"> <?php
                    echo "Welcome " . $_SESSION['emp_name'] . "!";
                    ?></button>
                    <button class="btn btn-outline-danger" type="button"
                        onclick="location.href='emplogout.php'">Logout</button>
                </div>
            </div>
        </div>
    </nav>
    <nav style="--bs-breadcrumb-divider: '>'; margin-left:20px;" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="employee.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">My Profile</li>
        </ol>
    </nav>
    <div class="container bootstrap snippets bootdey">
<div class="row">
<div class="main-content">

<div class="tab-content profile-page">

<div class="tab-pane profile active" id="profile-tab">
<div class="row">
<div class="col-md-3">
<div class="user-info-left">
<img class="img-responsive" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="Profile Picture">
<br>
<h2><i class="fa fa-circle green-font online-icon"></i><sup class="sr-only">online</sup>My Profile </h2>
<button class="btn btn-outline-secondary edit" style="border-radius:0px" type="button" onclick="location.href='editProfile.php'"> <i class="fa fa-edit" ></i> Edit Profile </button>

<div class="col-md-9">
<div class="user-info-right">
<div class="basic-info">
<h3><i class="fa fa-square"></i> Basic Information</h3>
<p class="data-row">
<span class="data-name">Name</span>
<span class="data-value"><?php echo $_SESSION['emp_name']; ?></span>
</p>
<p class="data-row">
<span class="data-name">Age</span>
<span class="data-value"><?php echo $_SESSION['emp_age']; ?></span>
</p>
<p class="data-row">
<span class="data-name">Gender</span>
<span class="data-value"><?php echo $_SESSION['emp_gender']; ?></span>
</p>
<p class="data-row">
<span class="data-name">Date Joined</span>
<span class="data-value"><?php echo $_SESSION['emp_date']; ?></span>
</p>
</div>
<div class="contact_info">
<h3><i class="fa fa-square"></i> Contact Information </h3>
<p class="data-row">
<span class="data-name">Email</span>
<span class="data-value"><?php echo $_SESSION['emp_email']; ?></span>
</p>
<p class="data-row">
<span class="data-name">Phone</span>
<span class="data-value"><?php echo "+91 " .$_SESSION['emp_phone']; ?></span>
</p>
</div>
</div>
</div>
</div>
</div>

<div class="tab-pane settings" id="settings-tab">
<form class="form-horizontal" role="form">
<fieldset>
<h3><i class="fa fa-square"></i> Change Password</h3>
<div class="form-group">
<label for="old-password" class="col-sm-3 control-label">Old Password</label>
<div class="col-sm-4">
<input type="password" id="old-password" name="old-password" class="form-control">
</div>
</div>
<hr>
<div class="form-group">
<label for="password" class="col-sm-3 control-label">New Password</label>
<div class="col-sm-4">
<input type="password" id="password" name="password" class="form-control">
</div>
</div>
<div class="form-group">
<label for="password2" class="col-sm-3 control-label">Repeat Password</label>
<div class="col-sm-4">
<input type="password" id="password2" name="password2" class="form-control">
</div>
</div>
</fieldset>
<fieldset>
<h3><i class="fa fa-square"></i> Privacy</h3>
<label class="fancy-checkbox">
<input type="checkbox">
<span>Show my display name</span>
</label>
<label class="fancy-checkbox">
<input type="checkbox">
<span>Show my birth date</span>
</label>
<label class="fancy-checkbox">
<input type="checkbox">
<span>Show my email</span>
</label>
<label class="fancy-checkbox">
<input type="checkbox">
<span>Show my online status on chat</span>
</label>
</fieldset>
<h3><i class="fa fa-square"> </i>Notifications</h3>
<fieldset>
<div class="form-group">
<label class="col-sm-5 control-label">Receive message from administrator</label>
<ul class="col-sm-7 list-inline">
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-globe"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-globe"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-globe'></i>" data-off-label="<i class='glyphicon glyphicon-globe'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-phone"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-phone"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-phone'></i>" data-off-label="<i class='glyphicon glyphicon-phone'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-envelope"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-envelope"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-envelope'></i>" data-off-label="<i class='glyphicon glyphicon-envelope'></i>"></div></div>
</li>
</ul>
</div>
<div class="form-group">
<label class="col-sm-5 control-label">New product has been added</label>
<ul class="col-sm-7 list-inline">
<li>
<div class="has-switch switch-animate switch-small switch-off" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-globe"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-globe"></i></span><input type="checkbox" class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-globe'></i>" data-off-label="<i class='glyphicon glyphicon-globe'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-phone"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-phone"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-phone'></i>" data-off-label="<i class='glyphicon glyphicon-phone'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-envelope"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-envelope"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-envelope'></i>" data-off-label="<i class='glyphicon glyphicon-envelope'></i>"></div></div>
</li>
</ul>
</div>
<div class="form-group">
<label class="col-sm-5 control-label">Product review has been approved</label>
<ul class="col-sm-7 list-inline">
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-globe"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-globe"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-globe'></i>" data-off-label="<i class='glyphicon glyphicon-globe'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-off" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-phone"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-phone"></i></span><input type="checkbox" class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-phone'></i>" data-off-label="<i class='glyphicon glyphicon-phone'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-on" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-envelope"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-envelope"></i></span><input type="checkbox" checked class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-envelope'></i>" data-off-label="<i class='glyphicon glyphicon-envelope'></i>"></div></div>
</li>
</ul>
</div>
<div class="form-group">
<label class="col-sm-5 control-label">Others liked your post</label>
<ul class="col-sm-7 list-inline">
<li>
<div class="has-switch switch-animate switch-small switch-off" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-globe"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-globe"></i></span><input type="checkbox" class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-globe'></i>" data-off-label="<i class='glyphicon glyphicon-globe'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-off" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-phone"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-phone"></i></span><input type="checkbox" class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-phone'></i>" data-off-label="<i class='glyphicon glyphicon-phone'></i>"></div></div>
</li>
<li>
<div class="has-switch switch-animate switch-small switch-off" tabindex="0"><div><span class="switch-left"><i class="glyphicon glyphicon-envelope"></i></span><label>&nbsp;</label><span class="switch-right switch-default"><i class="glyphicon glyphicon-envelope"></i></span><input type="checkbox" class="bs-switch switch-small" data-off="default" data-on-label="<i class='glyphicon glyphicon-envelope'></i>" data-off-label="<i class='glyphicon glyphicon-envelope'></i>"></div></div>
</li>
</ul>
</div>
</fieldset>
</form>
<p class="text-center"><a href="#" class="btn btn-custom-primary"><i class="fa fa-floppy-o"></i> Save Changes</a></p>
</div>

</div>
</div>
</div>
</div>
<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
</script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz4fnFO9gybBud7RduPuemT//+jJXB16zg6i8UQD3lV5uDC3Yc7bz1Eeow" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
  

    <script>
    </script>
</body>

</html>