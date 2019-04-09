
<script>
    var $table = $('.table');
    var $today = new Date();
    $(function () {
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: 'all',
            exportOptions: {
                fileName: 'Export_' + $today
            }
        });
    })
    $( ".select2" ).select2({
        theme: "bootstrap"
    });
    $(".select2").width("100%");
</script>
</body>
</html>
