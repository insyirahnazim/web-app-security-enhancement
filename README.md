# Web Application Security Enhancement

## Group Members

| Name | Matric No |
|------|-----------|
| Nurlyana Izzati Binti Rahmat | 2227066 |
| Nur Eilyana Eirdyna Binti Ismail | 2222692 |
| Nurizzati Insyirah Binti Mohd Nazim | 2227224 |
| Member 4 | Matric No |
| Iskandar Zulqarnaen bin Mohammed | 2215393 |

---

## Title of Web Application

**Roket Booking System**

---

## Introduction

Roket Booking System is a web-based badminton court reservation platform designed to provide users with a convenient and seamless booking experience. The system allows users to register accounts, authenticate through a secure login system, browse available badminton courts, select preferred timeslots, and complete bookings using a simulated payment interface.

The system was developed using the **Laravel framework** with **MySQL database integration**, following the **Model-View-Controller (MVC)** architectural pattern. Initially, the application focused primarily on functionality and usability. However, several security weaknesses were identified during the assessment phase, including insufficient authentication protection, inadequate input validation, lack of authorization control, and vulnerability exposure to brute force attacks and malicious input manipulation.

Therefore, this enhancement project focuses on strengthening the overall security posture of the Roket Booking System by implementing web application security mechanisms to ensure confidentiality, integrity, and secure access control while improving resilience against common cyber threats.

---

## Objective of Enhancements

The objective of this enhancement project is to improve the security of the Roket Booking System by implementing essential web application security controls, including:

- Strengthening **input validation** to prevent malicious user inputs.
- Enhancing **authentication mechanisms** to secure login sessions.
- Implementing **authorization control** to restrict unauthorized access.
- Preventing **Cross-Site Scripting (XSS)** and **Cross-Site Request Forgery (CSRF)** attacks.
- Improving **database security practices** through validated and protected inputs.
- Strengthening **file and application security configurations** to reduce exploitation risks.

---

# Web Application Security Enhancements

## i. Input Validation

### Client-side Validation

Client-side validation was implemented to improve user experience by ensuring users enter required information before submitting forms. HTML form validation was applied to input fields such as email, password, and booking details to reduce unnecessary server requests and improve usability.

### Server-side Validation

Server-side validation was implemented using Laravel validation rules to prevent malicious or invalid data from being processed by the system. Since client-side validation can be bypassed, all critical inputs are validated again on the server.

Validation rules were applied to:

- Court numbers (restricted between Court 1 to Court 5)
- Timeslot selections
- Login credentials
- Payment methods
- Registration fields

This enhancement prevents invalid parameter manipulation, malicious requests, and unauthorized input injection.

```php
$validated = $request->validate([
    'court' => ['required', 'integer', 'between:1,5'],
    'timeslots' => ['required', 'string', 'max:100'],
    'payment_method' => [
        'required',
        'string',
        Rule::in([
            'Maybank2u',
            'CIMB Click',
            'RHB Now',
            'Bank Islam',
            'Bank Rakyat'
        ])
    ],
]);
```

---

## ii. Authentication

Authentication security was improved by ensuring only registered users can access protected system functionalities. Laravel authentication mechanisms were used to verify user identity before granting access to secured pages.

Several improvements were introduced:

- Secure login validation
- Session regeneration after login to prevent **Session Fixation attacks**
- Proper logout session invalidation
- Login throttling to mitigate brute force attacks

Previously, attackers could repeatedly attempt password guessing without restrictions. After enhancement, rate limiting was implemented using Laravel throttle middleware to restrict login attempts.

```php
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.submit');
```

Session regeneration was also applied after successful authentication:

```php
if (!Auth::attempt($credentials, $remember)) {
    throw ValidationException::withMessages([
        'email' => 'Invalid email or password.',
    ]);
}

$request->session()->regenerate();
```

Secure logout was enhanced using session invalidation and token regeneration:

```php
Auth::logout();

$request->session()->invalidate();
$request->session()->regenerateToken();

return redirect()->route('home.index');
```

