@if(!config('website.pjax'))

@push('style')
<style>.ck-editor__editable {min-height: 200px !important;}</style>
@endpush

@push('js')
<script src="{{ Helper::backend('vendor/ckeditor5/ckeditor.js') }}"></script>
@endpush
@endif

@push('javascript')
<script>
    ClassicEditor.create(document.querySelector('#editor'), {
        ckfinder: {
            uploadUrl: "{{ route('upload') }}",
        }
    }).then(editor => {
        console.log('Editor was initialized', editor);
        myEditor = editor;
    })
    .catch(error => {
        console.error(error.stack);
    });
</script>
@endpush