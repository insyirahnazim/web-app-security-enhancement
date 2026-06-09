# Web Application Security Enhancement

## Group Members

| Name                                | Matric No |
| ----------------------------------- | --------- |
| Nurlyana Izzati Binti Rahmat        | 2227066   |
| Nur Eilyana Eirdyna Binti Ismail    | 2222692   |
| Nurizzati Insyirah Binti Mohd Nazim | 2227224   |
| Aiman Zaqwan Bin Yahya              | 2228787   |
| Iskandar Zulqarnaen bin Mohammed    | 2215393   |

---

# Title of Web Application

**Roket Booking System**

---

# 1.0 Introduction

Roket Booking System is a web-based badminton court reservation platform developed to provide users with a convenient, efficient, and seamless booking experience. The system enables users to register accounts, authenticate through a login system, browse available badminton courts, select preferred timeslots, and complete reservations using a simulated payment interface. The application was developed using the Laravel framework with MySQL database integration following the Model-View-Controller (MVC) architectural pattern to ensure a structured and maintainable system design.

Initially, the Roket Booking System primarily focused on functionality and usability. However, several security weaknesses were identified during the assessment process. These weaknesses include insufficient authentication protection, weak authorization control, inadequate input validation, and vulnerability exposure to brute force attacks and malicious user inputs. If left unprotected, these vulnerabilities could potentially allow attackers to gain unauthorized access, manipulate system functionality, or compromise sensitive user information.

Therefore, this enhancement project focuses on strengthening the overall security posture of the Roket Booking System by implementing essential web application security mechanisms. Security enhancements were introduced to improve authentication, authorization, input validation, session management, and attack prevention to ensure system confidentiality, integrity, and secure access control while improving resilience against common web application threats.

---

# 2.0 Objectives of Enhancements

The objectives of this web application security enhancement project are as follows:

1. To strengthen input validation mechanisms in order to prevent malicious, manipulated, and invalid user input from being processed by the system.

2. To improve authentication security by implementing secure login sessions, session regeneration, and brute force protection mechanisms.

3. To strengthen authorization control to ensure only authenticated users are allowed to access protected functionalities.

4. To mitigate common web application vulnerabilities including Cross-Site Scripting (XSS) and Cross-Site Request Forgery (CSRF).

5. To improve database and file security practices to reduce the risk of sensitive information exposure and exploitation.

6. To enhance the overall security posture of the Roket Booking System using Laravel security best practices and secure coding principles.

---

# 3.0 Web Application Security Enhancements

## 3.1 Input Validation

### Client-side Validation

Client-side validation was implemented to improve usability and reduce unnecessary server requests by ensuring users enter valid information before form submission. Validation mechanisms such as required input fields and restricted form formats were applied to booking and authentication forms to improve user experience and minimize input errors.

However, client-side validation alone is insufficient because attackers may bypass browser restrictions using manipulated requests. Therefore, server-side validation was implemented as the primary security control.

### Server-side Validation

Server-side validation was implemented using Laravel validation rules to ensure all incoming requests are validated before processing. Critical user inputs including court numbers, payment methods, login credentials, and booking timeslots were validated to prevent parameter manipulation and malicious input injection.

Validation rules were applied to:

* Court number selection (Court 1 to Court 5 only)
* Timeslot selection
* Payment methods
* Login credentials
* Registration inputs

The following code demonstrates the validation process implemented in the payment functionality:

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

This enhancement ensures that only valid booking information is accepted and prevents malicious users from submitting manipulated requests or invalid booking data.

---

## 3.2 Authentication

Authentication security was strengthened to ensure only registered users are permitted to access secured system functionalities. Laravel authentication mechanisms were utilized to verify user identity before granting access to protected resources.

Several authentication enhancements were implemented, including:

* Secure login validation
* Session regeneration after successful login
* Secure logout session invalidation
* Login rate limiting to mitigate brute force attacks

Initially, the system allowed unlimited login attempts, making it vulnerable to brute force attacks where attackers repeatedly attempt password combinations to gain unauthorized access.

To mitigate this issue, Laravel throttle middleware was implemented to limit login attempts:

```php
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.submit');
```

The `5,1` configuration limits users to only five login attempts within one minute. Once exceeded, Laravel temporarily blocks further login requests and displays a `429 Too Many Requests` response.

In addition, session regeneration was implemented after successful login to prevent **Session Fixation attacks**, where attackers attempt to reuse old session identifiers.

