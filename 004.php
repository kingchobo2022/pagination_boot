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
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>부트스트랩5 이용 게시물 목록, 페이지네이션 처리</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
<?php
echo "<table class='table table-hover'>
  <tr>
    <th>번호</th>
    <th>제목</th>
    <th>작성자</th>
    <th>날짜</th>
  </tr>
";

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
?>
  </div>
</body>
</html>