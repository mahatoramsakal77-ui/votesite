<?php

session_start();

include("../form/conection.php");


// 
// DEFAULT LOCATION
// 

$province = $_GET["province"] ?? "Madhesh";
$district = $_GET["district"] ?? "Dhanusha";
$municipality = $_GET["municipality"] ?? "Nagrain Municipality";
$ward = $_GET["ward"] ?? "4";


// 
// LOCATION DATA
// 

$locations = [

    "Koshi" => [
        "Kathmandu" => [
            "Kathmandu Metropolitan City" => range(1, 5)
        ]
    ],

    "Madhesh" => [
        "Dhanusha" => [
            "Nagrain Municipality" => range(1, 9),
            "Janakpurdham Sub-Metropolitan City" => range(1, 5)
        ],

        "Parsa" => [
            "Birgunj Metropolitan City" => range(1, 5)
        ]
    ],

    "Bagmati" => [
        "Kathmandu" => [
            "Kathmandu Metropolitan City" => range(1, 5)
        ]
    ],

    "Gandaki" => [
        "Kaski" => [
            "Pokhara Metropolitan City" => range(1, 5)
        ]
    ],

    "Lumbini" => [
        "Rupandehi" => [
            "Butwal Sub-Metropolitan City" => range(1, 5)
        ]
    ],

    "Karnali" => [
        "Surkhet" => [
            "Birendranagar Municipality" => range(1, 5)
        ]
    ],

    "Sudurpashchim" => [
        "Kailali" => [
            "Dhangadhi Sub-Metropolitan City" => range(1, 5)
        ]
    ]
];


// 
// GET RESULTS
// 

$results = [];

$sql = "
    SELECT
        candidate_id,
        candidate_name,
        party_name,
        position,
        COUNT(*) AS total_votes
    FROM votes
    WHERE province = ?
    AND district = ?
    AND municipality = ?
    AND ward = ?
    GROUP BY
        candidate_id,
        candidate_name,
        party_name,
        position
    ORDER BY
        position,
        total_votes DESC
";

$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $province,
        $district,
        $municipality,
        $ward
    );

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {

        $results[$row["position"]][] = $row;

    }

    mysqli_stmt_close($stmt);
}


// 
// POSITION DATA
// 

$positions = [
    "Mayor",
    "Deputy Mayor",
    "Ward Chairperson"
];


// 
// FUNCTION TO CALCULATE PERCENTAGE
// 

