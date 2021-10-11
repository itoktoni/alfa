@php
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = str_replace('/index.php', '', rtrim(dirname($_SERVER['PHP_SELF']), '/\\'));
$path   = str_replace('/file-manager', '', $path);


if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off') {
    $protocol = 'http://';
} else {
    $protocol = 'https://';
}

$baseurl = $path . "/file-manager/";

@endphp

@push('css')
<link rel="stylesheet" href="{{ Helper::vendor('file-manager/css/file-manager.min.css') }}">
<meta name="base_url" content="{{ $baseurl }}">
@endpush
@push('js')
<script src="{{ Helper::backend('vendor/tinymce4/jquery.tinymce.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/tinymce4/tinymce.min.js') }}"></script>
<script src="{{ Helper::vendor('file-manager/js/file-manager.min.js') }}"></script>
@endpush

@push('javascript')
<script>

    function elFinderBrowser (field_name, url, type, win) {
    tinymce.activeEditor.windowManager.open({
      file: '<?= route("elfinder.tinymce4") ?>',// use an absolute path!
      title: 'elFinder 2.0',
      width: 900,
      height: 450,
      resizable: 'yes'
    }, {
      setUrl: function (url) {
        win.document.getElementById(field_name).value = url;
      }
    });
    return false;
  }

    $(function() {
        @if ((is_array($array) && in_array('advance', $array)) || $array == 'advance')

        tinymce.init({
             menubar: "edit insert format table tools",
              selector     : "textarea.advance",
              plugins      : ["advlist autolink lists code link image charmap print preview anchor", "searchreplace visualblocks fullscreen", "insertdatetime media table contextmenu paste"],
              toolbar      : "insertfile undo redo | bold italic | alignleft aligncenter alignright alignjustify | code link image | bullist numlist outdent indent ",
              image_advtab : true,
              relative_urls: false, 
             file_browser_callback: elFinderBrowser 
        });
        @endif
        @if ((is_array($array) && in_array('basic', $array)) || $array == 'basic')
           tinymce.init({
                selector  : "textarea.basic",
                menubar   : false
          });
        @endif
    });
</script>
@endpush