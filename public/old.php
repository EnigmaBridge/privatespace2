<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Private Space - Basexxxsssx</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/vpnstyle.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/handlebars-v4.0.6.min.js"></script>
    <script src="js/main.js"></script>
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/png" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Handlebars.js template -->
    <script id="connectedTpl" type="text/x-handlebars-template">
        <table class="table table-hover">
          <thead>
              <th>ID</th>
              <th>Local IP</th>
              <th>Connected since</th>
              <th>Data today</th>
              <th>Week</th>
              <th>Month</th>
          </thead>
          <tbody>
              {{#users}}
              <tr>
                  <td><div class="status {{status_style}}"></div><a href="smb://{{local_ip}}">{{cname}}</a></td>
                  <td>{{local_ip}}</td>
                  <td>{{connected_fmt}}</td>
                  <td>{{total_day}}</td>
                  <td>{{total_week}}</td>
                  <td>{{total_month}}</td>
              </tr>
              {{/users}}
          </tbody>
        </table>
    </script>
  </head>

  <body class="enigmabridge">
  <div class="container">
      <div class="navbar">
          <div class="container">
              <div class="navbar-header">
                  <a class="navbar-brand" href="https://enigmabridge.com"></a>
              </div>
          </div>
      </div>

      <h1 style="color:#00a7d7">Cloud Private Space</h1>
      <h3>stevenage4.umph.io</h3>
      <p>This is the main page of your Private Space. It contains direct links to all services this Private Space
          contains.
          <br/><br/>
      </p>


      <!-- <h2>Useful Internet Links</h2> -->

      <!-- <h2 style="color:#00a7d7">Private Space Use and Management</h2> -->

      <hr class="separator">
      <div class="row">
          <div class="col-lg-12">
              <p>
                  <a href="https://stevenage4.umph.io:8442" class="btn btn-sq-lg btn-success" id="spacelink"
                     style="width:150px">
                      <i class="fa fa-bolt fa-5x"></i><br/>
                      <br>Manage Users
                  </a>

              <hr class="separator">
              <a href="https://enigmabridge.freshdesk.com/solution/categories/19000098261"
                 class="btn btn-sq-lg btn-warning" style="width:150px">
                  <i class="fa fa-group fa-5x"></i><br/>
                  Manuals<br>and Support
              </a>

              <a href="https://enigmabridge.com/spaces" class="btn btn-sq-lg btn-info" style="width:150px">
                  <i class="fa fa-heart fa-5x"></i><br/>
                  <br>Enigma Bridge
              </a>
              <a href="https://enigmabridge.freshdesk.com/helpdesk/tickets/new" class="btn btn-sq-lg btn-danger"
                 style="width:150px">
                  <i class="fa fa-envelope-o fa-5x"></i><br/>
                  <br>Request Help
              </a>
              </p>
          </div>

      </div>

      <div id="userStats" style="display: none">
          <hr class="separator">
          <div class="row">
              <h3>Private space users</h3>
              <div class="table-responsive">
              <div id="statsPlaceholder"></div>
              </div>
          </div>
      </div>
  </div>
  </body>
</html>

<?php phpinfo();


