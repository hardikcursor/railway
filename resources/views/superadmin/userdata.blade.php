@extends('layouts.backend')

<style>
    .btn-3d {
        box-shadow: 0 4px #999;
        transition: all 0.1s ease-in-out;
    }

    .btn-3d:active {
        box-shadow: 0 2px #666;
        transform: translateY(2px);
    }

    /* .btn-success.btn-3d {
        background: linear-gradient(to bottom, #28a745, #218838);
        border-color: #1e7e34;
    } */

    /* .btn-danger.btn-3d {
        background: linear-gradient(to bottom, #dc3545, #bd2130);
        border-color: #b21f2d;
    } */

    @media (max-width: 575.98px) {
        .ibox-title {
            font-size: 18px;
            text-align: center;
        }

        .btn-3d {
            width: 100%;
            margin-bottom: 5px;
        }
    }
</style>

@section('main')
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="ibox">
                <div class="ibox-head d-flex justify-content-between align-items-center flex-wrap">
                    <div class="ibox-title">All User Records</div>
                </div>

                <div class="ibox-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="example-table" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <button class="btn btn-sm btn-success btn-3d changeStatusBtn"
                                                    data-id="{{ $user->id }}" data-status="0">
                                                    Active
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-danger btn-3d changeStatusBtn"
                                                    data-id="{{ $user->id }}" data-status="1">
                                                    Inactive
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- /.table-responsive -->
                </div> <!-- /.ibox-body -->
            </div> <!-- /.ibox -->
        </div> <!-- /.page-content -->
    </div> <!-- /.content-wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.changeStatusBtn').on('click', function(event) {
                event.preventDefault();
                let id = $(this).data('id');
                let val = $(this).data('status');
                let url = "{{ route('user.chnageStatus') }}";

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: { id: id, val: val },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Status update failed.');
                    }
                });
            });
        });
    </script>
@endsection
