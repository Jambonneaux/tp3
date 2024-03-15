<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset }}/assets/css/style.css">
    <title>{{ title }}</title>

</head>
<body class="table-gradient">
    <nav>
        <div class="menu">
            <ul>
                <li class="underline"><a href="{{base}}/meat">Shipments</a></li>
                {% if session.idPrivilege == 1 %}
                <li class="underline"><a href="{{base}}/employee/create">Employee</a></li>
                <li class="underline"><a href="{{base}}/tracker">Journal de Bord</a></li>
                {% endif %}  
                
                {% if guest %}
                <li class="underline"><a href="{{base}}/login">Login</a></li>
                {% else %}
                <li class="underline"><a href="{{base}}/logout">Logout</a></li>
                {% endif %}
            </ul>
        </div>
    </nav>
    <main>

    

