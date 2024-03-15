{{ include('layouts/header.php', {title: 'Login'})}}
<div class="container">
    <div class="frame">
        {% if errors is defined %}
        <div class="error">
            <ul>
            {% for error in errors %}
                <li>{{ error }}</li>
            {% endfor %}
            </ul>
        </div>
        {% endif %}
        <h1>Login</h1>
        <form method="post">
            <label>Email
                <input class="form-styling" type="email" name="email" value="{{ employee.email }}">
            </label>
            <label>Password
                <input type="text" name="password" class="form-styling">
            </label>                                    
            <input type="submit" class="btn-left" value="Login">              
        </form>
    </div>
</div>
{{ include('layouts/footer.php')}}