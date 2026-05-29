<!DOCTYPE html>
<html>
<head>
<title>Badminton Booking</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
margin:0;
}

.navbar{
background:#2c3e50;
padding:15px;
}

.navbar a{
color:white;
margin-right:15px;
text-decoration:none;
}

.container{
width:80%;
margin:auto;
margin-top:30px;
background:white;
padding:20px;
border-radius:5px;
}

table{
width:100%;
border-collapse:collapse;
}

table,th,td{
border:1px solid #ddd;
}

th,td{
padding:10px;
text-align:left;
}

.btn{
padding:8px 12px;
background:#3498db;
color:white;
border:none;
cursor:pointer;
}

.btn-danger{
background:red;
}

</style>

</head>

<body>

<div class="navbar">

<a href="/dashboard">Dashboard</a>
<a href="/lapangan">Lapangan</a>
<a href="/booking">Booking</a>
<a href="/history">History</a>
<a href="/logout">Logout</a>

</div>

<div class="container">

@yield('content')

</div>

</body>
</html>