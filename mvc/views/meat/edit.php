{{ include('layouts/header.php', { title: 'Client Edit' }) }}
<div class="container">
            <div class="frame">
            <h1>Edit Entry</h1>
                <form method="post">
                    <label>Arrival date
                        <input class="form-styling"type="date" name="arrival" value="{{ meat.arrival }}">
                    </label>

                    <label>Type
                        <select name="idType" id="" class="form-styling">
                            {% for type in types %}
                                <option value="{{ type.id }}" {% if meat.idType == type.id %}selected{% endif %}">{{ type.type }}</option>
                            {% endfor %}
                        </select>
                    </label>

                    <label>Quantity
                        <input type="text" name="quantity" class="form-styling" value="{{ meat.quantity }}">
                    </label>
                    {% if errors.quantity is defined %}
                    <span><small class="error">{{ errors.quantity }}</small></span>
                    {% endif %}

                    <label>Origin
                        <select name="idOrigin" id="" class="form-styling">
                            {% for origin in origins %}
                                <option value="{{ origin.id }}" {% if meat.idOrigin == origin.id %}selected{% endif %}">{{ origin.pays }}</option>
                            {% endfor %}
                        </select>
                    </label>
                    <label for="">Supplier
                        <select name="idSupplier" id="" class="form-styling">
                        {% for supplier in suppliers %}
                            <option value="{{ supplier.id }}" {% if meat.idSupplier == supplier.id %}selected{% endif %}">{{ supplier.name }}</option>
                        {% endfor %}
                        </select>
                    </label>
                    <label for="">Quality
                        <select name="idQuality" id="" class="form-styling">
                        {% for quality in qualitys %}
                            <option value="{{ quality.id }}" {% if meat.idQuality == quality.id %}selected{% endif %}>{{ quality.quality }}</option>
                        {% endfor %}
                        </select>
                    </label>                   
                    <input type="submit" class="btn-left" value="Save">              
                </form>
            </div>
        </div>       
{{ include('layouts/footer.php') }}