<div class="form-group" >
    <div class="row form-group">
        <div class=" col-md-12">
            <div class="form-group">
                {!! Form::label('photos', __("label.photos"), ['class' => '']) !!}
                <div id="file" class="dropzone">
                    <div class="fallback">
                        <input name="files" id="file" type="file" multiple />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    {!! Html::script(url('assets/nextbyte/plugins/dropzone/dropzone.js')) !!}

    <script type="text/javascript">

        // var drop = new Dropzone('#file', {
        Dropzone.options.file={
            createImageThumbnails: true,
            addRemoveLinks: true,
            autoProcessQueue: false,
            paramName: "files",
            // uploadMultiple: true,
            parallelUploads: 5,
            maxFiles: '{!! max_file_size_helper() !!}',
            maxFilesize: '{!! max_file_size_helper() !!}',
            acceptedFiles: 'image/*',
            url: "{{route('cms.blog.upload_tempo_files')}}",
            headers: {
                'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
            },
            init: function() {
                dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
                //send all the form data along with the files:
                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("save_btn").addEventListener("click", function(files) {

                    console.log(files.name);
                    // if ($('.needs-validation').valid() && dzClosure.getQueuedFiles().length !== 0) {
                    //
                    //     //when dropzone is attached with images
                    //     e.preventDefault();
                    //     e.stopPropagation();
                    //     dzClosure.processQueue();
                    // }else{
                    //     //nothing to process (empty)
                    //     if ($('.needs-validation').valid()  && dzClosure.getQueuedFiles().length !== 0){
                    //         store.submit();
                    //     }
                    //
                    // }

                    dzClosure.on("complete", function (file) {
                        if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                            store.submit();
                        }
                    });

                });
                // dzClosure.on("complete", function (file) {
                //     if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                //         if ($('.needs-validation').valid()){
                //             store.submit();
                //         }
                //     }
                // });

            },
            success: function(file, response)
            {
                setTimeout(function() {
                    $('#insert_pic_div').hide();
                    $('#startEditingDiv').show();
                }, 2000);
            }

        };
    </script>

@endpush
