@extends('layouts.app')

@section('content')

<style>
    /* Your CSS styles here */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    .jumbotron {
      background-color: #2c4b68; /* Light gray background */
      color: #c1d1e1;
      text-align: center;
      padding: 50px;
      border: 2px solid #a69ab7; /* Border with slight gray */
      border-radius: 10px; /* Rounded corners */
      text-shadow: 2px 2px 4px #cccccc;
      width: 100vw; /* Make the jumbotron full width */
    }

    main {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
    }

    section {
      border: 1px solid #ccc;
      padding: 20px;
      margin: 10px;
    }

    h2 {
      margin-bottom: 10px;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      margin-bottom: 5px;
    }

    a {
      text-decoration: none;
      color: #333;
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #eee;
    }
  </style>
</head>
<body>
    <div class="jumbotron">
        <h1>Welcome to the Employee Management Dashboard</h1>
      </div>
</body>
@endsection
