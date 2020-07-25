<script>
    function clean() {
        $.ajax({
            type:'get',
            url:'<?php echo CMS_ADMIN;?>admin_index/clean.php',
            success:function (data) {
                alert(data);
            }
        });
    }
</script>