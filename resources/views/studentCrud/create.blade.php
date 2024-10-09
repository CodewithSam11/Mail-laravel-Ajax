<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crud with Ajax</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
    <h3>Student Form</h3>
        <form action="" id="addStudentForm">
            @csrf
            <input type="text" name="name" id="name" placeholder="Enter Your name" required>
            <br><br>
            <input type="email" name="email" id="email" placeholder="Enter Your email" required>
            <br><br>
            <input type="file" name="image_path" id="image_path" required>
            {{-- <input type="file" name="file" id="file" required> --}}
            <br><br>
            <input type="submit" value="Add Student" id="btnSubmit">
        </form>
    <br><br>
    <span id="output"></span>

    <script>
        $(document).ready(function () {
            $("#addStudentForm").submit(function (event) {
                event.preventDefault();

                // Create FormData object
                var form = document.getElementById("addStudentForm");
                var data = new FormData(form);
                console.log(data);

                // Set up CSRF token for Ajax
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Disable the submit button during the process
                $("#btnSubmit").prop("disabled", true);

                // Send Ajax request
                $.ajax({
                    type: "POST",
                    url: "{{ route('addStudent') }}",
                    data: data,
                    processData: false,    // Important: Don't process data automatically
                    contentType: false,    // Important: Set to false for FormData
                    success: function (response) {
                        alert("Success");
                        $("#btnSubmit").prop("disabled", false);
                        $("#output").text(response.response);  // Handle the server's response here

                        // empty the form
                        $("#addStudentForm")[0].reset();
                        // oR i can do that like this
                        // $("input[type='text']").val('');
                        // $("input[type='email']").val('');
                        // $("input[type='file']").val('');
                    },
                    error: function (e) {
                        alert("Failed");
                        $("#btnSubmit").prop("disabled", false);
                        $("#output").text(e.responseJSON.response);

                        // empty the form
                        $("#addStudentForm")[0].reset();
                        // oR i can do that like this
                        // $("input[type='text']").val('');
                        // $("input[type='email']").val('');
                        // $("input[type='file']").val('');
                    }
                });
            });
        });
    </script>
</body>
</html>


{{-----------------------   form submit by SerializeArray   ----------------------------}}
{{-- <script>
        $(document).ready(function() {
            $("#addStudentForm").submit(function(event) {
                event.preventDefault();

                // var form = document.getElementById("addStudentForm");
                // var data = new FormData(form);
                // console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $("#btnSubmit").prop("disabled", true);
                $.ajax({
                    type: "POST",
                    url: "{{ route('addStudent') }}",
                    data: $(this).serializeArray(),
                    // data: data,
                    // processData: false,
                    // contentType: false,
                    success: function() {
                        alert("Success");
                        // $("#output").innerHTML = (response);
                        $("#btnSubmit").prop("disabled", false);
                    },
                    error: function(e) {
                        alert("Failed");
                        // $("#output").innerHTML = (response);
                        $("#btnSubmit").prop("disabled", false);
                    }
                });

            });
        });
    </script> --}}
