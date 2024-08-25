<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield("title","Dashboard")</title>
    <!-- plugins:css -->
   @include("layouts.admin.partials.links")
</head>
<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    @include("layouts.admin.partials.navbar")
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_sidebar.html -->
        @include("layouts.admin.partials.sidebar")
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield("content")
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:../../partials/_footer.html -->
            @include("layouts.admin.partials.footer")
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
@include("layouts.admin.partials.scripts")
</body>
</html>
