<button class="btn btn-sm bg-transparent btn-back-menu">
    <i class="fa fa-chevron-left" aria-hidden="true"></i>
</button>

<script>
    $(document).ready(function () {
        $(".btn-back-menu").click(function () {
            window.location.href = '{{$to}}'
        })
    })
</script>