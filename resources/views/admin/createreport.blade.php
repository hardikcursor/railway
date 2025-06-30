@extends('layouts.backend')

@section('main')
<div class="content-wrapper">
    <div class="page-content fade-in-up">
        <div class="ibox">
            <div class="ibox-head d-flex justify-content-between align-items-center flex-wrap">
                <div class="ibox-title">Generate Report Quotation</div>
            </div>

            <div class="ibox-body">
                <!-- Success Message -->
                <div id="success-message" class="alert alert-success" style="display: none;">
                    Quotation report created successfully!
                </div>

                <!-- Select Box -->
                <div class="form-group">
                    <label for="report_type">Select Report Type</label>
                    <select id="report_type" name="report_type" class="form-control" required>
                        <option value="">-- Select Report --</option>
                        <option value="daily">Booking Office : </option>
                        <option value="weekly">Weekly Report</option>
                        <option value="monthly">Monthly Report</option>
                        <option value="yearly">Yearly Report</option>
                    </select>
                </div>

                <!-- Daily Report Form -->
                <form id="daily_form" class="report-form" style="display: none;">
                    @csrf
                    <input type="hidden" name="report_type" value="daily">
                    <div class="form-group">
                        <label>Enter Checks</label>
                        <input type="text" name="daily_quotation" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Generate Daily Report</button>
                </form>
            </div> <!-- /.ibox-body -->
        </div> <!-- /.ibox -->
    </div> <!-- /.page-content -->
</div> <!-- /.content-wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#report_type').on('change', function() {
            var selected = $(this).val();
            $('.report-form').hide();

            if (selected === 'daily') {
                $('#daily_form').show();
            }
        });

        // AJAX Form Submission
        $('#daily_form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.savequotationreport') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#success-message').show().delay(3000).fadeOut();
                    $('#daily_form')[0].reset();
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseJSON.message);
                }
            });
        });
    });
</script>
@endsection
