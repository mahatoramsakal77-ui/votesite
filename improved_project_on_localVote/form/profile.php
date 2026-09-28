
<?php

session_start();
include("conection.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


/* =====================================================
   GET VOTER ID
   ===================================================== */
$voter_id = $_SESSION["voter_id_number"] ?? null;

/* =====================================================
   GET ALL VOTES OF THIS VOTER
   ===================================================== */

$votes = [];

if ($voter_id) {

    $sql = "
        SELECT
            candidate_id,
            candidate_name,
            party_name,
            position,
            voted_at
        FROM votes
        WHERE voter_id_number = ?
        ORDER BY voted_at ASC
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {

        mysqli_stmt_bind_param(
            $stmt,
            "s",
            $voter_id
        );

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        while ($row = mysqli_fetch_assoc($result)) {
            $votes[$row["position"]] = $row;
        }

        mysqli_stmt_close($stmt);
    }
}


/* =====================================================
   GET EACH POSITION
   ===================================================== */

$mayor = $votes["Mayor"] ?? null;

$deputy_mayor =
    $votes["Deputy Mayor"] ?? null;

$ward_chairperson =
    $votes["Ward Chairperson"] ?? null;


/* =====================================================
   TOTAL VOTES OF CANDIDATE
   ===================================================== */

function getTotalVotes($conn, $candidate_id)
{
    $sql = "
        SELECT COUNT(*) AS total_votes
        FROM votes
        WHERE candidate_id = ?
    ";

    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        return 0;
    }

    mysqli_stmt_bind_param(
        $stmt,
        "i",
        $candidate_id
    );

    mysqli_stmt_execute($stmt);

    $result =
        mysqli_stmt_get_result($stmt);

    $data =
        mysqli_fetch_assoc($result);

    mysqli_stmt_close($stmt);

    return $data["total_votes"] ?? 0;
}


/* =====================================================
   COUNT VOTED POSITIONS
   ===================================================== */

$voted_count = count($votes);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Voter Dashboard</title>


<style>

/* =====================================================
   RESET
   ===================================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {

    font-family:
        Arial,
        Helvetica,
        sans-serif;

    background:
        #f4f6fb;

    color: #1f2937;

}


/* =====================================================
   TOP NAVIGATION
   ===================================================== */

.topbar {

    height: 70px;

    background: white;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 6%;

    box-shadow:
        0 2px 12px rgba(0,0,0,0.08);

    position: sticky;

    top: 0;

    z-index: 100;

}


.logo {

    display: flex;

    align-items: center;

    gap: 12px;

    font-size: 22px;

    font-weight: bold;

    color: #3730a3;

}


.logo_icon {

    width: 40px;

    height: 40px;

    border-radius: 10px;

    background:
        #4f46e5;

    color: white;

    display: flex;

    justify-content: center;

    align-items: center;

    font-size: 21px;

}


.back_btn {

    text-decoration: none;

    color: white;

    background: #4f46e5;

    padding: 11px 20px;

    border-radius: 9px;

    font-size: 14px;

    font-weight: 600;

    transition: 0.3s;

}


.back_btn:hover {

    background: #3730a3;

}


/* =====================================================
   MAIN CONTAINER
   ===================================================== */

.dashboard {

    width: 90%;

    max-width: 1200px;

    margin: 35px auto 60px;

}


/* =====================================================
   WELCOME
   ===================================================== */

.welcome {

    margin-bottom: 25px;

}


.welcome h1 {

    font-size: 30px;

    margin-bottom: 7px;

    color: #111827;

}


.welcome p {

    color: #6b7280;

    font-size: 15px;

}


/* =====================================================
   PROFILE HEADER
   ===================================================== */

.profile_header {

    background:
        linear-gradient(
            135deg,
            #4f46e5,
            #6366f1
        );

    border-radius: 18px;

    padding: 30px;

    color: white;

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 20px;

    box-shadow:
        0 10px 30px rgba(79,70,229,0.22);

}


.profile_identity {

    display: flex;

    align-items: center;

    gap: 20px;

}


.profile_image {

    width: 95px;

    height: 95px;

    border-radius: 50%;

    object-fit: cover;

    border: 4px solid white;

}


.profile_identity h2 {

    font-size: 25px;

    margin-bottom: 6px;

}


.profile_identity p {

    opacity: 0.9;

    font-size: 14px;

}


.profile_verified {

    background:
        rgba(255,255,255,0.16);

    border:
        1px solid rgba(255,255,255,0.25);

    padding: 12px 17px;

    border-radius: 12px;

    text-align: center;

}


.profile_verified strong {

    display: block;

    font-size: 22px;

}