```php
if (!Auth::attempt($credentials, $remember)) {
    throw ValidationException::withMessages([
        'email' => 'Invalid email or password.',
    ]);
}

$request->session()->regenerate();
```

Logout security was also enhanced through secure session invalidation and token regeneration:

```php
Auth::logout();

$request->session()->invalidate();
$request->session()->regenerateToken();

return redirect()->route('home.index');
```

This enhancement ensures all session data is securely destroyed after logout, reducing risks related to session hijacking and unauthorized session reuse.

---

## 3.3 Authorization

Authorization control was implemented to ensure only authenticated users can access sensitive system functionalities.

Initially, users could directly access booking and payment routes without logging in simply by manually modifying URLs. This posed a serious security issue because unauthorized users could bypass authentication and interact with protected system pages.

To mitigate this vulnerability, Laravel **auth middleware** was applied to secure sensitive routes including:

* Dashboard page
* Badminton booking page
* Court booking page
* Payment process
* Payment success page

Public access was restricted only to:

* Home page
* About Us page
* Login page
* Registration page

The following code demonstrates the implementation of authorization control:

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

This enhancement ensures unauthorized users are automatically redirected to the login page whenever they attempt to access protected resources.

---

## 3.4 XSS and CSRF Prevention

### Cross-Site Scripting (XSS) Prevention

Cross-Site Scripting (XSS) is a vulnerability where attackers inject malicious scripts into user inputs that execute within a victim’s browser.

Initially, malicious payloads such as:

```html
<script>alert(1)</script>
```

could potentially be inserted into request parameters.

To prevent XSS attacks, strict validation and output sanitization were implemented using Laravel’s `e()` escaping function before displaying user-generated content.

Example:

```php
return view('payment', [
    'courtName' => e($courtName),
    'timeslots' => e($timeslots),
]);
```

This enhancement converts dangerous characters into safe text format, preventing malicious scripts from executing in the browser.

### Cross-Site Request Forgery (CSRF) Prevention

Cross-Site Request Forgery (CSRF) attacks occur when attackers trick authenticated users into submitting unintended requests.

Laravel CSRF protection was implemented through token validation to ensure every request originates from a legitimate authenticated session.

Example:

```php
@csrf
```

Applied in forms:

```html
<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">LOG OUT</button>
</form>
```

This enhancement prevents attackers from performing unauthorized actions such as booking manipulation, payment submission, or forced logout attempts.

---

## 3.5 Database Security Principles

Database security was strengthened through Laravel’s built-in ORM protection mechanisms and secure validation practices.

Instead of directly executing raw SQL queries, Laravel ORM and prepared statements were utilized to separate user input from SQL commands, significantly reducing the risk of **SQL Injection attacks**.

Additionally, passwords were securely stored using **bcrypt hashing** instead of plain text.

Example:

```php
Hash::make($request->password)
```

Hashing converts passwords into encrypted values that cannot be directly reversed, ensuring password confidentiality even if database exposure occurs.

---

## 3.6 File Security Principles

File security improvements were implemented to reduce unnecessary exposure of sensitive files and project configurations.

The following measures were applied:

* `.env` file excluded from repository uploads
* `vendor/` folder removed before submission
* `node_modules/` excluded from uploads
* Sensitive routes protected through middleware

The `.env` file contains highly sensitive information including:

* Database credentials
* Application secret keys
* Environment configuration

To prevent exposure, sensitive files were excluded using `.gitignore`:

```gitignore
.env
/vendor
/node_modules
```

This enhancement minimizes the risk of credential leakage and improves secure repository management.

---

# 4.0 Conclusion

In conclusion, the Roket Booking System security enhancement project successfully strengthened the system against several common web application vulnerabilities. Multiple security mechanisms including authentication hardening, authorization control, brute force protection, input validation, XSS prevention, CSRF protection, database security, and file security improvements were successfully implemented.

The enhanced system now provides stronger protection against unauthorized access, malicious user inputs, session-based attacks, and common web exploitation attempts. Through the implementation of Laravel security best practices, the Roket Booking System became significantly more secure, reliable, and resilient while maintaining its intended functionality and usability.

Overall, this enhancement project demonstrates the importance of integrating security mechanisms into web application development to ensure secure user interaction and system protection.

---

# References

1. Laravel Documentation. https://laravel.com/docs

2. OWASP Foundation. https://owasp.org

3. Mozilla Developer Network (MDN). https://developer.mozilla.org

4. PHP Documentation. https://www.php.net/docs.php

5. Laravel Security Documentation. https://laravel.com/docs/security
