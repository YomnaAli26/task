<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('alert'))
            alert("{{ session('alert') }}");
            @endif
        });
    </script>
</head>
<body>
<h1>Welcome to Home Page</h1>
</body>
</html>
