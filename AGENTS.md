# AGENTS.md

## Project Overview

This is a Laravel 12 web application for Ratnalisa Clinic.

The system allows:

- Patients to register and login
- Patients to book medical inspections online
- Patients to choose one or more services
- Staff/Admin to manage services, categories, registrations, and payments
- Patients to view registration history and payment status

Use Indonesian language for UI labels and messages.

---

## Technology Stack

- Laravel 13
- PHP 8.4+
- MySQL
- Blade Templates
- Bootstrap 5
- Eloquent ORM

---

## Architecture Rules

Follow Laravel conventions.

Use:

- Models
- Controllers
- Form Requests for validation
- Resourceful routes
- Eloquent Relationships

Avoid:

- Raw SQL unless necessary
- Business logic inside Blade views
- Large controllers

Move business logic to:

- Services
- Model methods
- Helper classes

---

## Authentication

There are two user types:

### Pasien

Can:

- Register
- Login
- View homepage
- Edit profile
- Create pendaftaran
- View history
- View payment status

### Petugas

Can:

- Login
- Manage kategori layanan
- Manage layanan
- Manage pendaftaran
- Manage pembayaran
- Update registration status

Use middleware to protect routes.

---

## Database Specification Rules

All code generated must follow the database specification exactly.

### Pasien

| Field         | Type         |
| ------------- | ------------ |
| id_pasien     | varchar(10)  |
| nama          | varchar(100) |
| email         | varchar(100) |
| password      | varchar(255) |
| no_hp         | varchar(15)  |
| tgl_lahir     | date         |
| jenis_kelamin | enum         |
| alamat        | text         |

### Petugas

| Field      | Type         |
| ---------- | ------------ |
| id_petugas | varchar(5)   |
| nama       | varchar(100) |
| username   | varchar(50)  |
| password   | varchar(255) |
| role       | enum         |

### KategoriLayanan

| Field         | Type         |
| ------------- | ------------ |
| id_kategori   | varchar(3)   |
| nama_kategori | varchar(100) |
| keterangan    | text         |

### Layanan

| Field        | Type          |
| ------------ | ------------- |
| id_layanan   | varchar(5)    |
| id_kategori  | varchar(3)    |
| nama_layanan | varchar(100)  |
| harga        | decimal(12,2) |
| status       | enum          |

### Pendaftaran

| Field          | Type        |
| -------------- | ----------- |
| id_pendaftaran | varchar(12) |
| id_pasien      | varchar(10) |
| tanggal_daftar | date        |
| jadwal_periksa | datetime    |
| status         | enum        |
| catatan        | text        |

### DetailPendaftaran

| Field          | Type          |
| -------------- | ------------- |
| id_detail      | varchar(5)    |
| id_pendaftaran | varchar(12)   |
| id_layanan     | varchar(5)    |
| subtotal       | decimal(12,2) |

### Pembayaran

| Field          | Type          |
| -------------- | ------------- |
| id_pembayaran  | varchar(13)   |
| id_pendaftaran | varchar(12)   |
| tanggal_bayar  | date          |
| metode_bayar   | enum          |
| total_bayar    | decimal(12,2) |
| status_bayar   | enum          |

---

## ID Generation Rules

Primary keys use meaningful business codes.

Never use auto increment.

Users must never enter IDs manually.

All IDs must be generated automatically.

---

### Pasien

Format:

YYMMDDNNNN

Example:

2605160001

Meaning:

- YY = year
- MM = month
- DD = day
- NNNN = registration sequence for that day

Examples:

2605160001
2605160002
2605160003

Reset sequence every day.

---

### Petugas

Format:

RRNNN

Examples:

AD001
CS001
MG001
IT001

Meaning:

- RR = role code
- NNN = sequence within the same role

Role examples:

- AD = Admin
- CS = Customer Service
- MG = Manager
- IT = IT Staff
- SD = HR Staff

Sequence is independent for each role.

---

### Kategori Layanan

Format:

CCC

Examples:

HEM
PAT
KIM

Meaning:

- CCC = 3-character category code

The code itself is the primary key.

Examples:

HEM = Hematologi
PAT = Patologi
KIM = Kimia Klinik

No numeric sequence required.

---

### Layanan

Format:

CCCNN

Examples:

HEM01
HEM02
PAT01

Meaning:

- CCC = kategori layanan
- NN = service sequence within category

Examples:

HEM01 = Hemoglobin
HEM02 = Leukosit
PAT01 = Patologi Anatomi

Sequence restarts for each category.

---

### Pendaftaran

Format:

SSYYMMDDNNNN

Examples:

KB2605210003
KL2605210001

Meaning:

- SS = status kunjungan
- KB = Kunjungan Baru
- KL = Kunjungan Lama
- YYMMDD = registration date
- NNNN = registration sequence on that date

Sequence resets daily.

---

### Detail Pendaftaran

Format:

DNNNN

Examples:

D0001
D0002
D0003

Meaning:

- D = Detail
- NNNN = sequence number

Continuous numbering.

---

### Pembayaran

Format:

INVYYMMDDNNNN

Examples:

INV2605210001
INV2605210002

Meaning:

- INV = Invoice
- YYMMDD = payment date
- NNNN = payment sequence for that date

Sequence resets daily.

---

## Generation Guidelines

When generating CRUD modules:

Always generate:

- Model
- Controller
- Form Request
- Routes
- Blade Views
- Seeder

Always include:

- Eloquent relationships
- Validation rules
- Automatic ID generation

Do not use placeholder code.

Provide complete implementations.

Place ID generation logic inside:

- Service classes
- Model methods
- Traits

Do not place ID generation logic directly in controllers unless explicitly requested.

---

## Implementation Rules

When generating Models, Services, Controllers, or Actions:

- IDs must be generated automatically by the application.
- Users must never manually input IDs.
- Generate IDs before creating records.
- Always check the latest record with the same date or prefix to determine the next sequence number.
- Use Carbon for date formatting.
- Use leading zeros according to the specified format.
- Ensure generated IDs are unique.
- Prefer placing ID generation logic in a dedicated service class or model method instead of controllers.

---

## Validation Rules

### Pasien

nama:

- required
- max:100

email:

- required
- unique

password:

- minimum 8 characters

no_hp:

- required

tgl_lahir:

- required

jenis_kelamin:

- required

alamat:

- required

---

## Status Rules

### Layanan

Allowed values:

- aktif
- nonaktif

### Pendaftaran

Allowed values:

- menunggu
- dijadwalkan
- selesai
- batal

### Pembayaran

Allowed values:

- belum_lunas
- lunas
- gagal

---

## Payment Rules

Total pembayaran must be calculated automatically.

Formula:

SUM(detail_pendaftaran.subtotal)

Do not ask users to manually enter total_bayar.

---

## Coding Standards

Use:

- PHP type hints
- Return types
- Mass assignment protection
- Eloquent relationships

Generate:

- Migration
- Model
- Controller
- Form Request
- Seeder
- Factory

when creating a new module.

---

## UI Rules

Use:

- Bootstrap 5
- Responsive layout
- Indonesian language

Admin dashboard:

- Statistik pasien
- Statistik pendaftaran
- Statistik pembayaran

Patient dashboard:

- Homepage
- Profil
- Daftar layanan
- Riwayat pendaftaran
- Status pembayaran

---

## Code Generation Preference

When asked to create a feature:

Always provide:

1. Migration changes (if needed)
2. Model
3. Relationships
4. Form Request
5. Controller
6. Routes
7. Blade Views
8. Seeder (if applicable)

Prefer complete implementations over partial examples.

Do not use placeholder code unless explicitly requested.
