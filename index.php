<?php
    include_once 'test.php';

    //Read JSON file and decode to array
    $url = __DIR__ . '/db/data.json';
    $jsonData = file_get_contents($url);
    $arrData = json_decode($jsonData);

    //Calculate
    $total_rows = count($arrData);
    $rows_per_page = 5;
    $total_pages = floor($total_rows / $rows_per_page + 0.999);

    //test
//    dd($total_rows);
//    echo $total_pages;
//    dd($arrData[0]);

    //GET CURRENT PAGE
    if(isset($_GET['page'])) {
        $current_page = intval($_GET['page']);
        if($current_page <= 0 || $current_page > $total_pages) {
            $current_page = 1;
        }
    } else {
        $current_page = 1;
    }

    $middle_page = ($current_page <= 3)?3:(
            ($current_page > $total_pages-3)?($total_pages-2):($current_page)
    );

    $row_start = ($current_page-1)*$rows_per_page;
    $row_end = min($total_rows-1, $row_start+$rows_per_page);

?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read JSON File & Pagination</title>
    <link rel="stylesheet" href="resources/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/js/bootstrap.min.js">
    <link rel="stylesheet" href="resources/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="resources/css/bao.css">
</head>
<body>

    <div id="container">
        <h1 style="text-align: center">TASK: read data from JSON & Pagination</h1>
        <table class="table table-hover">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Age</th>
                <th scope="col">Gender</th>
                <th scope="col">Company</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
            </tr>
            </thead>
            <tbody>
                <?php for($row=$row_start; $row<$row_end; $row++): ?>
                <tr>
                    <th scope="row"><?php echo $row+1; ?></th>
                    <td><?php echo $arrData[$row+1]->id; ?></td>
                    <td><?php echo $arrData[$row+1]->name; ?></td>
                    <td><?php echo $arrData[$row+1]->age; ?></td>
                    <td><?php echo $arrData[$row+1]->gender; ?></td>
                    <td><?php echo $arrData[$row+1]->company; ?></td>
                    <td><?php echo $arrData[$row+1]->email; ?></td>
                    <td><?php echo $arrData[$row+1]->phone; ?></td>
                    <td><?php echo $arrData[$row+1]->address; ?></td>
                </tr>
                <?php endfor; ?>
            </tbody>
        </table>
        <nav aria-label="content list">
            <ul class="pagination justify-content-center">
                <li class="page-item<?php echo ($current_page <= 3)?" disabled":""; ?>">
                    <a class="page-link" href="index.php?page=<?php echo $current_page-1; ?>"><i class="fas fa-chevron-left"></i></a>
                </li>
                <li class="page-item<?php echo ($current_page==$middle_page-2)?" active":"" ?>">
                    <a class="page-link" href="index.php?page=<?php echo $middle_page-2; ?>">
                        <?php echo $middle_page-2; ?>
                    </a>
                </li>
                <li class="page-item<?php echo ($current_page==$middle_page-1)?" active":"" ?>">
                    <a class="page-link" href="index.php?page=<?php echo $middle_page-1; ?>">
                        <?php echo $middle_page-1; ?>
                    </a>
                </li>
                <li class="page-item<?php echo ($current_page==$middle_page)?" active":"" ?>">
                    <a class="page-link" href="index.php?page=<?php echo $middle_page; ?>"">
                        <?php echo $middle_page; ?>
                    </a>
                </li>
                <li class="page-item<?php echo ($current_page==$middle_page+1)?" active":"" ?>">
                    <a class="page-link" href="index.php?page=<?php echo $middle_page+1; ?>">
                        <?php echo $middle_page+1; ?>
                    </a>
                </li>
                <li class="page-item<?php echo ($current_page==$middle_page+2)?" active":"" ?>">
                    <a class="page-link" href="index.php?page=<?php echo $middle_page+2; ?>">
                        <?php echo $middle_page+2; ?>
                    </a>
                </li>
                <li class="page-item<?php echo ($current_page > $total_pages-3) ? " disabled":""; ?>">
                    <a class="page-link" href="index.php?page=<?php echo $current_page+1; ?>">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</body>
</html>
