
// // when user select province the automatically shows related province's districts.........................
const province = document.getElementById("province");
const district = document.getElementById("district");
const municipality = document.getElementById("municipality");
const ward = document.getElementById("ward");
// .. ....................................................koshi District
const koshi_district = ["Bhojpur","Dhankuta","Ilam","Jhapa","Khotang","Morang","Okhaldhunga","Panchthar",
"Sankhuwasabha","Solukhumbu","Sunsari","Taplejung","Tehrathum","Udayapur"];
// ...................................................madhesh districts
const madhesh_district = ["Parsa","Bara","Rautahat","Sarlahi","Mahottari","Dhanusha","Siraha","Saptari"];
// ..........................................................bagamti districts
const bagmati_district = ["Bhaktapur","Chitwan","Dhading","Dolakha","Kathmandu","Kavrepalanchok",
"Lalitpur","Makwanpur","Nuwakot","Ramechhap","Rasuwa","Sindhuli","Sindhupalchok"];
// .........................................................gandaki districts
const gandaki_district = ["Baglung","Gorkha","Kaski","Lamjung","Manang","Mustang","Myagdi","Nawalpur",  "Parbat", "Syangja","Tanahun"];
// ...........................................................lumbani districts
const lumbani_district = ["Arghakhanchi","Banke","Bardiya","Dang","Eastern Rukum","Gulmi","Kapilvastu","Nawalparasi West","Palpa","Pyuthan","Rolpa","Rupandehi"];
// ...................................................................sudurpaschim districts
const sudurpaschim_district = [ "Achham","Baitadi","Bajhang","Bajura","Dadeldhura","Darchula","Doti",
"Kailali","Kanchanpur"];
// ......................................................................karnali districts
const karnali_district = [ "Dailekh","Dolpa","Humla","Jajarkot","Jumla","Kalikot","Mugu","Rukum West",
"Salyan","Surkhet"];

province.addEventListener("change", () => {
    district.innerHTML = "<option value=''>Select District</option>";
    let selectedDistricts = [];

    if (province.value === "koshi") {
        selectedDistricts = koshi_district;
    }

    else if (province.value === "madhesh") {
        selectedDistricts = madhesh_district;
    }

    else if (province.value === "bagmati") {
        selectedDistricts = bagmati_district;
    }

    else if (province.value === "gandaki") {
        selectedDistricts = gandaki_district;
    }

    else if (province.value === "lumbani") {
        selectedDistricts = lumbani_district;
    }

    else if (province.value === "karnali") {
        selectedDistricts = karnali_district;
    }

    else if (province.value === "sudurpaschim") {
        selectedDistricts = sudurpaschim_district;
    }
    selectedDistricts.forEach(item => {
        const option = document.createElement("option");
        option.value = item;
        option.textContent = item;
        district.appendChild(option);
    });
});


// .................................................................madhesh districts metrocity
const dhanusha = [
  "Janakpurdham Sub-Metropolitan City",
    "Bideha Municipality",
    "Chhireshwornath Municipality",
    "Dhanushadham Municipality",
    "Ganeshman Charnath Municipality",
    "Hansapur Municipality",
    "Kamala Municipality",
    "Mithila Municipality",
    "Mithila Bihari Municipality",
    "Nagarain Municipality",
    "Sabaila Municipality",
    "Shahidnagar Municipality",
    "Aurahi Rural Municipality",
    "Bateshwar Rural Municipality",
    "Janaknandini Rural Municipality",
    "Lakshminiya Rural Municipality",
    "Mukhiyapatti Musaharmiya Rural Municipality",
    "Dhanauji Rural Municipality"
];
district.addEventListener("change", () => {
    municipality.innerHTML = "<option>Select Municipality</option>";

    if (district.value === "Dhanusha") {
        dhanusha.forEach(places => {
            const placeOption = document.createElement("option");
            placeOption.value = places;
            placeOption.textContent = places;
            municipality.appendChild(placeOption);
        });
    }
});
// ........................................................ward nagrain municipality  ward
const nagarain_wards = [ 1,2,3,4,5,6,7,8,9];
municipality.addEventListener("change", () => {
  ward.innerHTML = "<option>Select Municipality</option>";
  if(municipality.value === "Nagarain Municipality")
  {
   nagarain_wards.forEach(wards => {
     const option = document.createElement("option");
    option.value =wards;
    option.textContent = wards;
    ward.appendChild(option);
   }) ;
  }
});








// ........................................when use click on submit button shows thier candidaaates
const candidate = document.querySelector(".candidates");
const submit = document.querySelector(".submit_btn");

submit.addEventListener("click", () => {
    candidate.classList.add("shows");
})