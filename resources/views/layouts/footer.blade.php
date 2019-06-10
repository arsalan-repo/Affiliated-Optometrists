<script src="{{ url('js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>
<script>
    var doctors = [];
    var map;

    function getIcon(path, size) {
        return {
            url: path,
            scaledSize: new google.maps.Size(size, size)
        }
    }

    function initMap() {
        var myLatLng = {lat: 32.905645, lng: -96.406336};

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 5,
            center: myLatLng
        });

        var image = "{{ asset('img/map-marker-small.png') }}";
        var infoWindowContent = [];
        var infoWindow = new google.maps.InfoWindow();

        for (var i = 0; i < doctors.length; i++) {
            var doctor = doctors[i];

//            console.log(doctor['latitude'], doctor['longitude'])

            var content = '<div id="content">' +
                '<div class="display_picture">' +
                '<img src="<?= asset('storage') ?>/' + doctor['display_picture'] + '" />' +
                '</div>' +
                '<div class="text text-center">' +
                '<a class="route"><i class="fas fa-route"></i></a><br/>' +
                '<a class="mobile"><i class="fa fa-mobile"></i></a>' +
                '<h3>' + doctor['name'] + '</h3>' +
                '<p>' + doctor['address'] + '<br/>' + doctor['city'] + ', ' + doctor['zip_code'] + '</p>' +
                '</div>' +
                '</div>';

            infoWindowContent[i] = content;

            var marker = new google.maps.Marker({
                position: {lat: parseFloat(doctor['latitude']), lng: parseFloat(doctor['longitude'])},
                map: map,
                title: doctor['name'],
                icon: image
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infoWindow.setContent(infoWindowContent[i]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
            doctors[i]['marker'] = marker;
        }
    }
</script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxEHMDmErex6FF9RnbYwotnOM9-cGXPtA"></script>
<script>
    jQuery(document).ready(function ($) {
//        var doctors = [];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ url('/doctors/list') }}",
            type: "GET",
            dataType: "JSON",
            success: function (response) {
                doctors = response.data;
                initMap()
            }
        });

        $('.search h6>a').click(function (e) {
            e.preventDefault();
            $('.search').hide();
            $('.doctors').show();
            $.ajax({
                url: "{{ url('/doctors/list') }}",
                type: "GET",
                dataType: "JSON",
                success: function (response) {
                    var len = 0;
                    if (response.success == 1 && response.data != null) {
                        empty_doctors_list();
                        populate_doctors_list(response.data);
                    } else {
                        alert('An Error Occurred');
                    }
                }
            })
        })

        $('.search form>button').click(function (e) {
            e.preventDefault();
            $('.search').hide();
            $('.doctors').show();
            var input = $('.search .search_by').val();
            $.ajax({
                url: "{{ url('doctors/search') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    input: input
                },
                success: function (response) {
                    if (response.success == 1) {
                        empty_doctors_list();
                        populate_doctors_list(response.data);
                    }
                }
            })
        })

        $('.single-doctor>a').click(function (e) {
            e.preventDefault();
            $('.single-doctor').hide();
            $('.doctors').show();
        })

        $('.doctors>a').click(function (e) {
            e.preventDefault();
            $('.doctors').hide();
            $('.search').show();
        })

        function populate_doctors_list(data) {
            len = data.length;
            if (len > 0) {
                for (var i = 0; i < len; i++) {
                    var id = data[i].id;
                    var name = data[i].name;
                    var address = data[i].address;
                    var city = data[i].city;
                    var zip = data[i].zip_code;
                    var dp = data[i].display_picture;

                    var doctor = '<div class="media" data-id="' + id + '">' +
                        '<img class="mr-3" src="<?= asset('storage') ?>/' + dp + '" alt="Generic placeholder image" width="50" height="50"/>' +
                        '<div class="media-body">' +
                        '<h5 class="mt-0">' + name + '</h5>' +
                        '<i class="fas fa-chevron-right"></i>' +
                        '<p>' +
                        address
                        + '<br/>' +
                        city + ', ' + zip
                        + '</p>' +
                        '</div>' +
                        '</div>';

                    $('.doctors .list').append(doctor);
                }
                $('.media').hover(function (e) {
                    var id = $(this).attr('data-id')
                    for (var i in doctors) {
                        var doctor = doctors[i];
                        if (doctor['id'] == id) {
                            doctors[i].marker.setIcon("{{ asset('img/map-marker-small-blue.png') }}");
                        } else {
                            doctors[i].marker.setIcon("{{ asset('img/map-marker-small.png') }}");
                        }
                    }
//                    console.log(doctors);
                }, function () {
                    var id = $(this).attr('data-id')
                    for (var i in doctors) {
                        doctors[i].marker.setIcon("{{ asset('img/map-marker-small.png') }}");
                    }
                });
                $('.media').click(function (e) {
                    e.preventDefault();
                    empty_single_doctor();
                    $('.doctors').hide();
                    $('.single-doctor').show();
                    var id = $(this).attr('data-id');
                    $.ajax({
                        url: "<?= url('/doctor/') ?>/" + id + '/profile',
                        type: "GET",
                        dataType: "JSON",
                        success: function (response) {
//                            console.log(response);
                            if (response.success == 1 && response.data != null) {
                                for (var i in doctors) {
                                    var doctor = doctors[i];
                                    if (doctor['id'] == id) {
                                        doctors[i].marker.setIcon(getIcon('<?= asset('storage') ?>/' + doctor.display_picture, 50));
                                        var shape = {
                                            coords: [25, 25, 25],
                                            type: 'circle'
                                        };
                                        doctors[i].marker.setShape(shape);
                                    }
                                }
                                var cover_image = response['data'].cover;
                                var image = response['data'].display_picture;
                                var name = response['data'].name;
                                var profile = '<div class="cover">' +
                                    '<img src="<?= asset('storage') ?>/' + cover_image + '" class="img-responsive"/>' +
                                    '<div class="display-picture">' +
                                    '<img src="<?= asset('storage') ?>/' + image + '" />' +
                                    '</div>' +
                                    '</div>' +
                                    '<div class="content">' +
                                    '<h5>' + name + '</h5>' +
                                    '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt quis voluptates voluptatibus? Consequuntur cum cumque eius enim eum excepturi explicabo inventore magnam, modi nam nesciunt nisi, placeat, quod ratione veritatis!</p>' +
                                    '<button><i class="fas fa-route"></i> Get Directions</button><br/>' +
                                    '<button><i class="fa fa-mobile"></i> Contact Us</button>' +
                                    '</div>';

                                $('.single-doctor>.profile').append(profile)
                                map.panTo(new google.maps.LatLng(response['data']['latitude'], response['data']['longitude']));
                            }
                        }
                    })
                })
            }
        }

        function empty_doctors_list() {
            $('.doctors .list').empty();
        }

        function empty_single_doctor() {
            $('.single-doctor>.profile').empty()
        }

    })
</script>
<script>
    jQuery(document).ready(function ($) {

        var tab_width = 300;

        if(window.width() <= 767){
            $(".tab").removeClass('open').css('left', -(tab_width));
        }
        $('.bars button').click(function (e) {
            e.preventDefault();

            if ($(".tab").hasClass('open')) {
                $(".tab").animate({
                    left: -(tab_width)
                }).removeClass('open');
            } else {
                $(".tab").animate({
                    left: 0
                }).addClass('open');
            }
        })
    })
</script>
</body>
</html>