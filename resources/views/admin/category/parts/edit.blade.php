<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{$route}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$category->id}}" name="id">

        <div class="row">

            <div class="col-12">

                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('images') }}</label>
                    <div class="image-stack">
                        <div class="row">
                            @foreach($images as $image)
                                <div class="col-md-4 col-12 mb-5">
                                    <img style="height: 115px;" src="{{ asset('storage/'.$image) }}" class="stacked-image w-100" />
                                </div>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>

            <div class="form-group">

                <label for="name" class="form-control-label">{{trns('images')}}</label>
                <div class="upload-area" id="uploadfile">
                    <div><i style="font-size: 25px;" class="fas fa-file-import"></i></div>
                    <input type="file" id="fileInput" name="image[]" multiple accept="image/*">
                    <div id="preview"></div>
                </div>

            </div>


            <div class="col-12">
                <div class="form-group">
                    <label for="name" class="form-control-label">{{ trns('name') }}</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$category->name}}">
                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ trns('close') }}</button>
            <button type="submit" class="btn btn-success" id="updateButton">{{ trns('update') }}</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>

<style>
    .upload-area {
        width: 100%;
        height: 200px;
        background-color: #1c203c;
        border-radius: 10px;
        text-align: center;
        padding: 20px;
        /*margin: 50px auto;*/
        position: relative;
        overflow-y: auto;
    }

    .upload-area h2 {
        font-size: 20px;
        color: #bbb;
        margin-top: 0;
    }

    #fileInput {
        opacity: 0;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    #preview {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 10px;
    }

    .preview-img {
        position: relative;
        display: inline-block;
        margin: 10px;
    }

    .preview-img img {
        width: 100px;
        height: 100px;
        border: 2px solid #ddd;
        border-radius: 5px;
    }

    .preview-img .delete-btn {
        position: absolute;
        top: -10px;
        right: -10px;
        background-color: red;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 12px;
        padding: 2px 5px;
    }

</style>



<script>

    $(document).ready(function () {
        // Prevent default drag behaviors
        $(document).on('dragover', function (e) {
            e.preventDefault();
        });

        $(document).on('drop', function (e) {
            e.preventDefault();
        });

        // Handle file input change
        $('#fileInput').on('change', function () {
            let files = this.files;
            previewImages(files);
        });

        // Handle drag & drop
        $('#uploadfile').on('dragover', function () {
            $(this).addClass('drag-over');
            return false;
        });

        $('#uploadfile').on('dragleave', function () {
            $(this).removeClass('drag-over');
            return false;
        });

        $('#uploadfile').on('drop', function (e) {
            e.preventDefault();
            $(this).removeClass('drag-over');
            let files = e.originalEvent.dataTransfer.files;
            $('#fileInput')[0].files = files;
            previewImages(files);
        });

        function previewImages(files) {
            $.each(files, function (i, file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    let imgWrapper = $('<div>').addClass('preview-img');
                    let img = $('<img>').attr('src', e.target.result);
                    let deleteBtn = $('<button>').text('x').addClass('delete-btn');

                    deleteBtn.on('click', function () {
                        imgWrapper.remove();
                    });

                    imgWrapper.append(img).append(deleteBtn);
                    $('#preview').append(imgWrapper);
                }
                reader.readAsDataURL(file);
            });
        }
    });


    // $('.dropify').dropify();
</script>
