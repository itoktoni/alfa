@if(Session::has('success'))
<script type="text/javascript">
        $(function() {
    new PNotify({
    title: 'Notification Success',
            text: '{{ Session::get("success") }}',
            type: 'success'
    });
    {{ session()->forget('success') }}
    });
</script>
@endif

@if(Session::has('primary'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'For Your Information !',
                    text: '{{ Session::get("primary") }}',
                    type: 'primary',
                    addclass: 'notification-primary',
                    icon: 'fa fa-twitter'
                    });
            {{ session()->forget('primary') }}
            });
</script>
@endif

@if(Session::has('dark'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Regular Notice !',
                    text: '{{ Session::get("dark") }}',
                    addclass: 'notification-dark',
                    icon: 'fa fa-user'
                    });
            {{ session()->forget('dark') }}
            });
</script>
@endif

@if(Session::has('danger'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Notification Failed !',
                    text: '{{ Session::get("danger") }}',
                    type: 'error',
                    hide: false
                    });
            {{ session()->forget('danger') }}
            });
</script>
@endif

@if(Session::has('sticky'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Notification Failed !',
                    text: '{{ Session::get("sticky") }}',
                    type: 'error',
                    hide: false
                    });
            {{ session()->forget('sticky') }}
            });
</script>
@endif

@if(Session::has('warning'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Notification Warning !',
                    text: '{{ Session::get("warning") }}'
                    });
            {{ session()->forget('warning') }}
            });
</script>
@endif

@if ($errors->any())
<script type="text/javascript">
        $(function() {
            @foreach ($errors->all() as $error)
                    new PNotify({
                    title: 'Validation Error !',
                            text: '{{ $error }}',
                            type: 'error',
                            hide: true
                            });
                    @endforeach
            });
</script>
@endif

@if(Session::has('alert-primary'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'For Your Information !',
                    text: '{{ Session::get("alert-primary") }}',
                    type: 'primary',
                    addclass: 'notification-primary',
                    icon: 'fa fa-twitter'
                    });
            });
</script>
@endif

@if(Session::has('alert-dark'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Regular Notice !',
                    text: '{{ Session::get("alert-dark") }}',
                    addclass: 'notification-dark',
                    icon: 'fa fa-user'
                    });
            });
</script>
@endif

@if(Session::has('alert-danger'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Notification Failed !',
                    text: '{{ Session::get("alert-danger") }}',
                    type: 'error',
                    hide: false
                    });
            });
</script>
@endif

@if(Session::has('alert-success'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Notification Success',
                    text: '{{ Session::get("alert-success") }}',
                    type: 'success'
                    });
            });
</script>
@endif

@if(Session::has('alert-warning'))
<script type="text/javascript">
        $(function() {
            new PNotify({
            title: 'Notification Warning !',
                    text: '{{ Session::get("alert-warning") }}'
                    });
            });
</script>
@endif