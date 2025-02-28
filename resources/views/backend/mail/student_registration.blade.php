<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-4">

<div class="container">
    <div class="card mx-auto shadow-sm" style="max-width: 600px;">
        <!-- Header -->
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">🎉 Welcome to {{ config('app.name') }}, {{ $student['name'] }}!</h4>
        </div>

        <!-- Body -->
        <div class="card-body">
            <p>Dear <strong>{{ $student['name'] }}</strong>,</p>
            <p>Your registration has been successfully completed. Below are your account details:</p>

            <table class="table">
                <tbody>
                <tr><td><strong>Name:</strong></td><td>{{ $student['name'] }}</td></tr>
                <tr><td><strong>Student id:</strong></td><td>{{ $student['Student_id'] }}</td></tr>
                <tr><td><strong>Email:</strong></td><td>{{ $student['email'] }}</td></tr>
                <tr><td><strong>Phone:</strong></td><td>{{ $student['phone'] }}</td></tr>
                <tr><td><strong>Admission No:</strong></td><td>{{ $student['admission_no'] }}</td></tr>
                <tr><td><strong>Class:</strong></td><td>{{ $student['class'] }}</td></tr>
                <tr><td><strong>Section:</strong></td><td>{{ $student['section'] }}</td></tr>
                </tbody>
            </table>

            <div class="text-center mt-3">
                <a href="{{ url('/admin/login') }}" class="btn btn-primary px-4">🔐 Login to Your Account</a>
            </div>

            <p class="mt-4 text-muted">If you have any questions, feel free to contact us at <strong>{{ config('mail.from.address') }}</strong>.</p>
        </div>

        <!-- Footer -->
        <div class="card-footer text-center text-muted py-3">
            Best Regards,<br><strong>{{ config('app.name') }}</strong>
        </div>
    </div>
</div>

</body>
</html>
