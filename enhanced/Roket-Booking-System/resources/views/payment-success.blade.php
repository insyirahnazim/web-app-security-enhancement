<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>

    <style>
        body{
            background:#000;
            color:white;
            font-family:Arial, sans-serif;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }

        .container{
            background:#1b1b1b;
            padding:40px;
            border-radius:20px;
            text-align:center;
            width:500px;
            box-shadow:0 0 15px rgba(128,0,255,0.4);
        }

        h1{
            color:#8A2BE2;
            margin-bottom:20px;
        }

        p{
            font-size:18px;
            margin-bottom:30px;
        }

        .details{
            background:#2b2b2b;
            padding:20px;
            border-radius:12px;
            margin-bottom:20px;
            text-align:left;
        }

        .btn{
            background:#8A2BE2;
            color:white;
            border:none;
            padding:14px 30px;
            border-radius:10px;
            cursor:pointer;
            text-decoration:none;
            font-size:16px;
        }

        .btn:hover{
            background:#6f1fd4;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>✅ Payment Successful</h1>

    <p>Your badminton court booking has been confirmed.</p>

    @if(session('last_booking'))
        <div class="details">
            <p><strong>Court:</strong>
                {{ session('last_booking')['court'] }}
            </p>

            <p><strong>Timeslots:</strong></p>

            <ul>
                @foreach(session('last_booking')['timeslots'] as $slot)
                    <li>{{ $slot }}</li>
                @endforeach
            </ul>

            <p>
                <strong>Payment Method:</strong>
                {{ session('last_booking')['payment_method'] }}
            </p>

            <p>
                <strong>Total Paid:</strong>
                RM {{ session('last_booking')['total'] }}
            </p>
        </div>
    @endif

    <a href="{{ route('home.index') }}" class="btn">
        Back to Home
    </a>
</div>

</body>
</html>
