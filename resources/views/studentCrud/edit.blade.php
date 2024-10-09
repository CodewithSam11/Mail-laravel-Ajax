<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<h2>Update the formData</h2>
<img src="{{ asset('storage/') }}/{{ $student->image_path }}" alt="" width="100px" height="100px">
<br><br>
<form action="" id="updateStudent" name="updateStudent">
    @csrf
    <input type="text" name="name" id="name" value="{{ $student->name }}" placeholder="Enter Your name" required>
    <br><br>
    <input type="email" name="email" id="email" value="{{ $student->email }}" placeholder="Enter Your email" required>
    <br><br>
    <input type="file" name="image_path" id="image_path">
    <input type="hidden" value="{{ $student->id }}" name="id" id="id">
    <br><br>
    <input type="submit" value="Update Student" id="btnSubmit">
</form>
<br>
<span id="output"></span>
<br>
<script>
    $(document).ready(function(event){
        $("#updateStudent").submit(function (event) {
        event.preventDefault();

        var form = $("#updateStudent")[0];
        var data = new FormData(form);

            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
            });
                $("#btnSubmit").prop("disabled", true);

                // Send Ajax request
                $.ajax({
                    type: "POST",
                    url: "{{ route('updateStudent') }}",
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        alert("Success");
                        $("#btnSubmit").prop("disabled", false);
                        $("#output").text(response.response);
                        // empty the form
                        $("#updateStudent")[0].reset();
                        window.location.href="{{ route('students') }}"
                    },
                    error: function (e) {
                        alert("Failed");
                        $("#btnSubmit").prop("disabled", false);
                        $("#output").text(e.responseText);

                        // empty the form
                        $("#updateStudent")[0].reset();
                        }
                });
        });
    });
</script>
