{{ include('layouts/header.php', { title: 'Meat Show' })  }}
        <div class="container">
            <div class="frame">
                <h1>Shipment detail</h1>
                <p class="form-styling"><strong>Arrival date:</strong> {{ meat.arrival }}</p>
                <p class="form-styling"><strong>Type:</strong> {{ meat.idType }}</p>
                <p class="form-styling"><strong>Quantity:</strong> {{ meat.quantity }}</p>
                <p class="form-styling"><strong>Origin:</strong> {{ meat.idOrigin }}</p>
                <p class="form-styling"><strong>Quality:</strong> {{ meat.idQuality }}</p>
                <p class="form-styling"><strong>Supplier:</strong> {{ meat.idSupplier }}</p>
                <div class="grid">                
                    <a href="{{ base }}/meat/edit?id={{ meat.id }}" class="btn-left">Edit</a>
                    
                    <form action="{{ base }}/meat/delete" method="post">
                        <input type="hidden" value="{{ meat.id }}" name="id">
                        <button type="" class="btn-right">Delete</button>
                    </form>
                </div>
            </div>
        </div>
{{ include('layouts/footer.php') }}