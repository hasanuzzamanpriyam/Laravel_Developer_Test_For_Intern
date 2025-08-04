
# 🌍 Country-State-City CRUD App (Laravel + jQuery + Bootstrap)

This is a dynamic **Country-State-City management system** built using **Laravel (API)**, **jQuery**, and **Bootstrap 5**. It supports creating, reading, updating, and deleting (CRUD) entries for countries, states, and cities, with intuitive dropdown dependencies and smooth UI interactions using SweetAlert and collapsible sections.

---

## ✨ Features

- ✅ CRUD operations for Countries, States, and Cities
- ✅ Cascading dropdowns: Country → State → City
- ✅ SweetAlert2 for modern alerts and confirmations
- ✅ Bootstrap 5 UI with collapsible cards
- ✅ Auto-fill form when editing
- ✅ Real-time updates with jQuery AJAX

---

## 📁 Tech Stack

| Layer       | Tech                     |
|-------------|--------------------------|
| Backend     | Laravel 11 API           |
| Frontend    | HTML, Bootstrap 5        |
| Interactivity | jQuery 3.6, SweetAlert2 |
| Database    | MySQL                    |

---

## 🚀 Getting Started

### 1. Clone the Repo

```bash
git clone https://github.com/hasanuzzamanpriyam/laravel-country-state-city-crud.git
cd laravel-country-state-city-crud
```

### 2. Install Dependencies

```bash
composer install
or
composer update
```

### 3. Setup `.env` and Database

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` file with your MySQL credentials:

```env
DB_DATABASE=your_db
DB_USERNAME=root
DB_PASSWORD=
```

Then run migrations:

```bash
php artisan migrate
```

### 4. Run the Application

```bash
php artisan serve
```

Visit: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 📂 Project Structure

```
├── public/
│   └── js/
│       └── crud.js          # All AJAX and form handling
|       └── css/
│       └── style.css          # Custom CSS
├── resources/
│   └── views/
│       └── index.blade.php  # Main frontend UI
├── routes/
│   └── api.php              # API routes
├── app/
│   └── Http/
│       └── Controllers/     # CountryController, StateController, CityController
```

---

## 🧠 API Endpoints

- `GET /api/countries`
- `POST /api/countries`
- `PUT /api/countries/{id}`
- `DELETE /api/countries/{id}`

Same for `/states` and `/cities`. You can also pass `?country_id=1` to filter states.

---

## 📸 Screenshots

| Manage Countries        | Manage Cities        |
|-------------------------|----------------------|
| ![Countries](screenshots/countries.png) | ![Cities](screenshots/cities.png) |

---

## 📌 To-Do

- [ ] Add search and pagination
- [ ] Add user authentication (optional)
- [ ] Migrate to Vue or React for SPA

---

## 🧑‍💻 Author

Made by [Hasanuzzaman Priyam](https://github.com/hasanuzzamanpriyam)

---

## 📜 License

This project is open-sourced under the [MIT License](LICENSE).
