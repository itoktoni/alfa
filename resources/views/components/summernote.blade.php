@if(!config('website.pjax'))
@push('css')
<link rel="stylesheet" href="{{ Helper::backend('vendor/summernote/summernote-lite.min.css') }}">
@endpush

@push('js')
<script src="{{ Helper::backend('vendor/summernote/summernote-lite.min.js') }}"></script>
@endpush
@endif
@if (isset($array) && in_array('lite', $array))
@push('javascript')
<script>
    $('.lite').summernote({
        toolbar: [
            ['fontsize', ['fontsize','ul', 'ol', 'paragraph', 'height']],
        ],
        height: 200
    });
</script>
@endpush
@endif

@if (isset($array) && in_array('basic', $array))
@push('javascript')
<script>
    $('.basic').summernote({
        height: 300
    });
</script>
@endpush
@endif

<!-- summernote config -->
<script>
    $(document).ready(function(){

    // Define function to open filemanager window
    var lfm = function(options, cb) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
      window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
      window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
      var ui = $.summernote.ui;
      var button = ui.button({
        contents: '<i class="note-icon-picture"></i> ',
        tooltip: 'Insert image with filemanager',
        click: function() {

          lfm({type: 'image', prefix: '/laravel-filemanager'}, function(lfmItems, path) {
            lfmItems.forEach(function (lfmItem) {
              context.invoke('insertImage', lfmItem.url);
            });
          });

        }
      });
      return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    $('#summernote-editor').summernote({
      toolbar: [
        ['popovers', ['lfm']],
      ],
      buttons: {
        lfm: LFMButton
      }
    })
  });
</script>