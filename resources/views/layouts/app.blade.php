<!DOCTYPE html>
<html>
<head>
    <title>Sea Traveling System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav {
            margin: auto;
        }
    </style>
</head>
<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Sea Traveling System</h1>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
            <a class="navbar-brand" href="#">Home</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contracts.index') }}">Contracts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contracts.create') }}">Add Contract</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('clients.create') }}">Add Client</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="container" style="margin-top:40px">
        @yield('content')
    </main>
    
 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        var startDate = new Date(form.querySelector('input[name="start_date"]').value);
                        var endDate = new Date(form.querySelector('input[name="end_date"]').value);

                        if (endDate < startDate) {
                            event.preventDefault();
                            event.stopPropagation();
                            form.querySelector('input[name="end_date"]').setCustomValidity('End date must be after or equal to the start date.');
                        } else {
                            form.querySelector('input[name="end_date"]').setCustomValidity('');
                        }

                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>
</html>
