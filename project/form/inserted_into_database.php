<?php

// session_start();

include("conection.php");

// Check whether first-page data exists
if (!isset($_SESSION['registration'])) {
    header("Location: regist.php");
    exit();
}

// Get first-page data from SESSION
$registration = $_SESSION['registration'];

if (isset($_POST['register'])) {

    //  FIRST PAGE DATA 

    $first_name = $registration['fname'];
    $middle_name = $registration['mname'];
    $last_name = $registration['lname'];
    $gender = $registration['gender'];
    $taddr = $registration['tadd'];
    $paddr = $registration['padd'];
    $father_name = $registration['father_name'];
    $mother_name = $registration['mother_name'];
    $grand_father_name = $registration['grand_father_name'];
    $email = $registration['email'];
    $password = $registration['password'];
    $contact = $registration['contact'];


    //  SECOND PAGE DATA 

    $citizenship_card_number = $_POST['citizenship_card_number'];
    $voter_id_number = $_POST['voter_id_number'];

    //  USER PHOTO 
    $tempname = $_FILES['user_photo']['tmp_name'];
    $filename = $_FILES['user_photo']['name'];
    $uploadfile = "user_photo/" . $filename;

    move_uploaded_file($tempname, $uploadfile);
    $_SESSION['user_photo'] = $uploadfile;


    //  CITIZENSHIP CARD 

    $tempname2 = $_FILES['citizen_card']['tmp_name'];
    $filename2 = $_FILES['citizen_card']['name'];
    $uploadfile2 = "citizen_card/" . $filename2;
    move_uploaded_file($tempname2, $uploadfile2);
    $_SESSION['citizen_card'] = $uploadfile2;

    //  VOTER ID 

    $tempname3 = $_FILES['voter_id']['tmp_name'];
    $filename3 = $_FILES['voter_id']['name'];
    $uploadfile3 = "voter_id/" . $filename3;
    move_uploaded_file($tempname3, $uploadfile3);
    $_SESSION['voter_id'] = $uploadfile3;

    //  INSERT INTO DATABASE 

    $insert_data = "INSERT INTO voter_register_table
    (
        first_name,
        middle_name,
        last_name,
        gender,
        temporary_addr,
        parmanent_addr,
        father_name,
        mother_name,
        grand_father_name,
        email,
        password,
        contact,
        user_photo,
        citizen_card_number,
        citizenship_card,
        voter_id_number,
        voter_id
    )
    VALUES
    (
        '$first_name',
        '$middle_name',
        '$last_name',
        '$gender',
        '$taddr',
        '$paddr',
        '$father_name',
        '$mother_name',
        '$grand_father_name',
        '$email',
        '$password',
        '$contact',
        '$uploadfile',
        '$citizenship_card_number',
        '$uploadfile2',
        '$voter_id_number',
        '$uploadfile3'
    )";


    $execute_data_intoDB = mysqli_query($conn, $insert_data);


    //  RESULT 

    if ($execute_data_intoDB) {

        // Remove first-page data from session
        // unset($_SESSION['registration']);

        echo "<script>
                alert('Registration successful');
                window.location.href='login.php';
              </script>";

        exit();

    } else {

        echo "Insert failed: " . mysqli_error($conn);

    }
}

?>