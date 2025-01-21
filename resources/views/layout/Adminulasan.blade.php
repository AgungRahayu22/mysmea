<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Modernize Free</title>
  <link rel="stylesheet" href="../assetss/css/styles.min.css" />
  <link rel="shortcut icon" type="image/png" href="../assets/img/logomy.png" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
        @include('layout.sidebarAdmin')
        @include('layout.navbar')
    <!--  Sidebar End -->
        <div class="body-wrapper">
            <div class="container mt-5">
                @include('layout.ulasanAdmin')
            </div>
        </div>
    <!--  Main wrapper -->

  </div>
  <script src="../assetss/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assetss/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assetss/js/sidebarmenu.js"></script>
  <script src="../assetss/js/app.min.js"></script>
  <script src="../assetss/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assetss/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assetss/js/dashboard.js"></script>
</body>

</html>
