<ul class="left-content left-nav">
    <li>
        <a class="create_site" href="/admin/create_site">site创建</a>
    </li>
    <li>
        <a class="manage_site" href="/admin/manage_site_list">site管理</a>
    </li>
</ul>
<script>
    $('.<?php echo isset($selected) ? $selected : 'create_site' ;?>').addClass('selected');
</script>