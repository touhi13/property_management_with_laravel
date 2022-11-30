@if(Session::has('message'))
<script>
    swal('Success!', '{{ Session::get('message') }}', 'success');
</script>
@endif
