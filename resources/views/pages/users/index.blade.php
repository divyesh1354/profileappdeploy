@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>{{ __('User Details') }}</div>
                    <a class="btn btn-xs btn-success" href="{{ route('userdetails.create') }}">
                        Add +
                    </a>
                </div>

                <div class="card-body">
                    <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Ad">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    First Name
                                </th>
                                <th>
                                    Last Name
                                </th>
                                <th>
                                    Email
                                </th>
                                {{-- <th>
                                    Work Experience
                                </th>
                                <th>
                                    Organization
                                </th> --}}
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        let dtOverrideGlobals = {
            processing: true,
            serverSide: true,
            retrieve: true,
            aaSorting: [],
            ajax: "{{ route('userdetails.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'first_name', name: 'first_name' },
                { data: 'last_name', name: 'last_name' },
                { data: 'email', name: 'email' },
                // { data: 'work_experience', name: 'work_experience', sortable: false, searchable: false },
                // { data: 'organization', name: 'organization', sortable: false, searchable: false },
                { data: 'actions', name: 'Actions', sortable: false, searchable: false }
            ],
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        };
        let table = $('.datatable-Ad').DataTable(dtOverrideGlobals);
        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection
