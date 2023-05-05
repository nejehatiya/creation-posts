<div class="form-creation-post">
    <form method="POST" action="#">
        <div class="form-group">
            <label for="titre">Titre : </label>
            <input type="text" class="titre form-control" id="titre" placeholder="Titre" />
        </div>
        <div class="form-group">
            <label for="texte">Texte : </label>
            <textarea type="text" class="texte form-control" id="texte" placeholder="Texte" ></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-infos">
                créer 
                <div class="loading">
                    <div class="lds-dual-ring"></div>
                </div>
            </button>
            <div class="response"></div>
        </div>
    </form>
</div>