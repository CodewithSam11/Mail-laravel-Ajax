<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

<h1>Student Data table</h1>
<br>
<span id="output"></span>
<br>
<table border="1" cellspacing="10px" cellpadding="10px" id="students-table">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    <tbody>
        <!-- Data will be appended here -->
    </tbody>
</table>

<script>
    $(document).ready(function() {
        console.log("Document is ready, making AJAX call."); // Check for multiple calls
        $.ajax({
            type: 'GET',
            url: '{{ route('viewStudents') }}',
            success: function(data) {
                console.log(data);
                $("#students-table tbody").empty(); // Clear existing data
                if (data.students.length > 0) {
                    for (let i = 0; i < data.students.length; i++) {
                        let img = data.students[i]['image_path'];
                        $("#students-table tbody").append(`<tr>
                            <td>`+(i+1)+`</td>
                            <td>`+(data.students[i]['name'])+`</td>
                            <td>`+(data.students[i]['email'])+`</td>
                            <td>
                                <img src="{{ asset('storage/`+img+`') }}" alt="`+img+`" width="100px" height="100px"/>
                            </td>
                            <td>
                                <a href="edit-student/`+data.students[i]['id']+`">Edit</a>
                                <a href="#" class="deleteData" data-id="`+data.students[i]['id']+`">Delete</a>
                            </td>
                        </tr>`);
                    }
                } else {
                    $("#students-table tbody").append("<tr><td colspan='5'>No data found</td></tr>");
                }
            },
            error: function(err) {
                console.log(err.responseText);
            }
        });
        $("#students-table").on("click",".deleteData",function(){
            var id = $(this).attr("data-id");
            var obj = $(this);
            $.ajax({
                type: "GET",
                url: "delete-student/"+id,
                success: function(response) {
                    $("#output").text(response.response);
                    $(obj).parent().parent().remove();
                },
                error:function(err) {
                    console.log(err.responseText);
                }
            })
        });
    });
</script>
