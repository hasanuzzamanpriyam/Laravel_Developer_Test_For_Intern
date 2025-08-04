<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>🌍 Country-State-City Manager</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>
    <div class="container py-5">
        <h2 class="text-center section-title mb-5 text-success">🌍 Country-State-City Manager</h2>

        <!-- Country Section -->
        <div class="card glass-card mb-4">
            <div class="card-header bg-primary text-white d-flex align-items-center" data-bs-toggle="collapse"
                data-bs-target="#collapseCountries" role="button" aria-expanded="false"
                aria-controls="collapseCountries" style="cursor: pointer;">
                <span><i class="bi bi-map-fill me-2"></i> Manage Countries</span>
                <i class="bi bi-chevron-down ms-auto" id="countryChevron"></i>
            </div>
            <div class="card-body collapse" id="collapseCountries">
                <form id="countryForm" class="row g-3">
                    <input type="hidden" id="country_id">
                    <div class="col-md-9">
                        <input type="text" id="country_name" class="form-control" placeholder="Enter country name">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Save Country</button>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Country Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="countryTable"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- State Section -->
        <div class="card glass-card mb-4">
            <div class="card-header bg-success text-white d-flex align-items-center" data-bs-toggle="collapse"
                data-bs-target="#collapseStates" role="button" aria-expanded="false" aria-controls="collapseStates"
                style="cursor: pointer;">
                <span><i class="bi bi-map-fill me-2"></i> Manage States</span>
        <i class="bi bi-chevron-down ms-auto" id="stateChevron"></i>
            </div>
            <div class="card-body collapse" id="collapseStates">
                <form id="stateForm" class="row g-3">
                    <div class="col-md-4">
                        <select id="state_country_id" class="form-select">
                            <option value="">-- Select Country --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="hidden" id="state_id">
                        <input type="text" id="state_name" class="form-control" placeholder="Enter state name">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success w-100">Save State</button>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>State Name</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="stateTable"></tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- City Section -->
        <div class="card glass-card mb-4">
            <div class="card-header bg-warning text-dark d-flex align-items-center" data-bs-toggle="collapse"
                data-bs-target="#collapseCities" role="button" aria-expanded="false" aria-controls="collapseCities"
                style="cursor: pointer;">
                <span><i class="bi bi-map-fill me-2"></i> Manage Cities</span>
                <i class="bi bi-chevron-down ms-auto" id="cityChevron"></i>
            </div>
            <div class="card-body collapse" id="collapseCities">
                <form id="cityForm" class="row g-3">
                    <div class="col-md-3">
                        <select id="city_country_id" class="form-select">
                            <option value="">-- Select Country --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select id="city_state_id" class="form-select">
                            <option value="">-- Select State --</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" id="city_id">
                        <input type="text" id="city_name" class="form-control" placeholder="Enter city name">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success w-100">Save City</button>
                    </div>
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>City Name</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="cityTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/crud.js') }}"></script>

    <script>
        // Country collapse functionality
        const collapseCountries = document.getElementById('collapseCountries');
        collapseCountries.addEventListener('show.bs.collapse', () => {
            document.getElementById('countryChevron').classList.replace('bi-chevron-down', 'bi-chevron-up');
        });
        collapseCountries.addEventListener('hide.bs.collapse', () => {
            document.getElementById('countryChevron').classList.replace('bi-chevron-up', 'bi-chevron-down');
        });
        // State collapse functionality
        const collapseStates = document.getElementById('collapseStates');
        collapseStates.addEventListener('show.bs.collapse', () => {
            document.getElementById('stateChevron').classList.replace('bi-chevron-down', 'bi-chevron-up');
        });
        collapseStates.addEventListener('hide.bs.collapse', () => {
            document.getElementById('stateChevron').classList.replace('bi-chevron-up', 'bi-chevron-down');
        });
        // City collapse functionality
        const collapseCities = document.getElementById('collapseCities');
        collapseCities.addEventListener('show.bs.collapse', () => {
            document.getElementById('cityChevron').classList.replace('bi-chevron-down', 'bi-chevron-up');
        });
        collapseCities.addEventListener('hide.bs.collapse', () => {
            document.getElementById('cityChevron').classList.replace('bi-chevron-up', 'bi-chevron-down');
        });
    </script>
</body>

</html>
