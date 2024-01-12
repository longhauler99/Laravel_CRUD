@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">Laravel CRUD<button class="btn btn-sm btn-primary float-end call-btn">Call API</button></div>
                    <div class="card-body">
                        <div class="row overflow-auto d-flex">
                            <div class="col-lg">
                                <table class="table table-bordered table-hover table-sm table-responsive">
                                    <thead>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
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
        document.addEventListener('click', ClickHandler);

        function ClickHandler()
        {
            let eln = event.target;

            if(eln.matches('.call-btn'))
            {
                let url = "<?= route('test'); ?>/"+100;
                fetchData(url);

            }
        }

        async function fetchData(url)
        {
            const response = await fetch(url);
            const data = await response.json();
            document.querySelector('thead').innerHTML = data[0];
            document.querySelector('tbody').innerHTML = data[1];
        }

    </script>

@endpush

