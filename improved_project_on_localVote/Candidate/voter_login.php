<?php

session_start();

include("../form/conection.php");

$login_success = false;
$error_message = "";


// ======================================================
// 0. CHECK NORMAL USER LOGIN
// ======================================================

if (
    !isset($_SESSION["email"]) ||
    !isset($_SESSION["user_voter_id"]) ||
    !isset($_SESSION["user_citizenship_number"])
) {

    $error_message =
        "Please login with your registered account before voting.";
}


// ======================================================
// 1. GET SELECTED CANDIDATE
// ======================================================

if (isset($_POST["select_candidate"])) {

    // Check that all candidate information was received
    if (
        !isset($_POST["candidate_id"]) ||
        !isset($_POST["candidate_name"]) ||
        !isset($_POST["party_name"]) ||
        !isset($_POST["position"])
    ) {
        die("Candidate information is missing.");
    }


    $_SESSION["candidate_id"] =
        $_POST["candidate_id"];

    $_SESSION["candidate_name"] =
        $_POST["candidate_name"];

    $_SESSION["party_name"] =
        $_POST["party_name"];

    $_SESSION["position"] =
        $_POST["position"];


    // ==================================================
    // ELECTION LOCATION
    // ==================================================

    if (
        isset($_POST["province"]) &&
        isset($_POST["district"]) &&
        isset($_POST["municipality"]) &&
        isset($_POST["ward"])
    ) {

        $_SESSION["province"] =
            $_POST["province"];

        $_SESSION["district"] =
            $_POST["district"];

        $_SESSION["municipality"] =
            $_POST["municipality"];

        $_SESSION["ward"] =
            $_POST["ward"];

    } else {

        die("Election location information is missing.");
    }
}


// ======================================================
// 2. CHECK WHETHER CANDIDATE IS SELECTED
// ======================================================

if (
    !isset($_SESSION["candidate_id"]) ||
    !isset($_SESSION["candidate_name"]) ||
    !isset($_SESSION["party_name"]) ||
    !isset($_SESSION["position"])
) {

    die("No candidate selected.");
}


// ======================================================
// 3. VOTER LOGIN
// ======================================================

if (isset($_POST["voter_login"])) {

    $citizenship_card_number =
        trim($_POST["citizenship_card_number"]);

    $voter_id_number =
        trim($_POST["voter_id_number"]);


    // ==================================================
    // CHECK EMPTY INPUT
    // ==================================================

    if (
        empty($citizenship_card_number) ||
        empty($voter_id_number)
    ) {

        $error_message =
            "Please enter Citizenship Number and Voter ID.";

    } else {


        // ==============================================
        // CHECK VOTER INFORMATION IN DATABASE
        // ==============================================

        $sql = "
            SELECT *
            FROM voter_register_table
            WHERE citizen_card_number = ?
            AND voter_id_number = ?
        ";


        $stmt = mysqli_prepare($conn, $sql);


        if ($stmt) {

            mysqli_stmt_bind_param(
                $stmt,
                "ss",
                $citizenship_card_number,
                $voter_id_number
            );


            mysqli_stmt_execute($stmt);


            $result =
                mysqli_stmt_get_result($stmt);


            // ==========================================
            // VOTER FOUND
            // ==========================================

            if (mysqli_num_rows($result) == 1) {

                $user =
                    mysqli_fetch_assoc($result);


                // ==========================================
                // IMPORTANT:
                // CHECK LOGGED-IN USER AND VOTER ARE SAME
                // ==========================================

                if (
                    $_SESSION["user_voter_id"] !==
                    $user["voter_id_number"]
                ) {

                    $error_message =
                        "The voter information does not belong to the logged-in user.";

                    $login_success = false;

                }

                elseif (
                    $_SESSION["user_citizenship_number"] !==
                    $user["citizen_card_number"]
                ) {

                    $error_message =
                        "The citizenship information does not belong to the logged-in user.";

                    $login_success = false;

                }

                else {

                    // ==========================================
                    // SAME USER - STORE VOTER INFORMATION
                    // ==========================================

                    $_SESSION["voter_id"] =
                        $user["voter_id_number"];

                    $_SESSION["citizenship_number"] =
                        $user["citizen_card_number"];


                    // ==========================================
                    // CHECK ALREADY VOTED FOR THIS POSITION
                    // ==========================================

                    $check_vote_sql = "
                        SELECT id
                        FROM votes
                        WHERE voter_id_number = ?
                        AND position = ?
                        LIMIT 1
                    ";


                    $check_vote_stmt =
                        mysqli_prepare(
                            $conn,
                            $check_vote_sql
                        );


                    if ($check_vote_stmt) {

                        mysqli_stmt_bind_param(
                            $check_vote_stmt,
                            "ss",
                            $_SESSION["voter_id"],
                            $_SESSION["position"]
                        );


                        mysqli_stmt_execute(
                            $check_vote_stmt
                        );


                        mysqli_stmt_store_result(
                            $check_vote_stmt
                        );


                        // ======================================
                        // ALREADY VOTED
                        // ======================================

                        if (
                            mysqli_stmt_num_rows(
                                $check_vote_stmt
                            ) > 0
                        ) {

                            $error_message =
                                "You have already voted for " .
                                $_SESSION["position"] . ".";

                            $login_success = false;

                        }


                        // ======================================
                        // HAS NOT VOTED
                        // ======================================

                        else {

                            $login_success = true;
                        }


                        mysqli_stmt_close(
                            $check_vote_stmt
                        );


                    } else {

                        $error_message =
                            "Unable to check voting status.";
                    }
                }
            }


            // ==========================================
            // VOTER NOT FOUND
            // ==========================================

            else {

                $error_message =
                    "Invalid Citizenship Number or Voter ID.";
            }


            mysqli_stmt_close($stmt);


        } else {

            $error_message =
                "Database query failed.";
        }
    }
}

