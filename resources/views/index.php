<h2>Ship Certificates Management</h2>

<div class="row">
    <div class="col-lg-2 col-md-2">

    <a href="/certificate/add" class="btn btn-primary btn-raised btn-block" >
        <i class="fa fa-plus"></i> New Certificate
    </a>

        <div class="fixed-section" data-spy="affix" data-offset-top="340">
            <div class="list-group">
                <li class="list-group-item"><h3 class="list-group-item-heading">Ships</h3></li>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Recife</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Rio de Janeiro</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Salvador</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Santos</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Rio Grande</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Mar Azul</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Andorinha</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Porto Sampaio</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Imbituba</a>
                <a class="list-group-item"  href="/certificates/byShip/{ship_id}">Carlos Sobrinho</a>
            </div>
        </div>
    </div>

    <div class="col-lg-10 col-md-10">

        <div class="list-group">
            <a class="list-group-item" href="/certificates/view/{id}">

                <div class="row">
                    <div class="col-lg-8">
                        <h4 class="list-group-item-heading">Certificate Name</h4>
                        <ul class="list-inline">
                            <li>{issuer}</li>
                            <li>{type}</li>
                            <li>Issued {issued}</li>
                            <li>Expires {expires}</li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        Expires in
                        <h3 class="list-group-item-heading">1 year 2 months</h3>
                    </div>
                </div>
            </a>
        </div>



    </div>
</div>