<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <title>Test App</title>
</head>
<body>
<div class="wrapper">
    @yield('content')
</div>6

<!-- Add Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header py-0 px-2">
                <h5 class="modal-title" id="staticBackdropLabel">Add Employee</h5>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $errors }}
                <form action="" method="post" id="addEmployeeForm">
                    @csrf
                    <div class="form-group mb-1">
                        <label for="">UPN</label>
                        <div class="col-sm">
                            <input type="number" class="form-control form-control-sm" name="PayrollNum" id="">
                            <span class="PayrollNum_error text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label for="">First Name</label>
                        <div class="col-sm">
                            <input type="text" class="form-control form-control-sm" name="FirstName" id="">
                            <span class="FirstName_error text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label for="">Last Name</label>
                        <div class="col-sm">
                            <input type="text" class="form-control form-control-sm" name="LastName" id="">
                            <span class="LastName_error text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label for="">DoB</label>
                        <div class="col-sm">
                            <input type="date" class="form-control form-control-sm" name="DoB" id="">
                            <span class="DoB_error text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group mb-1">
                        <label for="">Gender</label>
                        <div class="col-sm">
                            <input type="text" class="form-control form-control-sm" name="Gender" id="">
                            <span class="gender_error text-danger"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer p-0">
                <button type="button" class="btn btn-sm btn-secondary closeBtn" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-sm btn-primary saveBtn">save</button>
            </div>
        </div>
    </div>
</div>
{{--scripts--}}
<script src="{{ asset('assets/js/app.js') }}"></script>
@stack('child-scripts')
</body>
</html>
