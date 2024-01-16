@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header fw-bold">Laravel CRUD
                        <button type="button" class="btn btn-sm btn-success float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Add New
                        </button>
                    </div>
                    <span class="success_msg bg-success-subtle d-none text-center m-1 p-1 rounded-2"></span>
{{--                    <span class="error_msg bg-danger-subtle d-none text-center text-center m-1 p-1 rounded-2"></span>--}}
                    <div class="card-body">
                        <div class="row overflow-auto d-flex">
                            <div class="col-lg">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered table-hover table-striped">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg">
                                <ul class="my-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('child-scripts')
    <script>
        window.addEventListener('load', LoadHandler);
        document.addEventListener('click', ClickHandler);

        function LoadHandler()
        {
            let url = "<?= route('view'); ?>/"+100;
            fetchData(url);
        }

        function ClickHandler(event)
        {
            let eln = event.target;

            if(eln.matches('.saveBtn'))
            {
                let apiUrl =  "<?= route('addEmployee');?>";
                let postData = new FormData(document.querySelector('#addEmployeeForm'));
                //
                Save1Record(apiUrl, postData);
            }
        }

        async function fetchData(url)
        {
            const response = await fetch(url);
            const data = await response.json();
            document.querySelector('thead').innerHTML = data[0];
            document.querySelector('tbody').innerHTML = data[1];
        }

        function Save1Record(apiUrl, postData)
        {
            let token = postData.get("_token");
            // let redirect = '/display/employees';
            // let form = document.querySelector("#addEmployeeForm");

            const options = {
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": token
                },
                method: 'POST',
                body: jsonForm(postData),
            };

            fetch(apiUrl, options)
                .then(response => {
                    if(response.ok) {
                        return response.json();
                    }
                    else
                    {
                        throw new Error(`Error: ${response.status} - ${response.statusText} `);
                    }
                })
                .then(data => {
                    // form.reset();
                    // window.location.href = redirect;
                    if(data.success === true)
                    {
                        document.querySelector(".success_msg").classList.toggle('d-none')
                        document.querySelector(".success_msg").innerText = data.msg;
                    }
                    else if(data.error === true)
                    {
                        printValidationErrorMsg(data);
                        // alert(data.errors.PayrollNum);
                    }

                    // document.querySelector(".closeBtn").click();
                    // console.log('Response:', data);
                })
                .catch(error => {
                    console.error('Fetch Error:', error);
                })
        }

        function printValidationErrorMsg(data)
        {
            let my_list = "";
            Object.entries(data.errors).forEach(([key, value]) => {
                my_list += "<li>" + value + "</li>";
            });
            //
            document.querySelector(".error_logs").innerHTML = "Oops!<br>"+ my_list;
        }

        function jsonForm(fd) //=(2022/01/17 Nelson, Mak)=//
        {
            let jf = {};
            for (let pair of fd.entries()) {
                jf[pair[0]] = pair[1];
            }

            return JSON.stringify(jf);
        }

    </script>

@endpush

