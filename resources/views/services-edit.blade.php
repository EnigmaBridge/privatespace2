<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit services - Private Space - {{ env('APP_PRIVATE_SPACE_NAME') }}</title>
    <link rel="shortcut icon" href="./images/favicon.png" type="image/png" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <link href="css/vpnstyle.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/bootstrap-iconpicker.min.css" rel="stylesheet" />

    <!-- JS -->
    <script src="js/app.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        $(document).ready(function() {
            $(".add-more").click(function(){
                var src = $(".after-add-more");
                var tile_name_o = src.find('.tile-name');
                var tile_link_o = src.find('.tile-link');
                var tile_icon_o = src.find('.tile-icon input[type=hidden]');

                var dest = $(".copy").clone();
                dest.find('.tile-name').val(tile_name_o.val());
                dest.find('.tile-link').val(tile_link_o.val());
                dest.find('.tile-icon').attr('data-icon', tile_icon_o.val());
                dest.removeClass('hide');
                dest.removeClass('copy');
                $('.paste-here').append(dest);

                tile_name_o.val("");
                tile_link_o.val("");

                // Activate icon pickers
                $('button[role="iconpicker"],div[role="iconpicker"]').iconpicker();
            });

            $("body").on("click",".remove",function(){
                $(this).parents(".control-group").remove();
            });

        });

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
    <h3>{{ env('APP_PRIVATE_SPACE_NAME') }}</h3>
    <p>Service registry edit
        <br/><br/>
    </p>


    <hr class="separator">
    <div class="row">
        <div class="col-lg-12">
            <div>


                {!! Form::open(['action' => ['ServiceRegisterController@store'], 'method' => 'post', 'role'=> 'form', 'class' => 'form']) !!}

                    <!-- Copy template -->
                    <div class="copy hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <span class="input-group-btn">
                            <button class="btn btn-default tile-icon" role="iconpicker" name="tile_icon[]"
                                    data-iconset="fontawesome" data-icon="fa-briefcase"></button>
                            </span>
                            <input type="text" name="tile_name[]" class="form-control tile-name" placeholder="Enter Name Here">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                            <input type="text" name="tile_link[]" class="form-control tile-link" placeholder="Enter URL">
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                        </div>
                    </div>

                @foreach($tiles as $k => $v)
                    <div class="">
                        <div class="control-group input-group" style="margin-top:10px">
                            <span class="input-group-btn">
                            <button class="btn btn-default tile-icon" role="iconpicker" name="tile_icon[]"
                                    data-iconset="fontawesome" data-icon="{{ $v->icon }}"></button>
                            </span>
                            <input type="text" name="tile_name[]" class="form-control tile-name"
                                   placeholder="Enter Name Here" value="{{ $v->name }}">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                            <input type="text" name="tile_link[]" class="form-control tile-link"
                                   placeholder="Enter URL" value="{{ $v->link }}">
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                        </div>
                    </div>
                @endforeach

                    <div class="paste-here"></div>

                    <!-- Adding template -->
                    <div class="form-group input-group control-group form-inline after-add-more">
                            <span class="input-group-btn">
                                <button class="btn btn-default tile-icon" role="iconpicker" name="tile_icon[]"
                                        data-iconset="fontawesome" data-icon="fa-briefcase"></button>
                            </span>
                        <input type="text" name="tile_name[]" class="form-control tile-name" placeholder="Enter Name Here">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
                        <input type="text" name="tile_link[]" class="form-control tile-link" placeholder="Enter URL">
                        <div class="input-group-btn">
                            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                        </div>
                    </div>


                {{--{!! Form::text('prelink', null, ['placeholder' => 'Link / URL', 'class' => 'form-control']) !!}--}}
                <div class="form-group">
                    {!! Form::submit('Update', ['class' => 'btn btn-success submit']) !!}
                </div>

                {!! Form::close() !!}

            </div>
        </div>

    </div>

</div>

<!-- https://victor-valencia.github.io/bootstrap-iconpicker/# -->
<script src="js/iconset/iconset-fontawesome-4.0.0.min.js" type="text/javascript" ></script>
<script src="js/bootstrap-iconpicker.js" type="text/javascript"></script>

</body>
</html>

