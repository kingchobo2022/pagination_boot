<?php

/**
 * total : 게시물의 총갯수
 * limit : 게시물의 총 갯수
 * page_limit : 출력페이지수
 * page : 현재페이지
 */
function my_pagination($total, $limit, $page_limit, $page) {

  $total_page = ceil($total / $limit);

  $start_page = ( ( floor( ($page - 1 ) / $page_limit ) ) * $page_limit ) + 1;
  $end_page = $start_page + $page_limit -1;

  if($end_page > $total_page) {
    $end_page = $total_page;
  }

  $prev_page = $start_page - 1;
  
  if($prev_page < 1) {
    $prev_page = 1;
  }


  // 1page 0.0 --> 0*5 + 1 = 1
  // 2page 0.2 --> 0*5 + 1 = 1
  // 3page 0.4 --> 0*5 + 1 = 1
  // 4page 0.6 --> 0*5 + 1 = 1
  // 5page 0.8 --> 0*5 + 1 = 1
  // 6page 1.0 --> 1*5 + 1 = 6
  // 7page 1.2 --> 1*5 + 1 = 6
  // 8page 1.4 --> 1*5 + 1 = 6
  // 9page 1.6 --> 1*5 + 1 = 6
  // 10page 1.8 --> 1*5 + 1 = 6
  // 11page 2.0 --> 1*5 + 1 = 11
  /*
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
  */

  $rs_str = '<nav aria-label="Page navigation example">
  <ul class="pagination">';

  $rs_str .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page=1">First</a></li>';

  if($prev_page > 1) {
    $rs_str .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev_page.'">Prev</a></li>';
  }

  for($i = $start_page; $i <= $end_page; $i++) {
    if($i == $page) {
      $rs_str .= "<li class=\"page-item active\" aria-current=\"page\">
      <a class=\"page-link\" href=\"#\">{$i}</a>
    </li>";

    }else {
      $rs_str .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF']."?page={$i}\">{$i}</a></li>";
    }
  } 

  $next_page = $end_page + 1;
  if($next_page <= $total_page) {
    $rs_str .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF']."?page={$next_page}\">Next</a></li>";
  }

  if($page < $total_page) {
    $rs_str .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF']."?page={$total_page}\">Last</a></li>";
  }

  return $rs_str;

}