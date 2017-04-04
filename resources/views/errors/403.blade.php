<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Private Space</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/png" />

    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/handlebars-v4.0.6.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <link href="css/vpnstyle.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

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
    <h3>403 - Unauthorized</h3>
    <p>Please connect using your key to enter. Unauthorized access strictly prohibited.
        <br/><br/>
    </p>

    <hr class="separator">
    <div class="row privatespace-services">
        <div class="col-lg-12">
            <div>
                <a href="https://enigmabridge.freshdesk.com/solution/categories/19000098261"
                   class="btn btn-sq btn-warning">
                    <i class="fa fa-group fa-3x"></i><br/>
                    Manuals<br>and Support
                </a>

                <a href="https://enigmabridge.com/spaces" class="btn btn-sq btn-info">
                    <i class="fa fa-heart fa-3x"></i><br/>
                    <br>Enigma Bridge
                </a>
                <a href="https://enigmabridge.freshdesk.com/helpdesk/tickets/new" class="btn btn-sq btn-danger">
                    <i class="fa fa-envelope-o fa-3x"></i><br/>
                    <br>Request Help
                </a>
            </div>
        </div>

    </div>

    <div id="userStats" style="display: none">
        <hr class="separator">
        <div class="row">
            <h3>Private space devices</h3>
            <div class="table-responsive">
                <div id="statsPlaceholder"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