.profile_verified span {

    font-size: 12px;

    opacity: 0.9;

}


/* =====================================================
   STATISTICS
   ===================================================== */

.stats {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 20px;

    margin-top: 25px;

}


.stat_card {

    background: white;

    padding: 22px;

    border-radius: 15px;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.06);

    border:
        1px solid #e5e7eb;

}


.stat_card span {

    color: #6b7280;

    font-size: 13px;

}


.stat_card h2 {

    margin-top: 8px;

    font-size: 28px;

    color: #111827;

}


/* =====================================================
   SECTION TITLE
   ===================================================== */

.section_title {

    margin-top: 40px;

    margin-bottom: 18px;

}


.section_title h2 {

    font-size: 22px;

    color: #111827;

}


.section_title p {

    color: #6b7280;

    margin-top: 5px;

    font-size: 14px;

}


/* =====================================================
   DOCUMENT CARDS
   ===================================================== */

.documents {

    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 22px;

}


.document_card {

    background: white;

    padding: 22px;

    border-radius: 15px;

    border:
        1px solid #e5e7eb;

    box-shadow:
        0 4px 15px rgba(0,0,0,0.06);

}


.document_title {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-bottom: 18px;

}


.document_icon {

    width: 38px;

    height: 38px;

    border-radius: 9px;

    background: #eef2ff;

    color: #4f46e5;

    display: flex;

    justify-content: center;

    align-items: center;

}


.document_title h3 {

    font-size: 17px;

}


.document_image {

    width: 100%;

    height: 210px;

    object-fit: cover;

    border-radius: 10px;

    border: 1px solid #e5e7eb;

}


.document_number {

    margin-top: 15px;

    background: #f8fafc;

    padding: 12px;

    border-radius: 8px;

    font-size: 14px;

    color: #475569;

}


.document_number strong {

    color: #111827;

}


/* =====================================================
   VOTING SECTION
   ===================================================== */

.voting_grid {

    display: grid;

    grid-template-columns:
        repeat(3, 1fr);

    gap: 20px;

}


.vote_card {

    background: white;

    border-radius: 16px;

    padding: 22px;

    border:
        1px solid #e5e7eb;

    box-shadow:
        0 5px 18px rgba(0,0,0,0.06);

    position: relative;

    overflow: hidden;

}


.vote_card::before {

    content: "";

    position: absolute;

    left: 0;

    top: 0;

    width: 100%;

    height: 4px;

    background: #4f46e5;

}


.position_label {

    color: #6b7280;

    font-size: 13px;

    font-weight: 600;

    text-transform: uppercase;

    letter-spacing: 0.5px;

}


.vote_candidate {

    margin-top: 18px;

}


.candidate_circle {

    width: 55px;

    height: 55px;

    border-radius: 50%;

    background: #eef2ff;

    color: #4f46e5;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 22px;

    font-weight: bold;

    margin-bottom: 12px;

}


.vote_candidate h3 {

    font-size: 20px;

    color: #111827;

    margin-bottom: 6px;

}


.party {

    font-size: 14px;

    color: #6b7280;

}


.status {

    display: inline-block;

    margin-top: 18px;

    padding: 7px 12px;

    border-radius: 20px;

    font-size: 12px;

    font-weight: bold;

}


.voted {

    background: #dcfce7;

    color: #166534;

}


.not_voted {

    background: #fef3c7;

    color: #92400e;

}


.vote_time {

    margin-top: 15px;

    padding-top: 13px;

    border-top:
        1px solid #e5e7eb;

    font-size: 12px;

    color: #6b7280;

}


.total_votes {

    margin-top: 7px;

    font-size: 14px;

    color: #374151;

}


.total_votes strong {

    color: #111827;

}


/* =====================================================
   FOOTER
   ===================================================== */

.footer {

    text-align: center;

    color: #9ca3af;

    font-size: 13px;

    margin-top: 50px;

    padding-top: 20px;

    border-top:
        1px solid #e5e7eb;

}


/* =====================================================
   RESPONSIVE
   ===================================================== */

@media (max-width: 900px) {

    .voting_grid {

        grid-template-columns: 1fr;

    }

    .stats {

        grid-template-columns:
            repeat(3, 1fr);

    }

}


@media (max-width: 700px) {

    .profile_header {

        flex-direction: column;

        align-items: flex-start;

    }

    .documents {

        grid-template-columns: 1fr;

    }

    .stats {

        grid-template-columns: 1fr;

    }

    .profile_identity {

        align-items: flex-start;

    }

}


