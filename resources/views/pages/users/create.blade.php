@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Add User Details') }}
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('userdetails.store') }}">
                        @csrf

                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-2 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-9">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-2 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-9">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-2 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="work_experience" class="col-md-2 col-form-label text-md-end">{{ __('Work Experience') }}</label>

                            <div class="col-md-9">
                                <table class="table table-bordered" id="workExperienceAddRemove">
                                    <tr>
                                        <th>Company</th>
                                        <th>Title or Role</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="work_experience[0][company]" placeholder="Enter company" class="form-control" required /></td>
                                        <td><input type="text" name="work_experience[0][title]" placeholder="Enter title" class="form-control" required /></td>
                                        <td><input type="text" name="work_experience[0][start_date]" class="form-control start_date" required readonly/></td>
                                        <td>
                                            <input type="text" name="work_experience[0][end_date]" class="form-control end_date d-none" readonly/>
                                            <div class="d-block">
                                                <input type="checkbox" name="work_experience[0][current_job]" class="current_job" value="1" checked/>
                                                <label class="">Current job</label>
                                            </div>
                                        </td>
                                        <td><textarea class="form-control" type="textarea" name="work_experience[0][description]" placeholder="Enter description" class="form-control"></textarea></td>
                                        <td><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="organization" class="col-md-2 col-form-label text-md-end">{{ __('Organization') }}</label>

                            <div class="col-md-9">
                                <table class="table table-bordered" id="organizationAddRemove">
                                    <tr>
                                        <th>Organization name</th>
                                        <th>Associated as</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="organization[0][name]" placeholder="Enter organization" class="form-control" required /></td>
                                        <td><input type="text" name="organization[0][associated_at]" placeholder="Enter associated at" class="form-control" required /></td>
                                        <td><input type="text" name="organization[0][start_date_organization]" class="form-control start_date" required readonly/></td>
                                        <td>
                                            <input type="text" name="organization[0][end_date_organization]" class="form-control end_date d-none" readonly/>
                                            <div class="d-block">
                                                <input type="checkbox" name="organization[0][current_job_organization]" class="current_job" value="1" checked/>
                                                <label class="">Current job</label>
                                            </div>
                                        </td>
                                        <td><textarea class="form-control" type="textarea" name="organization[0][description]" placeholder="Enter description" class="form-control"></textarea></td>
                                        <td><button type="button" name="add" id="add-btn-organization" class="btn btn-success">Add More</button></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-9 offset-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        addDatePicker();

        var i = 0;
        $("#add-btn").click(function(){
            ++i;
            $("#workExperienceAddRemove").append('<tr><td><input type="text" name="work_experience['+i+'][company]" placeholder="Enter company" class="form-control" /></td><td><input type="text" name="work_experience['+i+'][title]" placeholder="Enter title" class="form-control" /></td><td><input type="text" name="work_experience['+i+'][start_date]" class="form-control start_date" readonly/></td><td><input type="text" name="work_experience['+i+'][end_date]" class="form-control end_date d-none" readonly/><div class="d-block"><input type="checkbox" name="work_experience['+i+'][current_job]" class="current_job" value="1" checked/><label class="">Current job</label></div></td><td><textarea class="form-control" type="textarea" name="work_experience['+i+'][description]" placeholder="Enter description" class="form-control"></textarea></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
            addDatePicker();
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

        var i = 0;
        $("#add-btn-organization").click(function(){
            ++i;
            $("#organizationAddRemove").append('<tr><td><input type="text" name="organization['+i+'][name]" placeholder="Enter company" class="form-control" /></td><td><input type="text" name="organization['+i+'][associated_at]" placeholder="Enter title" class="form-control" /></td><td><input type="text" name="organization['+i+'][start_date_organization]" class="form-control start_date" readonly/></td><td><input type="text" name="organization['+i+'][end_date_organization]" class="form-control end_date d-none" readonly/><div class="d-block"><input type="checkbox" name="organization['+i+'][current_job_organization]" class="current_job" value="1" checked/><label class="">Current job</label></div></td><td><textarea class="form-control" type="textarea" name="organization['+i+'][description]" placeholder="Enter description" class="form-control"></textarea></td><td><button type="button" class="btn btn-danger remove-tr-organization">Remove</button></td></tr>');
            addDatePicker();
        });

        $(document).on('click', '.remove-tr-organization', function(){
            $(this).parents('tr').remove();
        });

        $(document).on('click', '.current_job', function() {
            let isChecked = $(this).prop('checked');

            if (isChecked) {
                // $(this).parent().addClass('d-block').removeClass('d-none');
                $(this).parent().parent().find('.end_date').addClass('d-none').removeClass('d-block');
            } else {
                // $(this).parent().addClass('d-none').removeClass('d-block');
                $(this).parent().parent().find('.end_date').addClass('d-block').removeClass('d-none');
            }
        });
    });

    function addDatePicker() {
        $(".start_date").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            startDate: new Date(),
            autoclose: true,
        });
        $(".end_date").datepicker({
            format: "yyyy-mm",
            viewMode: "months",
            minViewMode: "months",
            startDate: new Date(),
            autoclose: true,
        });
    }
</script>
@endsection
