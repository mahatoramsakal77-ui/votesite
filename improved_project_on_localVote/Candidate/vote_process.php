
<?php

session_start();

include("../form/conection.php");


// ======================================================
// CHECK LOGIN
// ======================================================

if (!isset($_SESSION["voter_id"])) {

    header("Location: voter_login.php");

    exit;

}


// ======================================================
// CHECK CANDIDATE
// ======================================================

if (!isset($_SESSION["candidate_id"])) {

    header("Location: index.php");

    exit;

}


// ======================================================
// GET SESSION DATA
// ======================================================

$voter_id =
    $_SESSION["voter_id"];

$candidate_id =
    (int) $_SESSION["candidate_id"];

$candidate_name =
    $_SESSION["candidate_name"];

$party_name =
    $_SESSION["party_name"];

$position =
    $_SESSION["position"];


// ======================================================
// GET ELECTION LOCATION
// ======================================================

if (
    !isset($_SESSION["province"]) ||
    !isset($_SESSION["district"]) ||
    !isset($_SESSION["municipality"]) ||
    !isset($_SESSION["ward"])
) {
    die("Election location information is missing from session.");
}

$province =
    $_SESSION["province"];

$district =
    $_SESSION["district"];

$municipality =
    $_SESSION["municipality"];

$ward =
    $_SESSION["ward"];


// ======================================================
// CHECK WHETHER THIS VOTER ALREADY VOTED
// FOR THIS POSITION
// ======================================================

$check_sql = "
    SELECT id
    FROM votes
    WHERE voter_id_number = ?
    AND position = ?
    LIMIT 1
";


$check_stmt =
    mysqli_prepare($conn, $check_sql);


if (!$check_stmt) {

    die("Database preparation failed: " . mysqli_error($conn));

}


mysqli_stmt_bind_param(
    $check_stmt,
    "ss",
    $voter_id,
    $position
);


mysqli_stmt_execute($check_stmt);


$check_result =
    mysqli_stmt_get_result($check_stmt);


if (mysqli_num_rows($check_result) > 0) {

    ?>

    <!DOCTYPE html>

    <html>

    <head>

        <title>Already Voted</title>

        <style>

            body {
                font-family: Arial;
                background: #f5f5f5;
                text-align: center;
                padding-top: 100px;
            }

            .message {
                background: white;
                width: 400px;
                max-width: 90%;
                margin: auto;
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 3px 15px rgba(0,0,0,0.2);
            }

            a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background: #7569f0;
                color: white;
                text-decoration: none;
                border-radius: 7px;
            }

        </style>

    </head>


    <body>

        <div class="message">

            <h2>Already Voted</h2>

            <p>
                You have already voted for
                <strong>
                    <?php
                    echo htmlspecialchars($position);
                    ?>
                </strong>.
            </p>

            <a href="../form/profile.php">
                Go To Profile
            </a>

        </div>

    </body>

    </html>

    <?php

    exit;

}


mysqli_stmt_close($check_stmt);


// ======================================================
// CHECK REQUIRED SESSION INFORMATION
// ======================================================

if (
    !isset($_SESSION["voter_id"]) ||
    !isset($_SESSION["citizenship_number"]) ||
    !isset($_SESSION["candidate_id"]) ||
    !isset($_SESSION["candidate_name"]) ||
    !isset($_SESSION["party_name"]) ||
    !isset($_SESSION["position"])
) {
    die("Required voting information is missing from session.");
}


// ======================================================
// GET VOTING INFORMATION AGAIN
// ======================================================

$voter_id =
    $_SESSION["voter_id"];

$citizenship_number =
    $_SESSION["citizenship_number"];

$candidate_id =
    (int) $_SESSION["candidate_id"];

$candidate_name =
    $_SESSION["candidate_name"];

$party_name =
    $_SESSION["party_name"];

$position =
    $_SESSION["position"];


// ======================================================
// INSERT VOTE WITH LOCATION
// ======================================================

$insert_sql = "
    INSERT INTO votes
    (
        voter_id_number,
        citizenship_number,
        candidate_id,
        candidate_name,
        party_name,
        position,
        province,
        district,
        municipality,
        ward
    )
    VALUES
    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
";


$insert_stmt =
    mysqli_prepare($conn, $insert_sql);


if (!$insert_stmt) {

    die(
        "Database preparation failed: "
        . mysqli_error($conn)
    );

}


// ======================================================
// BIND VALUES
// ======================================================

mysqli_stmt_bind_param(
    $insert_stmt,
    "ssisssssss",
    $voter_id,
    $citizenship_number,
    $candidate_id,
    $candidate_name,
    $party_name,
    $position,
    $province,
    $district,
    $municipality,
    $ward
);


// ======================================================
// SAVE VOTE
// ======================================================

if (mysqli_stmt_execute($insert_stmt)) {

    $_SESSION["voted_candidate_id"] =
        $candidate_id;

    $_SESSION["voted_candidate_name"] =
        $candidate_name;

    $_SESSION["voted_party_name"] =
        $party_name;

    $_SESSION["voted_position"] =
        $position;

    $_SESSION["vote_success"] =
        true;


    header(
        "Location: ../form/profile.php"
    );

    exit;

} else {

    die(
        "Vote could not be saved: "
        . mysqli_stmt_error($insert_stmt)
    );

}


mysqli_stmt_close($insert_stmt);

mysqli_close($conn);

?>

