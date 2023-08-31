<?php
include 'database.php';
include 'header.php';


$recordsPerPage = 10;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

if (isset($_GET['q'])) {
    $searchQuery = $_GET['q'];
    $sql = "SELECT * FROM registerdoner WHERE firstname LIKE '%$searchQuery%' OR lastname LIKE '%$searchQuery%' OR bloodgroup LIKE '%$searchQuery%'";
} else {
    $sql = "SELECT * FROM registerdoner";
}

if (isset($_GET['bloodgroup'])) {
    $bloodGroupFilter = $_GET['bloodgroup'];
    $sql = "SELECT * FROM registerdoner WHERE bloodgroup = '$bloodGroupFilter'";
}
$totalRecords = $conn->query($sql)->num_rows;
$totalPages = ceil($totalRecords / $recordsPerPage);
$offset = ($page - 1) * $recordsPerPage;
$sql .= " LIMIT $offset, $recordsPerPage";
$result = $conn->query($sql);

?>

   <link rel="stylesheet" href="./css/donor.css">
<div class="donor">
    <h3 class="container-title my-4 text-center">Find Donor</h3>
    <p>find a suitable blood donor for you</p>
    <div class="search_box">
        <div class="search">
            <form role="search" id="form" method="GET">
                <input type="search" id="query" name="q" placeholder="Search by blood group, age...."
                    aria-label="Search through site content">
                <button type="submit">
                    <svg viewBox="0 0 1024 1024">
                        <path class="path1"
                            d="M848.471 928l-263.059-263.059c-48.941 36.706-110.118 55.059-177.412 55.059-171.294 0-312-140.706-312-312s140.706-312 312-312c171.294 0 312 140.706 312 312 0 67.294-24.471 128.471-55.059 177.412l263.059 263.059-79.529 79.529zM189.623 408.078c0 121.364 97.091 218.455 218.455 218.455s218.455-97.091 218.455-218.455c0-121.364-103.159-218.455-218.455-218.455-121.364 0-218.455 97.091-218.455 218.455z">
                        </path>
                    </svg>
                </button>
            </form>
        </div>
        <div class="filter">
            <i class="fa-solid fa-filter"></i>
            <button> Filter</button>
            <div class="filter_box">
                <ul>
                    <li><a href="?bloodgroup=<?php echo urlencode('A+'); ?>">A+</a></li>
                    <li><a href="?bloodgroup=<?php echo urlencode('B+'); ?>">B+</a></li>
                    <li><a href="?bloodgroup=<?php echo urlencode('AB+'); ?>">AB+</a></li>
                    <li><a href="?bloodgroup=<?php echo urlencode('O+'); ?>">O+</a></li>
                </ul>

            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr class="headline">
                <th scope="col">NAME</th>
                <th scope="col">GENDER</th>
                <th scope="col">DATE OF BIRTH</th>
                <th scope="col">PHONE NUMBER</th>
                <th scope="col">EMAIL ID</th>
                <th scope="col">BLOOD GROUP</th>
            </tr>
        </thead>
        <?php if ($result->num_rows > 0) { ?>
        <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td data-label="NAME">
                            <?php echo $row["firstname"] . " " . $row["lastname"] ?>
                </td>
                <td data-label="GENDER">
                            <?php echo $row["gender"] ?>
                </td>
                <td data-label="DATE OF BIRTH">
                            <?php echo $row["dob"] ?>
                </td>
                <td data-label="PHONE NUMBER">
                            <?php echo $row["phone"] ?>
                </td>
                <td data-label="EMAIL ID">
                            <?php echo $row["email"] ?>
                </td>
                <td data-label="BLOOD GROUP">
                    <p class="blood_group">
                                <?php echo $row["bloodgroup"] ?>
                    </p>
                </td>
            </tr>
                <?php } ?>
        </tbody>
        <?php } else { ?>
        <div class="message">
            No Records is Found
        </div>
        <?php } ?>
    </table>
    <div class="next_page">

        <div class="next">
            <?php if ($page < $totalPages) { ?>
            <button> <a href="?page=<?php echo $page + 1; ?>">Next</a></button>
            <?php } ?>
        </div>
        <div class="number">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
            <a class="margin-right-10" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            <?php } ?>
        </div>

        <?php if ($page > 1) { ?>
        <div class="previous">
            <button><a href="?page=<?php echo $page - 1; ?>">Previous</a></button>
            </div>
        <?php } ?>
    </div>

</div>
<?php


include 'footer.php';
?>