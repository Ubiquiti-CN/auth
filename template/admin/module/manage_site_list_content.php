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
            <td><a href="/admin/manage_site/detail?id=<?php echo $site['id']?>"><?php echo $site['site_name']?></a></td>
            <td><?php echo $site['created_at'];?></td>
        </tr>
        <?php endforeach;?>

        </tr>
        </tbody>
    </table>
    <?php
    $pageNav = new PageNavigation();
    echo $pageNav->pager($page, $total_page);
    ?>

</div>