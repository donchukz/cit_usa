<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Payroll Management Syetem." />

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/favicon/favicon.ico" type="image/x-icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">  --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect"
        href=" https://fonts.googleapis.com/css2?family=Montserrat:wght@200;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/css/feathericon.min.css') }}">
    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/theme.bundle.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css"
        integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/js/auto-complete.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"
        integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        * {
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>
    <!-- Title -->
    <title>Payroll</title>
</head>

<body>
    @include('layout.header')

    <!-- NAVIGATION -->
    @if ($_SERVER['REQUEST_URI'] != '/employee/enter-pay')
        @if ($_SERVER['REQUEST_URI'] != '/employee/enter-pays')
            @include('layout.sidebar')
        @endif

    @endif
    @yield('content')

    <!-- JAVASCRIPT -->

    <!-- Vendor JS -->
    <script src="./assets/js/vendor.bundle.js"></script>


    <!-- Theme JS -->
    <script src="./assets/js/theme.bundle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: '',
                    center: 'title',
                    right: 'prev,next'
                },
                events: '/full-calender',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');

                    if (title) {
                        var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                        var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                        $.ajax({
                            url: "/full-calender/action",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            success: function(data) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Created Successfully");
                            }
                        })
                    }
                },
                editable: true,
                eventResize: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "/full-calender/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "/full-calender/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },

                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "/full-calender/action",
                            type: "POST",
                            data: {
                                id: id,
                                type: "delete"
                            },
                            success: function(response) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Deleted Successfully");
                            }
                        })
                    }
                }
            });

            var calendar = $('#calendar-week').fullCalendar({
                editable: true,
                header: {
                    left: 'Availability',
                    center: '',
                    right: 'agendaWeek'
                },
                events: '/full-calender',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt('Event Title:');

                    if (title) {
                        var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');

                        var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');

                        $.ajax({
                            url: "/full-calender/action",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            success: function(data) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Created Successfully");
                            }
                        })
                    }
                },
                editable: true,
                eventResize: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "/full-calender/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },
                eventDrop: function(event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
                    var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "/full-calender/action",
                        type: "POST",
                        data: {
                            title: title,
                            start: start,
                            end: end,
                            id: id,
                            type: 'update'
                        },
                        success: function(response) {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated Successfully");
                        }
                    })
                },

                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "/full-calender/action",
                            type: "POST",
                            data: {
                                id: id,
                                type: "delete"
                            },
                            success: function(response) {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Deleted Successfully");
                            }
                        })
                    }
                }
            });

        });
    </script>
    @php
        $url = $_SERVER['REQUEST_URI'];
    @endphp
    @if (auth()->user()->role == 'admin' && $url == '/add-employee')
        <script>
            //Add Input Fields
            $(document).ready(function() {
                var max_fields = 10; //Maximum allowed input fields
                var wrapper = $(".wrapper"); //Input fields wrapper
                var time = $(".time"); //Input fields wrapper
                var add_button = $(".add_fields"); //Add button class or ID
                var add_time = $(".add_time"); //Add button class or ID
                var x = 1; //Initial input field is set to 1

                //When user click on add input button
                $(add_button).click(function(e) {
                    e.preventDefault();
                    //Check maximum allowed input fields
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(wrapper).append(
                            '<div class="d-flex flex-wrap justify-content-between">' +
                            '<div class="col-md-5">' +
                            '<select name="rate[]" class="form-select data-choices required>' +
                            '<option>Select Rate</option>' +
                            '@foreach ($visits as $visit)' +
                            '<option value="{{ $visit->id }}">{{ $visit->name }} </option>' +
                            ' @endforeach' +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-5">' +
                            '<input type="text" class="form-control" placeholder="Hourly Rate" name="hourly_rate[]" required>' +
                            ' </div>' +
                            '<iconify-icon icon="ic:baseline-remove-circle" width="40" height="40" class="remove_field"></iconify-icon>' +
                            ' </div>'
                        );
                    }
                });

                //when user click on remove button
                $(wrapper).on("click", ".remove_field", function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //remove inout field
                    x--; //inout field decrement
                })

                //When user click on add input button
                $(add_time).click(function(e) {
                    e.preventDefault();
                    //Check maximum allowed input fields
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(time).append(
                            '<div class="d-flex flex-wrap justify-content-between">' +
                            '<div class="col-md-5">' +
                            '<select name="day[]" class="form-select data-choices required>' +
                            '<option>Select Day</option>' +
                            '<option value="Monday">Monday </option>' +
                            '<option value="Tuesday">Tuesday</option>' +
                            '<option value="Wednesday">Wednesday </option>' +
                            '<option value="Thursday">Thursday</option>' +
                            '<option value="Friday"> Friday</option>' +
                            '<option value="Saturday">Saturday</option>' +
                            '<option value="Sunday">Sunday</option>' +
                            '<option value="Monday - Friday">Monday - Friday</option>' +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-5">' +
                            '<select name="time[]" class="form-select data-choices required>' +
                            '<option>Select Time</option>' +
                            '@foreach ($times as $time)' +
                            '<option value="{{ $time->id }}"> {{ $time->from_time }}-{{ $time->to_time }}</option>' +
                            ' @endforeach' +
                            '</select>' +
                            ' </div>' +
                            '<iconify-icon icon="ic:baseline-remove-circle" width="40" height="40" class="remove_time"></iconify-icon>' +
                            ' </div>'
                        );
                    }
                });

                //when user click on remove button
                $(time).on("click", ".remove_time", function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //remove inout field
                    x--; //inout field decrement
                })

                //show visit rate

            });
        </script>
    @endif

    {{-- edit employee --}}

    @if (auth()->user()->role == 'admin' && $url == '/dashboard')
        <script>
            //Add Input Fields
            $(document).ready(function() {
                var max_fields = 10; //Maximum allowed input fields
                var wrapper = $(".wrapper"); //Input fields wrapper
                var time = $(".time"); //Input fields wrapper
                var add_button = $(".add_fields"); //Add button class or ID
                var add_time = $(".add_time"); //Add button class or ID
                var x = 1; //Initial input field is set to 1

                //When user click on add input button
                $(add_button).click(function(e) {
                    e.preventDefault();
                    //Check maximum allowed input fields
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(wrapper).append(
                            '<div class="d-flex flex-wrap justify-content-between">' +
                            '<div class="col-md-5">' +
                            '<select name="rate[]" class="form-select data-choices required>' +
                            '<option>Select Rate</option>' +
                            '@foreach ($visits as $visit)' +
                            '<option value="{{ $visit->id }}">{{ $visit->name }} </option>' +
                            ' @endforeach' +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-5">' +
                            '<input type="text" class="form-control" placeholder="Hourly Rate" name="hourly_rate[]" required>' +
                            ' </div>' +
                            '<iconify-icon icon="ic:baseline-remove-circle" width="40" height="40" class="remove_field"></iconify-icon>' +
                            ' </div>'
                        );
                    }
                });

                //when user click on remove button
                $(wrapper).on("click", ".remove_field", function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //remove inout field
                    x--; //inout field decrement
                })

                //When user click on add input button
                $(add_time).click(function(e) {
                    e.preventDefault();
                    //Check maximum allowed input fields
                    if (x < max_fields) {
                        x++; //input field increment
                        //add input field
                        $(time).append(
                            '<div class="d-flex flex-wrap justify-content-between">' +
                            '<div class="col-md-5">' +
                            '<select name="day[]" class="form-select data-choices required>' +
                            '<option>Select Day</option>' +
                            '<option value="Monday">Monday </option>' +
                            '<option value="Tuesday">Tuesday</option>' +
                            '<option value="Wednesday">Wednesday </option>' +
                            '<option value="Thursday">Thursday</option>' +
                            '<option value="Friday"> Friday</option>' +
                            '<option value="Saturday">Saturday</option>' +
                            '<option value="Sunday">Sunday</option>' +
                            '<option value="Monday - Friday">Monday - Friday</option>' +
                            '</select>' +
                            '</div>' +
                            '<div class="col-md-5">' +
                            '<select name="time[]" class="form-select data-choices required>' +
                            '<option>Select Time</option>' +
                            '@foreach ($times as $time)' +
                            '<option value="{{ $time->id }}"> {{ $time->from_time }}-{{ $time->to_time }}</option>' +
                            ' @endforeach' +
                            '</select>' +
                            ' </div>' +
                            '<iconify-icon icon="ic:baseline-remove-circle" width="40" height="40" class="remove_time"></iconify-icon>' +
                            ' </div>'
                        );
                    }
                });

                //when user click on remove button
                $(time).on("click", ".remove_time", function(e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //remove inout field
                    x--; //inout field decrement
                })

                //show visit rate

            });
        </script>
    @endif
    <script>
        $(".select").change(function() {
            newPrice = $(this).children(':selected').data('price');
            document.getElementById('visitRate').value = newPrice;

        });
        $("#submit").click(function() {
            document.getElementById('continue').style.display = "block";
        });

        $("#visit_types").change(function() {
            newAmount = $(this).children(':selected').data('price');
            document.getElementById('visitRates').value = newAmount;
        });
    </script>
    <script>
        $('#addBtn').click(function() {
            $("#submit").click();
        })
        $('#saveBtn').click(function() {
            $("#save").click();
        })

        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        // This method will be initialised by our script call-back
        function initAutocomplete() {
            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            // here we are getting the input keywords in locationInput constant
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(
                    fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -33.8688;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 151.2195;


                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({
                    input: input,
                    autocomplete: autocomplete
                });
                // manipulating our latitude and longitude to send it to autocomplete method
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    const place = autocomplete.getPlace();
                    // this place variable will fetch the places mathed to your keyword
                    geocoder.geocode({
                        'placeId': place.place_id
                    }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                });
            }
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
            console.log(lat);
            console.log(lng);
        }
    </script>
    @php
        $url = $_SERVER['REQUEST_URI'];
    @endphp
    @if ((auth()->user()->role == 'employee' && $url == '/employee') || $url == '/employee/enter-pay')
        <script>
            //Add Input Fields
            if (window.location.href.match('/employee')) {
                $(document).ready(function() {
                    var max_fields = 10; //Maximum allowed input fields
                    var period = $(".period"); //Input fields wrapper
                    var add_period = $(".add_period"); //Add button class or ID
                    var x = 1; //Initial input field is set to 1


                    //When user click on add input button
                    // $(add_period).click(function(e) {
                    //     e.preventDefault();
                    //     $.ajax({
                    //         url: "/daily-pay",
                    //         type: "POST",
                    //         dataType: 'json',
                    //         data: $('#form-daily-pay').serializeArray(),
                    //         complete: function(response) {
                    //             if (response.responseJSON !== undefined && response.responseJSON
                    //                 .code === 400) {
                    //                 $(this).parent('div').remove(); //remove inout field

                    //                 if (response.responseJSON.message) {
                    //                     $('#summaryPreviewContent').html(response.responseJSON
                    //                         .message);
                    //                 } else {
                    //                     $(".print-error-msg").find("ul").html('');
                    //                     $(".print-error-msg").css('display', 'block');
                    //                     $.each(response.responseJSON.error, function(key, value) {
                    //                         $(".print-error-msg").find("ul").append('<li>' +
                    //                             value + '</li>');
                    //                     });
                    //                 }
                    //                 // console.log('SUMMARY {}', response);

                    //             } else {
                    //                 // console.log('SUMMARY {}', response);
                    //                 $('#summaryPreviewContent').html(response.responseText);
                    //                 $("#form-daily-pay")[0].reset();
                    //                 $("#date").val('');
                    //                 $("#time").val('');
                    //                 $("#comment").val('');
                    //                 $("#patient").val('select');
                    //                 $("#visitRate").val('select');
                    //                 $("#visit_type").val('select');
                    //             }

                    //         },
                    //         success: function(response) {

                    //         }

                    //     })

                    // });


                    //when user click on remove button
                    $(period).on("click", ".remove_period", function(e) {
                        e.preventDefault();
                        $(this).parent('div').remove(); //remove inout field
                        x--; //inout field decrement

                        resubmit();
                    })
                });
                $('#takenBefore').change(function() {
                    var checkCount = $("input[name='sign[]']:checked").length;

                    if (checkCount > 0) {
                        alert("Atleast one checkbox should be checked.");
                    }
                    // alert('Checkbox checked!');
                });


                $(document).on('click', '.form-check-input', function() {
                    let isChecked = $(this).is(':checked');
                    if (isChecked) {
                        resubmit($(this));
                    }
                });

            }
        </script>
    @endif

    <script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFGcDBAzoWMLCasWnHyJHikjfTAmoe0Ng&libraries=places"></script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {

            var input = document.getElementById('autocomplete_search');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();

                // place variable will have all the information you are looking for.

                $('#lat').val(place.geometry['location'].lat());

                $('#long').val(place.geometry['location'].lng());

            });

        }
    </script>
    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {

            var input = document.getElementById('autocompleted_search');

            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {

                var place = autocomplete.getPlace();

                // place variable will have all the information you are looking for.

                $('#lat').val(place.geometry['location'].lat());

                $('#long').val(place.geometry['location'].lng());

            });
            var key = document.getElementById('key');

            var inputs = document.getElementById('autocompleted_searches');

            var autocompletes = new google.maps.places.Autocomplete(inputs);

            autocompletes.addListener('place_changed', function() {

                var place = autocompletes.getPlace();

                // place variable will have all the information you are looking for.

                $('#lat').val(place.geometry['location'].lat());

                $('#long').val(place.geometry['location'].lng());

            });

        }
    </script>
    <script>
        $('#checkAll').click(function() {
            $('input:checkbox').prop('checked', this.checked);
            alert('5');
            document.getElementById('payId').value = 0;
        });
    </script>
    <script>
        var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
        var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
        })
    </script>


</body>

</html>
