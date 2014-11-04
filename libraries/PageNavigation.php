<?php

class PageNavigation {
    private $itemPerPage;
    private $numberOfItems = '5';

    public function __construct() {
        $this->itemPerPage = Bootstrap::$itemPerPage;
    }

    public function pager($page, $total_page) {
        if ($page > $total_page) {
            $page = $total_page;
        }

        $html = '<ul class="pagination">';
        $current_url = "/admin/manage_site/list";

        if ($page == 1)
            $html .= "<li class='disabled'><a>&laquo;</a></li>";
        else {
            $previous_page = $page - 1;
            $html .= "<li><a href='{$current_url}?page={$previous_page}'>&laquo;</a></li>";
        }

        if ($total_page <= $this->numberOfItems) {
            for ($i=1; $i<=$total_page; $i++) {
                if ($i == $page) {
                    $html .= "<li class='disabled'><a>{$page}</a></li>";
                } else {
                    $html .= "<li><a href='{$current_url}?page={$i}'>{$i}</a></li>";
                }

            }

        } else if (($total_page - $page) >= 4 && $page > 3) {
            $pp_page = $page - 2;
            $p_page = $page - 1;
            $nn_page = $page + 2;
            $n_page = $page + 1;
            $html .= <<<HTML
			<li class='disabled'><a>...</a></li>
	        <li><a href='{$current_url}?page={$pp_page}'>{$pp_page}</a></li>
	        <li><a href='{$current_url}?page={$p_page}'>{$p_page}</a></li>
			<li class='active'><a>{$page}</a></li>
	        <li><a href='{$current_url}?page={$n_page}'>{$n_page}</a></li>
	        <li><a href='{$current_url}?page={$nn_page}'>{$nn_page}</a></li>
			<li class='disabled'><a>...</a></li>
HTML;
        } else if (($total_page - $page) >= 4 && $page <= 3) {
            for ($i=1; $i<=$this->numberOfItems; $i++) {
                if ($page == $i) {
                    $html .= "<li class='active'><a>{$page}</a></li>";
                } else {
                    $html .= "<li><a href='{$current_url}?page={$i}'>{$i}</a></li>";
                }
            }
            $html .= "<li class='disabled'><a>...</a></li>";
        } else if (($total_page - $page) < 4) {
            $html .= "<li class='disabled'><a>...</a></li>";
            for ($i=4; $i>=0; $i--) {
                if (($total_page - $page) == $i) {
                    $html .= "<li class='active'><a>{$page}</a></li>";
                } else {
                    $tmp_page = $total_page - $i;
                    $html .= "<li><a href='{$current_url}?page={$tmp_page}'>{$tmp_page}</a></li>";
                }
            }
        }

        if ($page == $total_page)
            $html .= "<li class='disabled'><a>&raquo;</a></li>";
        else {
            $next_page = $page + 1;
            $html .= "<li><a href='{$current_url}?page={$next_page}'>&raquo;</a></li>";
        }
        $html .= '</ul>';

        return $html;
    }
} 