@media (max-width: 500px) {

    .dashboard {

        width: 94%;

    }

    .profile_header {

        padding: 22px;

    }

    .profile_identity {

        flex-direction: column;

    }

    .profile_image {

        width: 80px;

        height: 80px;

    }

    .welcome h1 {

        font-size: 25px;

    }

}

</style>

</head>


<body>


<!-- =====================================================
     TOP BAR
     ===================================================== -->

<header class="topbar">

    <div class="logo">

        <div class="logo_icon">
            ✓
        </div>

        Voter Portal

    </div>


    <a
        href="../Home/home.php"
        class="back_btn"
    >
        ← Back to Home
    </a>

</header>



<main class="dashboard">


<!-- =====================================================
     WELCOME
     ===================================================== -->

<section class="welcome">

    <h1>
        Welcome back,
        <?php
        echo htmlspecialchars(
            $_SESSION['user_name']
        );
        ?>
    </h1>

    <p>
        Manage your voter information and view your voting activity.
    </p>

</section>



<!-- =====================================================
     PROFILE HEADER
     ===================================================== -->

<section class="profile_header">


    <div class="profile_identity">

        <img
            class="profile_image"

            src="<?php
            echo htmlspecialchars(
                $_SESSION['user_photo']
            );
            ?>"

            alt="Profile Photo"
        >


        <div>

            <h2>

                <?php
                echo htmlspecialchars(
                    $_SESSION['user_name']
                );
                ?>

            </h2>


            <p>

                <?php
                echo htmlspecialchars(
                    $_SESSION['email']
                );
                ?>

            </p>

        </div>

    </div>


    <div class="profile_verified">

        <strong>
            <?php echo $voted_count; ?>/3
        </strong>

        <span>
            Positions Voted
        </span>

    </div>


</section>



<!-- =====================================================
     STATISTICS
     ===================================================== -->

<section class="stats">


    <div class="stat_card">

        <span>
            Voter ID
        </span>

        <h2 style="font-size:18px;">

            <?php
            echo htmlspecialchars(
                $_SESSION['voter_id_number']
            );
            ?>

        </h2>

    </div>


    <div class="stat_card">

        <span>
            Citizenship Number
        </span>

        <h2 style="font-size:18px;">

            <?php
            echo htmlspecialchars(
                $_SESSION['citizen_card_number']
            );
            ?>

        </h2>

    </div>


    <div class="stat_card">

        <span>
            Voting Status
        </span>

        <h2 style="font-size:20px;">

            <?php

            if ($voted_count == 3) {

                echo "Completed";

            } elseif ($voted_count > 0) {

                echo "In Progress";

            } else {

                echo "Not Started";

            }

            ?>

        </h2>

    </div>


</section>



<!-- =====================================================
     DOCUMENTS
     ===================================================== -->

<div class="section_title">

    <h2>
        Verification Documents
    </h2>

    <p>
        Your registered identification information
    </p>

</div>


<section class="documents">


    <!-- CITIZENSHIP -->

    <div class="document_card">

        <div class="document_title">

            <div class="document_icon">
                ID
            </div>

            <h3>
                Citizenship Card
            </h3>

        </div>


        <img
            class="document_image"

            src="<?php
            echo htmlspecialchars(
                $_SESSION['citizen_card']
            );
            ?>"

            alt="Citizenship Card"
        >


        <div class="document_number">

            Citizenship Number:

            <strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION['citizen_card_number']
                );
                ?>

            </strong>

        </div>

    </div>



    <!-- VOTER ID -->

    <div class="document_card">

        <div class="document_title">

            <div class="document_icon">
                ✓
            </div>

            <h3>
                Voter ID
            </h3>

        </div>


        <img
            class="document_image"
            src="<?php
            echo htmlspecialchars(
                $_SESSION['voter_id']
            );
            ?>"
            alt="Voter ID">


        <div class="document_number">

            Voter ID Number:

            <strong>

                <?php
                echo htmlspecialchars(
                    $_SESSION['voter_id_number']
                );
                ?>

            </strong>

        </div>

    </div>


</section>



<!-- =====================================================
     VOTING INFORMATION
     ===================================================== -->

<div class="section_title">

    <h2>
        My Voting Activity
    </h2>

    <p>
        Your submitted votes for each election position
    </p>

</div>


<section class="voting_grid">


<!-- =====================================================
     MAYOR
     ===================================================== -->

