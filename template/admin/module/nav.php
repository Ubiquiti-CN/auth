<ul class="left-content left-nav">
    <li>
        <a class="create_site" href="../create_site.php">site创建</a>
    </li>
    <li>
        <a class="manage_site" href="../manage_site_list.php">site管理</a>
    </li>
</ul>
<script>
    $('.<?php echo isset($selected) ? $selected : 'create_site' ;?>').addClass('selected');
</script>