?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Voter Login</title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            font-family: Arial, sans-serif;

            background: #f2f2f2;
        }


        .login_box {

            width: 400px;

            max-width: 90%;

            background: white;

            padding: 30px;

            border-radius: 15px;

            box-shadow:
                0 5px 20px rgba(0,0,0,0.2);
        }


        .login_box h1 {

            text-align: center;

            margin-bottom: 25px;
        }


        .selected_candidate {

            background: #f3f1ff;

            padding: 15px;

            border-radius: 10px;

            margin-bottom: 20px;
        }


        .selected_candidate h3 {

            margin-top: 0;
        }


        .selected_candidate p {

            margin: 7px 0;
        }


        label {

            display: block;

            margin-top: 15px;

            margin-bottom: 5px;

            font-weight: bold;
        }


        input {

            width: 100%;

            padding: 12px;

            border: 1px solid #ccc;

            border-radius: 7px;

            font-size: 16px;
        }


        .login_button {

            width: 100%;

            margin-top: 25px;

            padding: 12px;

            border: none;

            border-radius: 8px;

            background: #7569f0;

            color: white;

            font-size: 17px;

            cursor: pointer;
        }


        .login_button:hover {

            background: #594ce0;
        }


        .error {

            background: #ffdede;

            color: #b00000;

            padding: 10px;

            border-radius: 7px;

            margin-bottom: 15px;

            text-align: center;
        }


        /* Confirmation popup */

        .confirm_vote_message {

            position: fixed;

            top: 0;

            left: 0;

            width: 100%;

            height: 100%;

            background: rgba(0,0,0,0.65);

            display: flex;

            justify-content: center;

            align-items: center;

            z-index: 1000;
        }


        .confirm_content {

            width: 420px;

            max-width: 90%;

            background: white;

            padding: 30px;

            border-radius: 15px;

            text-align: center;
        }


        .confirm_content h2 {

            margin-top: 0;
        }


        .candidate_name {

            font-size: 22px;

            font-weight: bold;
        }


        .confirm_bottom {

            display: flex;

            justify-content: center;

            gap: 15px;

            margin-top: 25px;
        }


        .cancel,
        .confirm {

            padding: 10px 25px;

            border: none;

            border-radius: 7px;

            color: white;

            font-size: 16px;

            cursor: pointer;
        }


        .cancel {

            background: #777;
        }


        .confirm {

            background: #28a745;
        }

    </style>

</head>


<body>


<div class="login_box">

    <h1>Voter Verification</h1>


    <!-- SELECTED CANDIDATE -->

    <div class="selected_candidate">

        <h3>Selected Candidate</h3>


        <p>

            Candidate:

            <strong>

                <?php

                echo htmlspecialchars(
                    $_SESSION["candidate_name"]
                );

                ?>

            </strong>

        </p>


        <p>

            Party:

            <strong>

                <?php

                echo htmlspecialchars(
                    $_SESSION["party_name"]
                );

                ?>

            </strong>

        </p>


        <p>

            Position:

            <strong>

                <?php

                echo htmlspecialchars(
                    $_SESSION["position"]
                );

                ?>

            </strong>

        </p>

    </div>


    <!-- ERROR MESSAGE -->

    <?php if (!empty($error_message)) { ?>

        <div class="error">

            <?php

            echo htmlspecialchars(
                $error_message
            );

            ?>

        </div>

    <?php } ?>


    <!-- VOTER LOGIN FORM -->

    <form
        action=""
        method="POST"
    >

        <label>
            Citizenship Number
        </label>


        <input
            type="text"
            name="citizenship_card_number"
            placeholder="Enter Citizenship Number"
            required
        >


        <label>
            Voter ID Number
        </label>


        <input
            type="text"
            name="voter_id_number"
            placeholder="Enter Voter ID Number"
            required
        >


        <button
            type="submit"
            name="voter_login"
            class="login_button"
        >

            Verify Voter

        </button>

    </form>

</div>


<?php if ($login_success == true) { ?>

    <!-- ==============================================
         CONFIRMATION POPUP
    =============================================== -->

    <section
        class="confirm_vote_message"
        id="confirmBox"
    >

        <div class="confirm_content">

            <h2>
                Confirm Your Vote
            </h2>


            <p>
                You are voting for:
            </p>


            <p class="candidate_name">

                <?php

                echo htmlspecialchars(
                    $_SESSION["candidate_name"]
                );

                ?>

            </p>


            <p>

                Party:

                <strong>

                    <?php

                    echo htmlspecialchars(
                        $_SESSION["party_name"]
                    );

                    ?>

                </strong>

            </p>


            <p>

                Position:

                <strong>

                    <?php

                    echo htmlspecialchars(
                        $_SESSION["position"]
                    );

                    ?>

                </strong>

            </p>


            <div class="confirm_bottom">

                <button
                    type="button"
                    class="cancel"
                    onclick="cancelVote()"
                >

                    Cancel

                </button>


                <button
                    type="button"
                    class="confirm"
                    onclick="confirmVote()"
                >

                    Confirm

                </button>

            </div>

        </div>

    </section>

<?php } ?>


<script>

function confirmVote()
{
    window.location.href = "vote_process.php";
}


function cancelVote()
{
    window.location.href = "index.php";
}

</script>


</body>

</html>

