
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="lGH1ahNqPHZ616zgymbfelrgCzSw7Ls0y8Suocb5">
    <title>TaniQuy</title>

    <link rel="stylesheet" href="https://taniquy.xyz/assets/css/bootstrap.css">

    <link rel="stylesheet" href="https://taniquy.xyz/assets/vendors/chartjs/Chart.min.css">

    <link rel="stylesheet" href="https://taniquy.xyz/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="https://taniquy.xyz/assets/css/app.css">
    
    <link rel="shortcut icon" href="https://taniquy.xyz/" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <link rel="stylesheet" type="text/css" href="https://taniquy.xyz/css/custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.8.55/css/materialdesignicons.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">

</head>
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .logo{
            height: 200px;
            width: auto;
            object-fit: auto;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .btn-md-lg {
            padding: 0.6rem 1.8rem;
            font-size: 1.125rem;
            border-radius: 0.267rem;
        }
        @media  only screen and (max-width: 600px) {
            .logo {
                height: 100px;
            }
            .btn-md-lg {
                padding: 0.6rem 1rem;
                font-size: .8rem;
                border-radius: 0.267rem;
            }
        }
    </style>
    <body>
        <div class="container flex-center position-ref full-height">
            <div class="row d-flex justify-content-center">
                <div class="col-12 d-flex justify-content-center">
                    <img src="https://taniquy.xyz/images/logo.png" class='logo mb-4'>
                </div>
                            <div class="col-md-2 mt-2 col-3 text-center">
                    <a href="https://taniquy.xyz/login" class="btn btn-md-lg btn-success">Login</a>
                </div>
                <div class="col-md-2 mt-2 col-3 text-center">
                    <a href="https://taniquy.xyz/register" class="btn btn-md-lg btn-outline-success">Register</a>
                </div>
            </div>
                    </div>
        <script src="https://taniquy.xyz/assets/js/feather-icons/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://taniquy.xyz/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="https://taniquy.xyz/assets/js/app.js"></script>
<script src="https://taniquy.xyz/assets/vendors/chartjs/Chart.min.js"></script>
<script src="https://taniquy.xyz/assets/vendors/apexcharts/apexcharts.min.js"></script>
<script src="https://taniquy.xyz/assets/js/pages/dashboard.js"></script>
<script src="https://taniquy.xyz/assets/js/main.js"></script>
<script src="https://taniquy.xyz/js/app.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap.min.js"></script>
    </body>
</html>
