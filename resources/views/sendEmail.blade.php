<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel Send Email using PHPMailer Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
</head>
<body>
      
<div class="container mt-5" style="max-width: 750px">
  
    <h1>Laravel Send Email using PHPMailer Example - ItSolutionStuff.com</h1>
  
    @if ($message = Session::get('success'))
        <div class="alert alert-success  alert-dismissible">
            <strong>{{ $message }}</strong>
        </div>
    @endif
  
    @if ($message = Session::get('error'))
        <div class="alert alert-danger  alert-dismissible">
            <strong>{{ $message }}</strong>
        </div>
    @endif
  
    <form method="post" action="{{ route('send.email.post') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Recipient Email:</label>
            <input type="email" name="email" class="form-control" />
        </div>
        <div class="form-group">
            <label>Subject:</label>
            <input type="text" name="subject" class="form-control" />
        </div>
        <div class="form-group">
            <label>Body:</label>
            <textarea class="form-control" name="body"></textarea>
        </div>
        <div class="form-group mt-3 mb-3">
            <button type="submit" class="btn btn-success btn-block">Send Email</button>
        </div>
    </form>
  
</div>
  
</body>
</html>