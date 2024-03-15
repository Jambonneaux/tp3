{{ include('layouts/header.php', {title: 'Registration'})}}
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
    <form method="post">
        <h2>Registration</h2>
        <label>Name
            <input class="form-styling" type="text" name="name" value="{{ employee.name}}">
        </label>
        <label>Password
            <input class="form-styling" type="password" name="password">
        </label>
        <label>Email
            <input class="form-styling" type="email" name="email" value="{{ employee.email}}">
        </label>
        <label>
            Privilege
            <select class="form-styling" name="idPrivilege">
                <option value="">Select Privilege</option>
                {% for privilege in privileges %}
                    <option value="{{ privilege.id }}" {% if privilege.id == employee.idPrivilege %} selected {% endif %}>{{ privilege.privilege }}</option>
                {% endfor %}
            </select>
        </label>
        <input type="submit" class="btn-left" value="Register">
    </form>
    </div>
</div>
{{ include('layouts/footer.php')}}