---

## iii. Authorization

Authorization control was implemented to ensure only authenticated users can access booking-related functionalities.

Initially, users could directly access booking and payment routes without logging in by manually entering URLs. This posed a serious unauthorized access vulnerability.

To address this issue, Laravel **auth middleware** was applied to protect sensitive routes such as:

- Dashboard
- Badminton booking page
- Court booking system
- Payment process
- Payment success page

Public access was restricted only to:

- Home page
- About page
- Login page
- Registration page

Protected routes:

```php
Route::middleware('auth')->group(function () {

    Route::get('/badminton', function () {
        return view('badminton');
    })->name('badminton');

    Route::get('/court/booking',
        [CourtController::class, 'showBookingForm']
    )->name('court.booking');

    Route::get('/payment',
        [PaymentController::class, 'showPaymentPage']
    )->name('payment.show');

});
```

This enhancement ensures unauthorized users cannot bypass authentication and directly access secured functionalities.

---

## iv. XSS and CSRF Prevention

### Cross-Site Scripting (XSS) Prevention

XSS prevention was implemented to stop malicious JavaScript code injection through URL parameters and form inputs.

Initially, malicious payloads such as:

```html
<script>alert(1)</script>
```

could be inserted into parameters such as:

```url
/payment?court=99&timeslots=<script>alert(1)</script>
```

To mitigate this vulnerability:

- Laravel input validation was enforced.
- Data sanitization using `e()` escaping function was applied before rendering views.
- Court values and timeslots were strictly validated.

Example:

```php
return view('payment', [
    'courtName' => e($courtName),
    'timeslots' => e($timeslots),
]);
```

### Cross-Site Request Forgery (CSRF) Prevention

Laravel CSRF protection was enabled to prevent forged requests from external attackers attempting unauthorized form submissions.

All forms include CSRF tokens using Blade directives:

```php
@csrf
```

Example:

```html
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">LOG OUT</button>
</form>
```

This prevents attackers from triggering actions such as logout, booking, or payment submission without user consent.

---

## v. Database Security Principles

Database security was strengthened through secure validation and Laravel ORM protection mechanisms.

The system prevents malicious SQL input by using Laravel’s built-in query handling instead of raw SQL queries, reducing the risk of **SQL Injection attacks**.

Additionally:

- Input validation prevents malformed data.
- Authentication credentials are securely verified.
- Passwords are stored using **bcrypt hashing**.

Example password hashing:

```php
Hash::make($request->password)
```

This ensures user passwords are never stored in plain text within the database.

---

## vi. File Security Principles

File security improvements were applied to reduce unnecessary exposure of sensitive project files.

The following measures were implemented:

- `.env` file excluded from GitHub repository.
- `vendor/` directory removed before project upload.
- Authentication middleware prevents unauthorized access to sensitive pages.
- Protected routes prevent direct URL access.

Sensitive files such as environment variables are excluded using `.gitignore`:

```gitignore
.env
/vendor
/node_modules
```

This prevents confidential information such as database credentials, application keys, and dependencies from being exposed publicly.

---

## Conclusion

The Roket Booking System security enhancement successfully improved the application’s resilience against common web application vulnerabilities. Security mechanisms including authentication hardening, authorization control, input validation, brute force prevention, XSS mitigation, CSRF protection, and database security were implemented to reduce attack surfaces and improve overall system protection.

The enhanced system now ensures that unauthorized access is restricted, malicious inputs are validated, sessions are securely managed, and sensitive operations are protected through Laravel security best practices. These improvements significantly strengthen the confidentiality, integrity, and reliability of the Roket Booking System.

---

## References

1. Laravel Documentation. https://laravel.com/docs

2. OWASP Foundation. https://owasp.org

3. Mozilla Developer Network (MDN). https://developer.mozilla.org

4. PHP Documentation. https://www.php.net/docs.php

5. Laravel Security Documentation. https://laravel.com/docs/security
