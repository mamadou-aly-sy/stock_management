<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Liste des Produits</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Categorie</th>
                                <th>price</th>
                                <th>qty</th>
                                <th>description</th>
                                <th>admin</th>
                                <th>Fournisseur</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?=$product->id?></td>
                                    <td><?=$product->name_p?></td>
                                    <td><?=$product->name?></td>
                                    <td><?=$product->price?></td>
                                    <td><?=$product->qty?></td>
                                    <td><?=$product->description?></td>
                                    <td><?=$product->lastname?></td>
                                    <td><?=$product->lastname_f?></td>
                                    <td>
                                        <a href="#" class="btn btn-primary">Editer</a>
                                        <a href="#" class="btn btn-danger">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
