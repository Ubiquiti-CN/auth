<div class="right-content manage-site-content-list clearfix">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>site</th>
            <th>日期</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($sites as $key => $site):?>
        <tr>
            <td><a href="/admin/manage_site/detail?<?php echo $site['id']?>"><?php echo $site['site_name']?></a></td>
            <td><?php echo $site['created_at'];?></td>
        </tr>
        <?php endforeach;?>

        </tr>
        </tbody>
    </table>
    <ul class="pagination">
        <li><a href="#" class="disabled">&laquo;</a></li>
        <li><a href="#" class="active">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">&raquo;</a></li>
    </ul>
</div>