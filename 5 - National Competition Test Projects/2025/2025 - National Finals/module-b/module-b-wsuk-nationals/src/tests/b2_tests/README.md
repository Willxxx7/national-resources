# B2 Authentication & Authorization Tests

This folder contains Bruno API tests for validating B2 marking criteria (authentication and authorization).

## Prerequisites

**Download Bruno:**

- Standalone: https://www.usebruno.com/downloads
- Install the desktop application for your OS (Windows, macOS, Linux)

## Quick Start

### 1. Open Collection in Bruno

1. Launch Bruno application
2. Click **"Open Collection"**
3. Navigate to this folder: `\src\tests\b2_tests`
4. Select the folder and click **"Open"**

### 2. Select Environment

1. In Bruno, look for the environment dropdown (top right)
2. Select **"Local"** environment
3. This loads the test configuration (baseUrl, credentials, etc.)

### 3. Run Tests

**Run Individual Test:**

- Click on any test file (e.g., `M1.1 - Dashboard.bru`)
- Click the **"Send"** button or press `Ctrl+Enter`

**Run Folder:**

- Right-click on any folder (e.g., `M1 - Unauthenticated Access`)
- Select **"Run Folder"**
- All tests in that folder will run sequentially

**Run All Tests:**

- Right-click on the collection root (`B2 Tests`)
- Select **"Run Collection"**
- All 38 tests will run

## Test Structure

### M1 - Unauthenticated Access (5 tests)

Tests that unauthenticated users cannot access protected routes.

### M2 - Authenticated Admin (6 tests)

Tests that authenticated admins can access all admin routes.

### M3 - Authenticated Admin Guest Routes (3 tests)

Tests authenticated admins visiting guest/public routes.

### M4 - Login Validation (4 tests)

Tests login with valid/invalid credentials and session creation.

### M5 - Logout (3 tests)

Tests logout functionality and session termination.

### M6 - Session Persistence (6 tests)

Tests that sessions persist across requests and are cleared on logout.

### M7 - Suspended Admin (3 tests)

Tests that suspended admins cannot log in or access routes.

### M8 - Self Protection (4 tests)

Tests that admins cannot suspend or delete themselves.

### M9 - Private Event Access (4 tests)

Tests private event access with valid/invalid access codes.

## Environment Variables

Located in `environments/Local.bru`:

```
baseUrl: http://127.0.0.1:8000
adminEmail: admin1@admin.com
adminPassword: Password1
adminId: 1
suspendedEmail: admin2@admin.com
suspendedPassword: Password2
```

Update these values to match your local setup.

## Important Notes

### CSRF Protection

The tests require CSRF protection to be disabled for testing. In `src/bootstrap/app.php`:

```php
->withMiddleware(function (Middleware $middleware) {
    // Disable CSRF for testing purposes
    $middleware->validateCsrfTokens(except: ['*']);
})
```

**⚠️ Remember to enable CSRF protection in production!**

### Test Data Requirements

For M9 tests to pass, you need:

- A private event with folder name: `private_test_event`
- An access code: `TestCode123`

### Framework Agnostic

These tests are designed to work with any backend framework (Laravel, Express, Django, etc.) as long as the routes follow the specification in `dist/ROUTES.md`.

## Troubleshooting

**Tests fail with 419 errors:**

- CSRF protection is enabled. Disable it in `bootstrap/app.php`

**Tests fail with 404 errors:**

- Check that your routes match the specification in `dist/ROUTES.md`
- Ensure your server is running on the correct baseUrl

**Tests fail with 500 errors:**

- Check Laravel logs at `storage/logs/laravel.log`
- Ensure all controllers and middleware are properly configured

**Session not persisting:**

- Ensure Bruno is maintaining cookies between requests
- Check that session configuration is correct in your application

## Additional Resources

- Bruno Documentation: https://docs.usebruno.com/
- WorldSkills Routes Spec: `dist/ROUTES.md`
- OpenAPI Spec: `dist/routes.yaml`
