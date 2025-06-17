{{-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('Backend/assets/lib/chart/chart.min.js') }}"></script>
<script src="{{ asset('Backend/assets/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('Backend/assets/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('Backend/assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('Backend/assets/lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('Backend/assets/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('Backend/assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('Backend/assets/js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}


<script src="{{ asset('assets/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/popper.js/dist/umd/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/metisMenu/dist/metisMenu.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js') }}" type="text/javascript"></script>
<!-- CORE SCRIPTS-->
<script src="{{ asset('assets/js/app.min.js') }}" type="text/javascript"></script>
<!-- PAGE LEVEL SCRIPTS-->
<script src="{{ asset('assets/js/scripts/dashboard_1_demo.js') }}" type="text/javascript"></script>

<script src="{{ asset('assets/vendors/DataTables/datatables.min.js') }}" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
        $(function() {
            $('#example-table').DataTable({
                pageLength: 10,
                //"ajax": './assets/demo/data/table_data.json',
                /*"columns": [
                    { "data": "name" },
                    { "data": "office" },
                    { "data": "extn" },
                    { "data": "start_date" },
                    { "data": "salary" }
                ]*/
            });
        })
    </script>