function votePercentage($votes, $total)
{
    if ($total == 0) {
        return 0;
    }

    return round(($votes / $total) * 100, 1);
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="responsive.php">
      <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.9.0/fonts/remixicon.css"
      rel="stylesheet"/>
  </head>
<body>

<!-- =====================================================
     NAVBAR
      -->

<section class="nav">

    <div class="left-nav">

        <img
            src="../Home/img/logo.png"
            alt="logo"
            class="nav-logo"
        >

        <h2>
            Nepal<br>
            <span>online voting system</span>
        </h2>

    </div>


    <div class="right-nav">

        <div class="menu">

            <ul class="menus">

                <li>
                    <a href="../Home/home.php">
                        Home
                    </a>
                </li>


                <li>
                    <a href="../Election/index.php">
                        Election
                    </a>
                </li>


                <li>
                    <a href="../Candidate/index.php">
                        Candidates
                    </a>
                </li>


                <li>
                    <a href="../Results/results.php" class="election-active">
                        Results
                    </a>
                </li>


                <li>
                    <a href="#contact">
                        Contact
                    </a>
                </li>

            </ul>


            <button
                class="register"
                onclick="location.href='../form/regist.php'">
                Register
            </button>


            <?php if (isset($_SESSION['email'])) { ?>

                <!-- Show profile photo after login -->

                <img
                    src="../form/<?php
                        echo htmlspecialchars(
                            $_SESSION['user_photo']
                        );
                    ?>"
                    onclick="location.href='../form/profile.php'"
                    alt="Profile"
                    class="nav-avatar"
                >

            <?php } else { ?>

                <!-- Show Login button when user is not logged in -->

                <button
                    class="login"
                    onclick="location.href='../form/login.php'">
                    Login
                </button>


                <img
                    src="../Home/img/avatar1.png"
                    onclick="location.href='../form/login.php'"
                    alt="Profile"
                    class="nav-avatar"
                >

            <?php } ?>

            <i class="ri-menu-line burger"></i>
            <i class="ri-close-fill close"></i>

        </div>

    </div>

</section>





<!-- =====================================================
     MAIN
      -->

<div class="container">


    <div class="page-heading">

        <h1>
            Election Results
        </h1>

        <p>
            View voting results according to your
            selected location.
        </p>

    </div>



    <!-- =================================================
         LOCATION SEARCH
         ================================================== -->

    <div class="location-box">

        <h2>
            Search Election Results
        </h2>


        <form
            method="GET"
            action="results.php"
        >

            <div class="location-form">


                <!-- PROVINCE -->

                <div class="field">

                    <label>
                        Province
                    </label>

                    <select
                        name="province"
                        id="province"
                        onchange="loadDistricts()"
                        required
                    >

                        <option value="">
                            Select Province
                        </option>

                        <?php foreach ($locations as $p => $districts): ?>

                            <option
                                value="<?php
                                    echo htmlspecialchars($p);
                                ?>"
                                <?php
                                if ($province == $p)
                                    echo "selected";
                                ?>
                            >

                                <?php
                                echo htmlspecialchars($p);
                                ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>



                <!-- DISTRICT -->

                <div class="field">

                    <label>
                        District
                    </label>

                    <select
                        name="district"
                        id="district"
                        onchange="loadMunicipalities()"
                        required
                    >

                        <option value="">
                            Select District
                        </option>

                    </select>

                </div>



                <!-- MUNICIPALITY -->

                <div class="field">

                    <label>
                        Municipality
                    </label>

                    <select
                        name="municipality"
                        id="municipality"
                        onchange="loadWards()"
                        required
                    >

                        <option value="">
                            Select Municipality
                        </option>

                    </select>

                </div>



                <!-- WARD -->

                <div class="field">

                    <label>
                        Ward
                    </label>

                    <select
                        name="ward"
                        id="ward"
                        required
                    >

                        <option value="">
                            Select Ward
                        </option>

                    </select>

                </div>

            </div>


            <button
                type="submit"
                class="search-btn"
            >
                View Results
            </button>

        </form>

    </div>



    <!-- =================================================
         SELECTED LOCATION
         ================================================== -->

    <div class="selected-location">

        Results for:

        <strong>
            <?php echo htmlspecialchars($province); ?>
        </strong>

        →

        <strong>
            <?php echo htmlspecialchars($district); ?>
        </strong>

        →

        <strong>
            <?php echo htmlspecialchars($municipality); ?>
        </strong>

        →

        Ward

        <strong>
            <?php echo htmlspecialchars($ward); ?>
        </strong>

    </div>



    <!-- =================================================
         RESULTS
         ================================================== -->

    <?php foreach ($positions as $position_name): ?>

        <section class="position-section">


            <h2 class="position-title">

                <?php
                echo htmlspecialchars($position_name);
                ?>

            </h2>


            <?php if (isset($results[$position_name])): ?>


                <?php

                $total_position_votes = 0;

                foreach ($results[$position_name] as $candidate) {

                    $total_position_votes +=
                        (int) $candidate["total_votes"];

                }

                ?>


                <div class="candidate-grid">


                    <?php foreach (
                        $results[$position_name]
                        as $candidate
                    ): ?>


                        <?php

                        $votes =
                            (int) $candidate["total_votes"];

                        $percentage =
                            votePercentage(
                                $votes,
                                $total_position_votes
                            );

                        ?>


                        <div class="result-card">


                            <div class="candidate-name">

                                <?php
                                echo htmlspecialchars(
                                    $candidate["candidate_name"]
                                );
                                ?>

                            </div>


                            <div class="party-name">

                                <?php
                                echo htmlspecialchars(
                                    $candidate["party_name"]
                                );
                                ?>

                            </div>


                            <div class="vote-number">

                                <?php
                                echo $votes;
                                ?>

                            </div>


                            <div class="vote-label">

                                Total Votes

                            </div>


                            <div class="percentage">

                                <?php
                                echo $percentage;
                                ?>%

                            </div>


                            <div class="progress">

                                <div
                                    class="progress-bar"
                                    style="
                                        width:
                                        <?php
                                        echo $percentage;
                                        ?>%;
                                    "
                                ></div>

                            </div>


                        </div>


                    <?php endforeach; ?>


                </div>


            <?php else: ?>


                <div class="no-results">

                    No votes have been recorded for
                    <?php
                    echo htmlspecialchars($position_name);
                    ?>
                    in this location yet.

                </div>


            <?php endif; ?>


        </section>

    <?php endforeach; ?>


</div>



<!-- =====================================================
     FOOTER
      -->

<footer>

    <p>
        © <?php echo date("Y"); ?>
        Nepal Online Voting System
    </p>

    <br>

    <a href="../Home/home.php">
        Home
    </a>

    <a href="../Election/index.php">
        Election
    </a>

    <a href="../Candidate/index.php">
        Candidates
    </a>

    <a href="results.php">
        Results
    </a>

</footer>

<!-- 
     JAVASCRIPT
      -->
  <?php
  include("script.php");
  ?>
 

</body>
</html>

<?php

mysqli_close($conn);

?>
