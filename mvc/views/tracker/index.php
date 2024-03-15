{{ include('layouts/header.php', { title: 'Tracking' }) }}
    <section>
        <h1>Journal de bord</h1>
            <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th># Employee</th>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Ip address</th>
                        <th>Visited</th>                 
                    </tr>
                </thead>
            </table>
            </div>
            <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">            
                <tbody>
                {% for track in tracks %}                                            
                <tr>
                    <td>{{ track.idEmployee }}</td>
                    <td>{{ track.name }}</td>
                    <td>{{ track.date }}</td>
                    <td>{{ track.ip }}</td>
                    <td>{{ track.visited }}</td>
                </tr>
                {% endfor %}
                </tbody>
            </div>    
        </table>
    </section>
{{ include('layouts/footer.php') }}