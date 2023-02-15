@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Data Set') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-{{ session('class')}}" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <div class="d-flex flex-sm-row-reverse">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#importDataModal">
                            Import User Data
                        </button>
                    </div>

                    <table class="table table-border bordered display nowrap" id="userDataSet" style="width:100%">
                        <thead>
                            <tr>
                                <td>List No.</td>
                                <td>Name</td>
                                <td>Email</td>
                                <td>Phone</td>
                                <td>Address</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->index+1}}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->address }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
{{-- Import model --}}
<div class="modal fade" id="importDataModal" tabindex="-1" aria-labelledby="importDataModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import User Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.import-data') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="importUserData" class="form-label">Select File</label>
                        <input type="file" class="form-control" id="importUserData" name="importUserData">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#userDataSet').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel'
            ],
            responsive: true,
        });

        $(".dt-buttons button span").text("Export to Excel");
        $(".dt-buttons button").addClass("btn btn-outline-success");
    });
</script>
@endsection
