<?php require 'auth/db_conn.php'; ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../fonts/fontawesome-free-6.3.0-web/css/all.css">
    <link rel="icon" type="image/x-icon" href="/img/logos/isik/logo.png">
    <title>Institut Supérieur de l'Informatique du Kef</title>
</head>
<body>

<?php include "component/header.php" ?>
    

<section class="bg-gray-200">
<nav class="flex mb-4 pt-8  mx-36" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
        <a href="http://localhost/isik" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
            Home
        </a>
        </li>
        <li aria-current="page">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">Galerie</span>
        </div>
        </li>
    </ol>
</nav>
<?php
    $result_per_page = 9; // number of results to display per page
    $sql = "SELECT COUNT(*) AS total FROM gallery";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $total_results = $row['total'];
    $total_pages = ceil($total_results / $result_per_page);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $start_index = ($page - 1) * $result_per_page;
    $sql = "SELECT * FROM gallery LIMIT $start_index, $result_per_page";
    $result = mysqli_query($conn, $sql);
?>

<div class="grid grid-cols-3 gap-2 max-w-7xl mx-auto my-8 pb-8">
    <h2 class="col-span-3 mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 ">Galerie</h2>
    <?php
        while($row = mysqli_fetch_assoc($result)) {
    ?>
    <div>
        <img class="h-auto max-w-full rounded-lg object-contain" src="../img/gallery/<?php echo $row['Image']; ?>" alt="<?php echo $row['Title']; ?>">
    </div>
    <?php } ?>
</div>

<div id="pagination" class="flex justify-center mt-8">
  <button id="prevBtn" class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 "> <span class="sr-only">Previous</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg></button>
  <button id="nextBtn" class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700"> <span class="sr-only">Next</span>
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg></button>
</div>
</section>
<script>
    var currentPage = <?php echo $page; ?>;
    var totalPages = <?php echo $total_pages; ?>;
    var prevBtn = document.getElementById("prevBtn");
    var nextBtn = document.getElementById("nextBtn");
    prevBtn.addEventListener("click", function() {
        if (currentPage > 1) {
            currentPage--;
            updateUrl(currentPage);
        }
    });

    nextBtn.addEventListener("click", function() {
        if (currentPage < totalPages) {
            currentPage++;
            updateUrl(currentPage);
        }
    });

    function updateUrl(page) {
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.set('page', page);
        var newUrl = window.location.pathname + "?" + urlParams.toString();
        window.location.href = newUrl;
    }
</script>


<?php include "component/footer.php" ?>
              <script src="../js/app.js"></script>
</body>
</html>