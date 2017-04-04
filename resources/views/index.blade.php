<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Private Space - {{ $private_space }}</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- JS -->
    <script src="js/app.js"></script>
    <script src="js/handlebars-v4.0.6.min.js"></script>
    <script src="js/main.js"></script>

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

    <!-- Handlebars.js template -->
    <script id="connectedTpl" type="text/x-handlebars-template">
        <table class="table table-hover">
            <thead>
            <th>Device (click to connect)</th>
            <th>Local IP</th>
            <th>Connected since</th>
            <th>Data today</th>
            <th>Week</th>
            <th>Month</th>
            </thead>
            <tbody>
            @{{#users}}
            <tr>
                <td><div class="status @{{status_style}}"></div><a href="smb://@{{local_ip}}">@{{cname}}</a></td>
                <td>@{{local_ip}}</td>
                <td>@{{connected_fmt}}</td>
                <td>@{{total_day}}</td>
                <td>@{{total_week}}</td>
                <td>@{{total_month}}</td>
            </tr>
            @{{/users}}
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
    <h3>{{ $private_space }}</h3>
    <p>This is the main page of your Private Space. It contains direct links to all services this Private Space
        contains.
        <br/><br/>
    </p>

    <hr class="separator">
    <div class="row privatespace-services">
        <div class="col-lg-12">
            <div>

                <a href="https://{{ $private_space }}:8442" class="btn btn-sq-lg btn-success" id="spacelink"
                   style="width:150px">
                    <i class="fa fa-bolt fa-5x"></i><br/>
                    <br>Manage Users
                </a>

                @foreach($tiles as $k => $v)
                    <a href="{{ $v->tile_link }}" class="btn btn-sq-lg btn-success" id="spacelink">
                        <i class="fa {{ $v->tile_icon }} fa-5x"></i><br/>
                        <br>{{ $v->tile_name }}
                    </a>
                @endforeach

                @if (Gate::allows('is-admin'))
                    <a href="{{ url('/services-edit') }}" class="btn btn-default" target="_blank">
                        <i class="fa fa-th-large fa-5x"></i><br/>
                        <br>Add tiles</a>
                @endif

            <hr class="separator">
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

