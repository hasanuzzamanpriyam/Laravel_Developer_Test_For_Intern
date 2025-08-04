const apiBase = "/api";
$.ajaxSetup({
    headers: {
        'Accept': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'contentType': 'application/json'
    }
});

// Load all countries on page load
$(document).ready(function () {
    loadCountries();
    loadStates();
    loadCities();

    // Load States when a country is selected (for dropdowns)
    $("#city_country_id").change(function () {
        let countryId = $(this).val();
        if (countryId) {
            $.get(`${apiBase}/states?country_id=${countryId}`, function (states) {
                $("#city_state_id").empty().append('<option value="">-- Select State --</option>');
                states.data.forEach(state => {
                    $("#city_state_id").append(`<option value="${state.id}">${state.name}</option>`);
                });
            });
        }
    });

    // Country CRUD
    $("#countryForm").submit(function (e) {
        e.preventDefault();
        let id = $("#country_id").val();
        let name = $("#country_name").val();
        let method = id ? "PUT" : "POST";
        let url = id ? `${apiBase}/countries/${id}` : `${apiBase}/countries`;

        $.ajax({
            url: url,
            type: method,
            contentType: "application/json",   // tell Laravel we are sending JSON
            data: JSON.stringify({ name: name }), // send as JSON
            success: function () {
                Swal.fire("✅ Saved!", "Country saved successfully.", "success");
                $("#country_id").val("");
                $("#country_name").val("");
                loadCountries();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                Swal.fire("❌ Error", "Failed to save country", "error");
            }
        });

    });

    // State CRUD
    $("#stateForm").submit(function (e) {
        e.preventDefault();
        let id = $("#state_id").val();
        let name = $("#state_name").val();
        let country_id = $("#state_country_id").val();
        let method = id ? "PUT" : "POST";
        let url = id ? `${apiBase}/states/${id}` : `${apiBase}/states`;

        $.ajax({
            url: url,
            type: method,
            data: { name, country_id },
            success: function () {
                Swal.fire("✅ Saved!", "State saved successfully.", "success");
                $("#state_id").val("");
                $("#state_name").val("");
                loadStates();
            }
        });
    });

    // City CRUD
    $("#cityForm").submit(function (e) {
        e.preventDefault();
        let id = $("#city_id").val();
        let name = $("#city_name").val();
        let state_id = $("#city_state_id").val();
        let method = id ? "PUT" : "POST";
        let url = id ? `${apiBase}/cities/${id}` : `${apiBase}/cities`;

        $.ajax({
            url: url,
            type: method,
            contentType: "application/json",
            data: JSON.stringify({ name, state_id }),
            success: function () {
                Swal.fire("✅ Saved!", "City saved successfully.", "success");
                $("#city_id").val("");
                $("#city_name").val("");
                loadCities();
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                Swal.fire("❌ Error", "Failed to save or update city", "error");
            }
        });
    });
});

// Load Countries + Populate Dropdowns
function loadCountries() {
    $.get(`${apiBase}/countries`, function (res) {
        let table = "";
        $("#state_country_id, #city_country_id").empty().append('<option value="">-- Select Country --</option>');

        res.data.forEach(country => {
            table += `
                <tr>
                    <td>${country.id}</td>
                    <td>${country.name}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editCountry(${country.id}, '${country.name}')"><i class="bi bi-pen"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteCountry(${country.id})"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;
            $("#state_country_id, #city_country_id").append(`<option value="${country.id}">${country.name}</option>`);
        });
        $("#countryTable").html(table);
    });
}

// Load States (optional: for listing)
function loadStates() {
    $.get(`${apiBase}/states`, function (res) {
        let table = "";
        (res.data || res).forEach(state => {
            table += `
                <tr>
                    <td>${state.id}</td>
                    <td>${state.name}</td>
                    <td>${state.country ? state.country.name : 'N/A'}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editState(${state.id}, '${state.name}', ${state.country_id})"><i class="bi bi-pen"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteState(${state.id})"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;
        });
        $("#stateTable").html(table);
    });
}

// Load Cities (optional: for listing)
function loadCities() {
    $.get(`${apiBase}/cities`, function (res) {
        let table = "";
        res.data.forEach(city => {
            table += `
                <tr>
                    <td>${city.id}</td>
                    <td>${city.name}</td>
                    <td>${city.state ? city.state.name : 'N/A'}</td>
                    <td>${city.state && city.state.country ? city.state.country.name : 'N/A'}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editCity(${city.id}, '${city.name}', ${city.state_id})"><i class="bi bi-pen"></i></button>
                        <button class="btn btn-danger btn-sm" onclick="deleteCity(${city.id})"><i class="bi bi-trash"></i></button>
                    </td>
                </tr>`;
        });
        $("#cityTable").html(table);
    });
}


// Edit Country
function editCountry(id, name) {
    $("#country_id").val(id);          // fill hidden field with id
    $("#country_name").val(name);      // fill input field with name
}

// Delete Country
function deleteCountry(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the country.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${apiBase}/countries/${id}`,
                type: "DELETE",
                success: function () {
                    Swal.fire("🗑️ Deleted!", "Country has been removed.", "success");
                    loadCountries();
                    loadStates();
                    loadCities();
                }
            });
        }
    });
}


// Edit State
function editState(id, name, country_id) {
    $("#state_id").val(id);
    $("#state_name").val(name);
    $("#state_country_id").val(country_id);
}

// Delete State
function deleteState(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the state.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${apiBase}/states/${id}`,
                type: "DELETE",
                success: function () {
                    Swal.fire("🗑️ Deleted!", "State has been removed.", "success");
                    loadCountries();
                    loadStates();
                    loadCities();
                }
            });
        }
    });
}

// Edit City
function editCity(id, name, state_id) {
    // Fetch city info along with its state and country
    $.get(`${apiBase}/cities/${id}`, function (res) {
        const city = res.data;

        $("#city_id").val(city.id);
        $("#city_name").val(city.name);

        // Set country dropdown
        $("#city_country_id").val(city.state.country.id).trigger("change");

        // After a slight delay (to allow state dropdown to populate)
        setTimeout(() => {
            $("#city_state_id").val(city.state.id);
        }, 300);
    });
}


// Delete City
function deleteCity(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "This will permanently delete the country.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `${apiBase}/cities/${id}`,
                type: "DELETE",
                success: function () {
                    Swal.fire("🗑️ Deleted!", "City has been removed.", "success");
                    loadCountries();
                    loadStates();
                    loadCities();
                }
            });
        }
    });
}
