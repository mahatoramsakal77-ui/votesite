

const fname = document.querySelector("input[type = 'text'][name='fname']");
const mname = document.querySelector("input[type = 'text'][name='mname']");
const lname = document.querySelector("input[type = 'text'][name='lname']");
const gender = document.querySelectorAll("input[type = 'radio'][name='gender']");
const tadd = document.querySelector("input[type = 'text'][name='tadd']");
const padd = document.querySelector("input[type = 'text'][name='padd']");
const father_name = document.querySelector("input[type = 'text'][name='father_name']");
const mother_name = document.querySelector("input[type = 'text'][name='mother_name']");
const grand_father_name = document.querySelector("input[type = 'text'][name='grand_father_name']");
const email = document.querySelector("input[type = 'email'][name='email']");
const password = document.querySelector("input[type = 'password'][name='password']");
const contact = document.querySelector("input[type = 'text'][name='contact']");



let firstn_error = document.querySelector(".firstn");
let middlen_error = document.querySelector(".middlen");
let lastn_error = document.querySelector(".lastn");
let gen_error = document.querySelector(".gen_error");
let terror = document.querySelector(".t-add");
let perror = document.querySelector(".p-add");

let fathern_error = document.querySelector(".father_n");
let mothern_error = document.querySelector(".mother_n");
let grand_fathern_error = document.querySelector(".grand_father_n");
let em_error = document.querySelector(".em");
let pswd_error = document.querySelector(".pswd");
let cont_error = document.querySelector(".cont");




   

function validation() {
  let isvalid = true;

  // ...............................validation of first name
  if (fname.value.trim() == "") {
    firstn_error.innerText = "name is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s]+$/.test(fname.value)) {
    firstn_error.innerText = "name only contain letters";
    return (isvalid = false);
  } else if (fname.value.length <= 3) {
    firstn_error.innerText = "name is too short";
    return (isvalid = false);
  } else if (fname.value.length >= 40) {
    firstn_error.innerText = "name is too long";
    return (isvalid = false);
  } else {
    firstn_error.innerText = "";
  }

  
    // ...............................validation of last name
  if (lname.value.trim() == "") {
    lastn_error.innerText = "name is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s]+$/.test(lname.value)) {
    lastn_error.innerText = "name only contain letters";
    return (isvalid = false);
  } else if (lname.value.length <= 3) {
    lastn_error.innerText = "name is too short";
    return (isvalid = false);
  } else if (lname.value.length >= 40) {
    lastn_error.innerText = "name is too long";
    return (isvalid = false);
  } else {
    lastn_error.innerText = "";
  }
  
   // ...............................validation of gender selecting
  if (
    gender[0].checked == false &&
    gender[1].checked == false &&
    gender[2].checked == false
  ) {
    gen_error.innerText = "Please select a gender";
    return (isvalid = false);
  } else {
    gen_error.innerText = "";
  }

    // ...............................validation of temporary address

  if (tadd.value.trim() == "") {
    terror.innerText = "address is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s\-0-9]+$/.test(tadd.value)) {
    terror.innerText = "address does not contain special character";
    return (isvalid = false);
  } else if (tadd.value.length <= 2) {
    terror.innerText = "address is too short";
    return (isvalid = false);
  } else if (tadd.value.length >= 50) {
    terror.innerText = "address is too long";
    return (isvalid = false);
  } else {
    terror.innerText = "";
  }

  
    // ...............................validation of parmanent address
  if (padd.value.trim() == "") {
    perror.innerText = "address is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s\-0-9]+$/.test(padd.value)) {
    perror.innerText = "address does not contain special character";
    return (isvalid = false);
  } else if (padd.value.length <= 2) {
    perror.innerText = "address is too short";
    return (isvalid = false);
  } else if (padd.value.length >= 50) {
    perror.innerText = "address is too long";
    return (isvalid = false);
  } else {
    perror.innerText = "";
  }

  // validation of father name
  if (father_name.value.trim() == "") {
    fathern_error.innerText = "name is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s]+$/.test(father_name.value)) {
    fathern_error.innerText = "name only contain letters";
    return (isvalid = false);
  } else if (father_name.value.length <= 3) {
    fathern_error.innerText = "name is too short";
    return (isvalid = false);
  } else if (father_name.value.length >= 40) {
    fathern_error.innerText = "name is too long";
    return (isvalid = false);
  } else {
    fathern_error.innerText = "";
  }

// validaation  of mother name
  if (mother_name.value.trim() == "") {
    mothern_error.innerText = "name is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s]+$/.test(mother_name.value)) {
    mothern_error.innerText = "name only contain letters";
    return (isvalid = false);
  } else if (mother_name.value.length <= 3) {
    mothern_error.innerText = "name is too short";
    return (isvalid = false);
  } else if (mother_name.value.length >= 40) {
    mothern_error.innerText = "name is too long";
    return (isvalid = false);
  } else {
    mothern_error.innerText = "";
  }
// validationn of grand fahter name
if (grand_father_name.value.trim() == "") {
    grand_fathern_error.innerText = "name is required";
    return (isvalid = false);
  } else if (!/^[A-Za-z\s]+$/.test(grand_father_name.value)) {
    grand_fathern_error.innerText = "name only contain letters";
    return (isvalid = false);
  } else if (grand_father_name.value.length <= 3) {
    grand_fathern_error.innerText = "name is too short";
    return (isvalid = false);
  } else if (grand_father_name.value.length >= 40) {
    grand_fathern_error.innerText = "name is too long";
    return (isvalid = false);
  } else {
    grand_fathern_error.innerText = "";
  }


   // ...............................validation of email
  if (email.value.trim() == "") {
    em_error.innerText = "email is most required";
    return (isvalid = false);
  } else if (
    !/^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/.test(
      email.value)) {
    em_error.innerText = "please write valid email";
    return (isvalid = false);
  } else {
    em_error.innerText = "";
  }

  // ............................validation of password
  if(password.value.trim() == "")
  {
    pswd_error.innerText = "password is required ";
    return isvalid = false;
  }
  else if(password.value.length !== 8)
{
  pswd_error.innerText = "only 8 word of password";
  return isvalid = false;
  }
  else
  {
    pswd_error.innerText  = "";
  }
    // ...............................validation of contact
  if (contact.value.trim() == "") {
    cont_error.innerText = "contact is required";
    return (isvalid = false);
  } else if (!/^\d+$/.test(contact.value)) {
    cont_error.innerText = "contact only contain number";
    return (isvalid = false);
  } else if (contact.value.length !== 10) {
    cont_error.innerText = "contact number is not valid";
    return (isvalid = false);
  } else {
    cont_error.innerText = "";
  }
  return isvalid;
}

