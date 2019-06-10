<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                Copyright © 2018 Hoopes Vision. All rights reserved.
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
            </div>
        </div>
    </div>
</div>
</div>
<!-- jquery 3.3.1 -->
<script src="{{ url('assets/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src='http://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyDxEHMDmErex6FF9RnbYwotnOM9-cGXPtA'></script>
<script src="{{ url('assets/js/locationpicker.jquery.js') }}"></script>
<!-- bootstap bundle js -->
<script src="{{ url('assets/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
<!-- slimscroll js -->
<script src="{{ url('assets/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
<!-- main js -->
<script src="{{ url('assets/assets/libs/js/main-js.js') }}"></script>
{{--Multiselect--}}
{{--<script src="{{ url('css/multiselect/bootstrap-multiselect.js') }}"></script>--}}
<!-- chart chartist js -->
{{--<script src="assets/assets/vendor/charts/chartist-bundle/chartist.min.js"></script>--}}
<!-- sparkline js -->
{{--<script src="assets/assets/vendor/charts/sparkline/jquery.sparkline.js"></script>--}}
<!-- morris js -->
{{--<script src="assets/assets/vendor/charts/morris-bundle/raphael.min.js"></script>--}}
{{--<script src="assets/assets/vendor/charts/morris-bundle/morris.js"></script>--}}
<!-- chart c3 js -->
{{--<script src="assets/assets/vendor/charts/c3charts/c3.min.js"></script>--}}
{{--<script src="assets/assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>--}}
{{--<script src="assets/assets/vendor/charts/c3charts/C3chartjs.js"></script>--}}
{{--<script src="assets/assets/libs/js/dashboard-ecommerce.js"></script>--}}
{{--Data Tables--}}
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready( function () {
        $('#doctors').DataTable();
    } );
</script>
<script>
    $('#location-pickerr').locationpicker({
        location: {
            latitude: 46.15242437752303,
            longitude: 2.7470703125
        },
        radius: 300,
        inputBinding: {
            locationNameInput: $('#us2-address'),
            latitudeInput: $('#lat'),
            longitudeInput: $('#long')
        },
        enableAutocomplete: true
    });
</script>
</body>

</html>