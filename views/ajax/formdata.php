<div class="container">
    <div class="col-xs-12">
        <!-- We are not going to use the HTML form, becuase submission is done using FormData -->
        <div class="the-form">
            <div class="form-group">
                <label for="images">Select images</label>
                <input class="form-control" id="images" type="file" name="images" multiple>
            </div>

            <div class="form-group">
                <label for="file-path">File path</label>
                <input class="form-control file-path validate" type="text">

            </div>

            <div class="form-group">
                <button class="btn btn-primary" id="submit-formdata">Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
    window.addEventListener('load', function () {
        $("#submit-formdata").on("click", function (event) {
            event.preventDefault();
            var formData = new FormData();
            formData.append("param1", "value1");
            var files = $("#images")[0].files;
            for (var i in files) {
                formData.append("files[]", files[i]);
            }

            console.log("From data");
            console.log(formData);
            $.ajax({
                url: "/ajax/handle-formdata",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false
            });
        });
    });
</script>
