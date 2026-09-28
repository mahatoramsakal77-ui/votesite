
<script>

const locations = <?php
    echo json_encode($locations);
?>;


const selectedProvince =
    <?php echo json_encode($province); ?>;

const selectedDistrict =
    <?php echo json_encode($district); ?>;

const selectedMunicipality =
    <?php echo json_encode($municipality); ?>;

const selectedWard =
    <?php echo json_encode($ward); ?>;


// ======================================================
// LOAD DISTRICTS
// ======================================================

function loadDistricts()
{

    const province =
        document.getElementById("province").value;

    const districtSelect =
        document.getElementById("district");

    const municipalitySelect =
        document.getElementById("municipality");

    const wardSelect =
        document.getElementById("ward");


    districtSelect.innerHTML =
        '<option value="">Select District</option>';

    municipalitySelect.innerHTML =
        '<option value="">Select Municipality</option>';

    wardSelect.innerHTML =
        '<option value="">Select Ward</option>';


    if (
        province &&
        locations[province]
    ) {

        Object.keys(
            locations[province]
        ).forEach(function(district)
        {

            const option =
                document.createElement("option");

            option.value = district;

            option.textContent = district;

            if (
                district === selectedDistrict &&
                province === selectedProvince
            ) {

                option.selected = true;

            }

            districtSelect.appendChild(option);

        });

    }

}


// ======================================================
// LOAD MUNICIPALITIES
// ======================================================

function loadMunicipalities()
{

    const province =
        document.getElementById("province").value;

    const district =
        document.getElementById("district").value;

    const municipalitySelect =
        document.getElementById("municipality");

    const wardSelect =
        document.getElementById("ward");


    municipalitySelect.innerHTML =
        '<option value="">Select Municipality</option>';

    wardSelect.innerHTML =
        '<option value="">Select Ward</option>';


    if (
        province &&
        district &&
        locations[province] &&
        locations[province][district]
    ) {

        Object.keys(
            locations[province][district]
        ).forEach(function(municipality)
        {

            const option =
                document.createElement("option");

            option.value =
                municipality;

            option.textContent =
                municipality;


            if (
                municipality === selectedMunicipality &&
                district === selectedDistrict &&
                province === selectedProvince
            ) {

                option.selected = true;

            }


            municipalitySelect.appendChild(
                option
            );

        });

    }

}


// ======================================================
// LOAD WARDS
// ======================================================

function loadWards()
{

    const province =
        document.getElementById("province").value;

    const district =
        document.getElementById("district").value;

    const municipality =
        document.getElementById("municipality").value;

    const wardSelect =
        document.getElementById("ward");


    wardSelect.innerHTML =
        '<option value="">Select Ward</option>';


    if (
        province &&
        district &&
        municipality &&
        locations[province] &&
        locations[province][district] &&
        locations[province][district][municipality]
    ) {

        locations[province][district][municipality]
            .forEach(function(ward)
            {

                const option =
                    document.createElement("option");

                option.value = ward;

                option.textContent =
                    "Ward " + ward;


                if (
                    String(ward) ===
                    String(selectedWard)
                ) {

                    option.selected = true;

                }


                wardSelect.appendChild(
                    option
                );

            });

    }

}


// ======================================================
// LOAD DEFAULT SELECTED LOCATION
// ======================================================

window.addEventListener(
    "DOMContentLoaded",
    function()
    {

        loadDistricts();

        loadMunicipalities();

        loadWards();

    }
);

</script>
