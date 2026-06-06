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

## Database Conventions

Always use Eloquent relationships.

### Pasien

Relationship:

- hasMany(Pendaftaran)

### Pendaftaran

Relationship:

- belongsTo(Pasien)
- hasMany(DetailPendaftaran)
- hasOne(Pembayaran)

### DetailPendaftaran

Relationship:

- belongsTo(Pendaftaran)
- belongsTo(Layanan)

### Layanan

Relationship:

- belongsTo(KategoriLayanan)
- hasMany(DetailPendaftaran)

### KategoriLayanan

Relationship:

- hasMany(Layanan)

### Pembayaran

Relationship:

- belongsTo(Pendaftaran)

---

## ID Generation Rules

Primary keys are VARCHAR.

Never use auto increment IDs.

Generate IDs automatically using the following formats.

---

### Pasien

Format:

PSYYMMNNNN

Example:

PS26050001

Meaning:

- PS = Pasien
- YY = Tahun daftar (2 digit)
- MM = Bulan daftar (2 digit)
- NNNN = Nomor urut pasien pada bulan tersebut

Example:

PS26050001
PS26050002
PS26050003

If the month changes, numbering restarts from 0001.

---

### Petugas

Format:

PTRRNNN

Example:

PTAD001
PTCS001
PTMG001

Meaning:

- PT = Petugas
- RR = Inisial jabatan
- NNN = Nomor urut berdasarkan jabatan

Role Mapping:

- AD = Admin
- CS = Customer Service
- MG = Manager

Examples:

PTAD001
PTAD002
PTCS001
PTMG001

Numbering is separated by role.

---

### Kategori Layanan

Format:

KTNNN

Example:

KT001
KT002
KT003

Meaning:

- KT = Kategori Layanan
- NNN = Nomor urut kategori

Examples:

KT001
KT002
KT003

---

### Layanan

Format:

LYNNN

Example:

LY001
LY002
LY003

Meaning:

- LY = Layanan
- NNN = Nomor urut layanan

Examples:

LY001
LY002
LY003

---

### Pendaftaran

Format:

DFYYMMDDNNNN

Example:

DF2605210003

Meaning:

- DF = Pendaftaran
- YY = Tahun pendaftaran
- MM = Bulan pendaftaran
- DD = Tanggal pendaftaran
- NNNN = Nomor urut pendaftaran pada hari tersebut

Examples:

DF2605210001
DF2605210002
DF2605210003

Numbering restarts every day.

---

### Detail Pendaftaran

Format:

DTYYMMDDNNNN

Example:

DT2605120005

Meaning:

- DT = Detail Pendaftaran
- YY = Tahun pendaftaran
- MM = Bulan pendaftaran
- DD = Tanggal pendaftaran
- NNNN = Nomor urut detail pendaftaran pada hari tersebut

Examples:

DT2605120001
DT2605120002
DT2605120003

Numbering restarts every day.

---

### Pembayaran

Format:

INVYYMMDDNNNN

Example:

INV2605210005

Meaning:

- INV = Invoice
- YY = Tahun pembayaran
- MM = Bulan pembayaran
- DD = Tanggal pembayaran
- NNNN = Nomor urut pembayaran pada hari tersebut

Examples:

INV2605210001
INV2605210002
INV2605210003

Numbering restarts every day.

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
