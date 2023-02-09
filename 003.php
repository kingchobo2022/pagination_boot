<?php
include 'db.php';
include 'lib.php';

$limit = 10;
$page_limit = 5;
$page = (isset($_GET['page']) && $_GET['page'] != '' && is_numeric($_GET['page'])) ? $_GET['page'] : 1;


$sql = "SELECT COUNT(*) cnt FROM freeboard";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$row = $stmt->fetch();
$total = $row['cnt']; // 총 게시물 수 구했어요

$start = $limit * ($page - 1);

$sql = "SELECT idx, subject, author, rdate FROM freeboard LIMIT {$start}, {$limit}";
$stmt = $conn->prepare($sql);
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$rs = $stmt->fetchAll();

echo "<table>";

foreach($rs as $row) {

  echo "
    <tr>
      <td>".$row['idx']."</td>
      <td>".$row['subject']."</td>
      <td>".$row['author']."</td>
      <td>".$row['rdate']."</td>
    </tr>
  ";
}

echo "</table>";


$rs_str = my_pagination($total, $limit, $page_limit, $page) ;

echo $rs_str;