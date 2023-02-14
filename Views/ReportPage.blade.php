
<!DOCTYPE html>
<html>
<head>
    <title>Council Report Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('../CSS/style.CSS') }}">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Report Page</h1>
        <ul class="nav nav-tabs mt-5">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#step1">Step 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#step2">Step 2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#step3">Step 3</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="step1">
                @include('step1')
            </div>
            <div class="tab-pane" id="step2">
                @include('step2')
            </div>
            <div class="tab-pane" id="step3">
                @include('step3')
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('.nav-tabs a').click(function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
</body>
</html>