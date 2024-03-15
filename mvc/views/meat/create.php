{{ include('layouts/header.php', { title: 'Meat Create' })  }}
        <div class="container">
            <div class="frame">
            <h1>New entry</h1>
                <form method="post">
                    <label>Arrival date
                        <input class="form-styling"type="date" name="arrival">
                    </label>

                    <label>Type
                        <select name="idType" id="idType" class="form-styling">
                            {% for type in types %}
                                <option value="{{ type.id }}">{{ type.type }}</option>
                            {% endfor %}
                        </select>
                    </label>

                    <label>Quantity
                        <input type="text" name="quantity" class="form-styling">
                    </label>
                    {% if errors.quantity is defined %}
                    <span><small class="error">{{ errors.quantity }}</small></span>
                    {% endif %}

                    <label>Origin
                        <select name="idOrigin" id="idOrigin" class="form-styling">
                            {% for origin in origins %}
                                <option value="{{ origin.id }}">{{ origin.pays }}</option>
                            {% endfor %}
                        </select>
                    </label>
                    <label for="">Supplier
                        <select name="idSupplier" id="idSupplier" class="form-styling">
                        {% for supplier in suppliers %}
                            <option value="{{ supplier.id }}">{{ supplier.name }}</option>
                        {% endfor %}
                        </select>
                    </label>
                    <label for="">Quality
                        <select name="idQuality" id="idQuality" class="form-styling">
                        {% for quality in qualitys %}
                            <option value="{{ quality.id }}">{{ quality.quality }}</option>
                        {% endfor %}
                        </select>
                    </label>                   
                    <input type="submit" class="btn-left" value="Save">              
                </form>
            </div>
        </div>
{{ include('layouts/footer.php') }}        
    