# Testing Guide

## Overview

Project ini menggunakan **Pest** sebagai testing framework. Semua tests sudah lengkap untuk CRUD operations Pelanggan.

---

## Test Structure

### 📁 Feature Tests (`tests/Feature/`)

Testing untuk HTTP requests dan routes.

#### **PelangganIndexTest.php**

- ✅ Display pelanggan list
- ✅ Pagination works
- ✅ Search by name
- ✅ Search by alamat
- ✅ Query string preserved in pagination

**Tests:** 7

#### **PelangganCreateTest.php**

- ✅ Display create form
- ✅ Create with valid data
- ✅ Validation: nama (required, min 3, max 255)
- ✅ Validation: usia (required, min 1, max 150)
- ✅ Validation: alamat (required, min 5, max 1000)
- ✅ Factory integration

**Tests:** 10

#### **PelangganShowTest.php**

- ✅ Display detail page
- ✅ Show correct data
- ✅ Display timestamps
- ✅ Has edit/back links
- ✅ 404 for non-existent

**Tests:** 7

#### **PelangganEditTest.php**

- ✅ Display edit form
- ✅ Update with valid data
- ✅ Validation (sama seperti create)
- ✅ Partial updates
- ✅ 404 for non-existent

**Tests:** 10

#### **PelangganDeleteTest.php**

- ✅ Delete pelanggan
- ✅ Verify deletion
- ✅ Only affects target
- ✅ 404 for non-existent
- ✅ Cannot delete via GET

**Tests:** 7

### 📁 Unit Tests (`tests/Unit/`)

Testing untuk Model logic.

#### **PelangganTest.php**

- ✅ Create pelanggan
- ✅ Model attributes
- ✅ Fillable properties
- ✅ Timestamps
- ✅ Update
- ✅ Delete
- ✅ Scope filter

**Tests:** 8

---

## Running Tests

### Run All Tests

```bash
php artisan test
```

### Run Specific Test File

```bash
php artisan test tests/Feature/PelangganIndexTest.php
php artisan test tests/Feature/PelangganCreateTest.php
php artisan test tests/Feature/PelangganShowTest.php
php artisan test tests/Feature/PelangganEditTest.php
php artisan test tests/Feature/PelangganDeleteTest.php
php artisan test tests/Unit/PelangganTest.php
```

### Run Tests with Coverage

```bash
php artisan test --coverage
```

### Run Tests in Parallel

```bash
php artisan test --parallel
```

### Run Single Test Method

```bash
php artisan test tests/Feature/PelangganCreateTest.php --filter "test_can_create_pelanggan_with_valid_data"
```

---

## Test Coverage

| Component  | Coverage                    | Tests        |
| ---------- | --------------------------- | ------------ |
| **Index**  | Display, Search, Pagination | 7            |
| **Create** | Form, Validation, Store     | 10           |
| **Show**   | Display, Links, Timestamps  | 7            |
| **Edit**   | Form, Validation, Update    | 10           |
| **Delete** | Delete, Verify, Isolation   | 7            |
| **Model**  | Attributes, Scope, CRUD     | 8            |
| **TOTAL**  |                             | **49 Tests** |

---

## Key Test Assertions

### Status Checks

```php
$response->assertStatus(200);
$response->assertStatus(404);
$response->assertStatus(302);
```

### View Checks

```php
$response->assertViewIs('pelanggan.index');
$response->assertViewHas('pelanggan');
```

### Database Checks

```php
$this->assertDatabaseHas('pelanggans', $data);
$this->assertDatabaseMissing('pelanggans', $data);
```

### Redirect Checks

```php
$response->assertRedirect(route('pelanggan.index'));
```

### Validation Errors

```php
$response->assertSessionHasErrors('nama');
```

### Session Data

```php
$response->assertSessionHas('success', 'Pelanggan berhasil ditambahkan.');
```

---

## Validation Rules Tested

### Nama

- ✅ Required
- ✅ String
- ✅ Min 3 characters
- ✅ Max 255 characters

### Usia

- ✅ Required
- ✅ Integer
- ✅ Min 1
- ✅ Max 150

### Alamat

- ✅ Required
- ✅ String
- ✅ Min 5 characters
- ✅ Max 1000 characters

---

## Database Setup

Tests menggunakan `RefreshDatabase` trait yang:

- ✅ Reset database sebelum setiap test
- ✅ Isolate test data
- ✅ Clean up setelah setiap test

### .env.testing

Pastikan file `.env.testing` ada dengan database konfigurasi untuk testing (biasanya SQLite in-memory).

---

## Tips & Best Practices

### 1. Run Tests Frequently

```bash
# Run saat development
php artisan test --watch
```

### 2. Test-Driven Development (TDD)

- Write tests first
- Write code to pass tests
- Refactor

### 3. Keep Tests Simple

- One assertion per test (atau related assertions)
- Clear test names
- Isolated from other tests

### 4. Use Factories

```php
$pelanggan = Pelanggan::factory()->create();
$pelanggan = Pelanggan::factory()->count(5)->create();
$pelanggan = Pelanggan::factory()->make(); // Don't save
```

### 5. Test Edge Cases

- Empty input
- Boundary values
- Invalid data types
- Non-existent records

---

## Troubleshooting

### Tests Fail with "Table doesn't exist"

```bash
# Run migrations
php artisan migrate --env=testing
```

### Tests Slow

```bash
# Use parallel testing
php artisan test --parallel
```

### Database Lock

```bash
# Use SQLite for testing
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

---

## CI/CD Integration

Untuk GitHub Actions, tambahkan:

```yaml
- name: Run Tests
  run: php artisan test
```

---

## Resources

- [Pest Documentation](https://pestphp.com/)
- [Laravel Testing](https://laravel.com/docs/testing)
- [Factory Pattern](https://laravel.com/docs/eloquent-factories)

---

## Summary

✅ **49 comprehensive tests** untuk CRUD operations  
✅ **Validation testing** untuk semua fields  
✅ **Edge case coverage** (non-existent data, invalid input)  
✅ **Model & Feature tests** lengkap  
✅ **Production ready**

Happy testing! 🚀
