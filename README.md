# Story API

REST API untuk aplikasi Story menggunakan Laravel 12 dengan autentikasi Sanctum.

## Requirements

- PHP >= 8.2
- Composer
- MySQL / SQLite

## Installation

1. Clone repository
```bash
git clone https://github.com/bahrie127/laravel-story-api.git
cd laravel-story-api
```

2. Install dependencies
```bash
composer install
```

3. Copy environment file
```bash
cp .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Configure database di file `.env`

6. Run migrations
```bash
php artisan migrate
```

7. Create storage link (untuk upload gambar)
```bash
php artisan storage:link
```

8. Run server
```bash
php artisan serve
```

## API Endpoints

### Authentication

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| POST | `/api/register` | Register user baru | No |
| POST | `/api/login` | Login user | No |
| POST | `/api/logout` | Logout user | Yes |
| GET | `/api/profile` | Get profile user | Yes |

### Stories

| Method | Endpoint | Description | Auth |
|--------|----------|-------------|------|
| GET | `/api/my-stories` | Get semua cerita user | Yes |
| POST | `/api/stories` | Buat cerita baru | Yes |
| PUT | `/api/stories/{id}` | Update cerita | Yes |
| DELETE | `/api/stories/{id}` | Hapus cerita | Yes |

## Request & Response Examples

### Register
```bash
POST /api/register
Content-Type: application/json

{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

### Login
```bash
POST /api/login
Content-Type: application/json

{
    "email": "john@example.com",
    "password": "password123"
}
```

### Create Story
```bash
POST /api/stories
Authorization: Bearer {token}
Content-Type: multipart/form-data

{
    "title": "Judul Cerita",
    "content": "Isi cerita...",
    "image": [file] // optional
}
```

## License

MIT License
