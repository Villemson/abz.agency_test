# abz.agency_test

A simple Laravel 11 test project with image upload, REST API, and minimal frontend form.

---

## ✅ Summary of Features

### 🔧 Backend (Laravel 11 + XAMPP)

- REST API:
  - `GET /api/users` – Paginated user list (6 per page)
  - `GET /api/users/{id}` – Get a single user
  - `POST /api/users` – Create a new user with image upload
- Seeder with 45 realistic users using **Faker**
- Image handling:
  - Cropped to **70x70px**, centered
  - Converted to `.jpg`
  - Optimized using **TinyPNG API**
  - Stored in `public/storage/photos/`
- Database includes a `photo` field on the `users` table
- Uses `storage:link` for public file access

---

### 💻 Frontend

- Minimal Blade-based HTML form (`/form`):
  - Fields: `name`, `email`, `photo`
  - Submission via JavaScript **Fetch API**
  - JSON response displayed below the form
- User list page (`/users`):
  - Loads 6 users at a time
  - Displays name, email, and thumbnail
  - “Show more” button loads the next page via API

---

## 📂 Tech Stack

- **Laravel 11**
- **XAMPP (PHP 8.2+)**
- **MySQL**
- **Intervention Image** (for image cropping)
- **TinyPNG API** (for image optimization)
- **HTML + JavaScript** (no frontend framework)

---

## 🚀 Quick Start

```bash
git clone https://github.com/Villemson/abz.agency_test.git
cd abz.agency_test
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve

## 📄 Assignment Source

This project was developed as part of a test assignment for **[abz.agency](https://abz.agency)**.

OpenAPI documentation:  
[https://openapi_apidocs.abz.dev/frontend-test-assignment-v1](https://openapi_apidocs.abz.dev/frontend-test-assignment-v1)

## ⏱️ Development Notes

- Time spent: ~X hours
- Challenges faced:
  - TinyPNG integration and limits
  - Image manipulation (cropping & format)
  - Laravel 11 route structure (different from older Laravel)

> ⚠️ You must register a free API key at [https://tinypng.com/developers](https://tinypng.com/developers)  
> Then add it to your `.env` file as: `TINIFY_API_KEY=your_key_here`