<div class="vote_card">

    <span class="position_label">
        Local Election
    </span>

    <h3 style="margin-top:7px;">
        Mayor
    </h3>


    <?php if ($mayor) { ?>

        <div class="vote_candidate">

            <div class="candidate_circle">

                <?php
                echo strtoupper(
                    substr(
                        $mayor["candidate_name"],
                        0,
                        1
                    )
                );
                ?>

            </div>


            <h3>

                <?php
                echo htmlspecialchars(
                    $mayor["candidate_name"]
                );
                ?>

            </h3>


            <p class="party">

                <?php
                echo htmlspecialchars(
                    $mayor["party_name"]
                );
                ?>

            </p>


            <span class="status voted">
                ✓ Vote Submitted
            </span>


            <p class="vote_time">

                Voted on:

                <?php
                echo htmlspecialchars(
                    $mayor["voted_at"]
                );
                ?>

            </p>


            <p class="total_votes">

                Current Total Votes:

                <strong>

                    <?php
                    echo getTotalVotes(
                        $conn,
                        $mayor["candidate_id"]
                    );
                    ?>

                </strong>

            </p>

        </div>


    <?php } else { ?>

        <div class="vote_candidate">

            <div class="candidate_circle">
                —
            </div>

            <h3>
                No vote yet
            </h3>

            <p class="party">
                You have not voted for Mayor.
            </p>

            <span class="status not_voted">
                Not Voted
            </span>

        </div>

    <?php } ?>

</div>



<!-- =====================================================
     DEPUTY MAYOR
     ===================================================== -->

<div class="vote_card">

    <span class="position_label">
        Local Election
    </span>

    <h3 style="margin-top:7px;">
        Deputy Mayor
    </h3>


    <?php if ($deputy_mayor) { ?>

        <div class="vote_candidate">

            <div class="candidate_circle">

                <?php
                echo strtoupper(
                    substr(
                        $deputy_mayor["candidate_name"],
                        0,
                        1
                    )
                );
                ?>

            </div>


            <h3>

                <?php
                echo htmlspecialchars(
                    $deputy_mayor["candidate_name"]
                );
                ?>

            </h3>


            <p class="party">

                <?php
                echo htmlspecialchars(
                    $deputy_mayor["party_name"]
                );
                ?>

            </p>


            <span class="status voted">
                ✓ Vote Submitted
            </span>


            <p class="vote_time">

                Voted on:

                <?php
                echo htmlspecialchars(
                    $deputy_mayor["voted_at"]
                );
                ?>

            </p>


            <p class="total_votes">

                Current Total Votes:

                <strong>

                    <?php
                    echo getTotalVotes(
                        $conn,
                        $deputy_mayor["candidate_id"]
                    );
                    ?>

                </strong>

            </p>

        </div>


    <?php } else { ?>

        <div class="vote_candidate">

            <div class="candidate_circle">
                —
            </div>

            <h3>
                No vote yet
            </h3>

            <p class="party">
                You have not voted for Deputy Mayor.
            </p>

            <span class="status not_voted">
                Not Voted
            </span>

        </div>

    <?php } ?>

</div>



<!-- =====================================================
     WARD CHAIRPERSON
     ===================================================== -->

<div class="vote_card">

    <span class="position_label">
        Local Election
    </span>

    <h3 style="margin-top:7px;">
        Ward Chairperson
    </h3>


    <?php if ($ward_chairperson) { ?>

        <div class="vote_candidate">

            <div class="candidate_circle">

                <?php
                echo strtoupper(
                    substr(
                        $ward_chairperson["candidate_name"],
                        0,
                        1
                    )
                );
                ?>

            </div>


            <h3>

                <?php
                echo htmlspecialchars(
                    $ward_chairperson["candidate_name"]
                );
                ?>

            </h3>


            <p class="party">

                <?php
                echo htmlspecialchars(
                    $ward_chairperson["party_name"]
                );
                ?>

            </p>


            <span class="status voted">
                ✓ Vote Submitted
            </span>


            <p class="vote_time">

                Voted on:

                <?php
                echo htmlspecialchars(
                    $ward_chairperson["voted_at"]
                );
                ?>

            </p>


            <p class="total_votes">

                Current Total Votes:

                <strong>

                    <?php
                    echo getTotalVotes(
                        $conn,
                        $ward_chairperson["candidate_id"]
                    );
                    ?>

                </strong>

            </p>

        </div>


    <?php } else { ?>

        <div class="vote_candidate">

            <div class="candidate_circle">
                —
            </div>

            <h3>
                No vote yet
            </h3>

            <p class="party">
                You have not voted for Ward Chairperson.
            </p>

            <span class="status not_voted">
                Not Voted
            </span>

        </div>

    <?php } ?>

</div>


</section>



<!-- =====================================================
     FOOTER
     ===================================================== -->

<div class="footer">

    © 2026 Nepal Online Voting System
    · Secure Voter Dashboard

</div>


</main>


</body>

</html>

