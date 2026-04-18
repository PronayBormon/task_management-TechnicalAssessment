@extends('backend.app')

@section('title', 'Tasks')

@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
@endpush


@section('content')

    <div class="card">
        <div class="card-header">
            <div class=" d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Task List</h4>

                <a href="{{ route('admin.task.create') }}" class="btn btn-primary">
                    Add Task
                </a>
            </div>
        </div>

        <div class="card-body">

            <table id="taskTable" class="table table-bordered table-striped w-100">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Due Date</th>
                        <th>Created</th>
                        <th width="150">Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

@endsection


@push('script')
    <script>
        $(document).ready(function() {

            if ($.fn.DataTable.isDataTable('#taskTable')) {
                $('#taskTable').DataTable().destroy();
            }

            $('#taskTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.task.index') }}",

                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'priority'
                    },
                    {
                        data: 'due_date'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'action',
                        searchable: false,
                        orderable: false
                    },
                ]
            });

        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {

            // DELETE
            $(document).on('click', '.deleteBtn', function() {

                let url = $(this).data('url');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This task will be deleted permanently!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Delete',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                _method: "DELETE"
                            },

                            success: function(response) {

                                $('#taskTable').DataTable().ajax.reload(null, false);

                                Swal.fire({
                                    toast: true,
                                    icon: 'success',
                                    title: response.message,
                                    position: 'top-end',
                                    timer: 2500,
                                    showConfirmButton: false
                                });
                            },

                            error: function() {

                                Swal.fire(
                                    'Error!',
                                    'Something went wrong.',
                                    'error'
                                );
                            }
                        });

                    }

                });

            });

        });
    </script>
@endpush
