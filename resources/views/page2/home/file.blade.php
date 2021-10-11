@extends(Helper::setExtendBackend())

@push('style')
<style type="text/css" media="screen">
    .sidebar-left,
    .page-header,
    .sidebar-toggle {
        background-color: #272822 !important;
    }

    #editor {
        padding-top: 5px;
        padding-bottom: 0px;
    }
</style>
@endpush

@push('javascript')
<script src="{{ Helper::vendor('ace9/emmet.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ Helper::vendor('ace9/ace.js') }}" type="text/javascript" charset="utf-8"></script>
<script src="{{ Helper::vendor('ace9/ext-emmet.js') }}" type="text/javascript" charset="utf-8"></script>
@endpush

@section('content')
{!! Form::open() !!}
<div id="editor" class="row">

    <textarea name="code" id="code" cols="30" rows="5">{{ $data }}</textarea>

    <div class="navbar-fixed-bottom" id="menu_action">
        <div class="text-right" style="padding:5px">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>

</div>
{!! Form::close() !!}
@endsection

@push('javascript')
<script>
    function createEditor(name) {
        // find the textarea
        var textarea = document.querySelector("form textarea[name=" + name + "]");

        // create ace editor 
        var editor = ace.edit()
        var height = $(".sidebar-left").height()-100;
        editor.container.style.height = height+'px'
        editor.container.style.fontSize = '15px'
        editor.session.setValue(textarea.value)
        editor.setTheme("ace/theme/monokai");
        editor.session.setMode("ace/mode/php_laravel_blade");
        editor.setOption("enableEmmet", true);
        editor.setOption('keyBinding', 'sublime');
        editor.setOption("keyboardHandler", "ace/ext/sublime");

        // replace textarea with ace
        textarea.parentNode.insertBefore(editor.container, textarea)
        textarea.style.display = "none"
        // find the parent form and add submit event listener
        var form = textarea
        while (form && form.localName != "form") form = form.parentNode
        form.addEventListener("submit", function() {
            // update value of textarea to match value in ace
            textarea.value = editor.getValue()
        }, true)
    }
    createEditor("code")

</script>

@endpush