{{ include('layouts/header.php', { title: 'Meats' }) }}
    <section>
        <h1>Meat shipment in</h1>
            <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th>Arrival</th>
                        <th>Type</th>
                        <th>Quantity</th>
                        <th>Origin</th>
                        <th>Supplier</th>
                        <th>Quality</th>
                    </tr>
                </thead>
            </table>
            </div>
            <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">            
                <tbody>
                {% for meat in meats %}                                            
                <tr>
                    <td><a href="{{ base }}/meat/show?id={{ meat.id }}">{{ meat.arrival }}</a></td>
                    <td>{{ meat.idType }}</a></td>
                    <td>{{ meat.quantity }}</td>
                    <td>{{ meat.idOrigin }}</td>
                    <td>{{ meat.idSupplier }}</td>
                    <td>{{ meat.idQuality }}</td>
                </tr>
                {% endfor %}
                </tbody>
            </div>    
        </table>
    </section>
    <div>
        <a href="{{ base }}/meat/create" class="btn">New Arrival</a>
    </div>
{{ include('layouts/footer.php') }}