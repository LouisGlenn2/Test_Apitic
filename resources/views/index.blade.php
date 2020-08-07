<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection animaux</title>

    <!-- Librairies et font -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

</head>
<header>
    <h1>Bienvenue sur votre collection d'animaux</h1>
</header>

<body>
    <div>
        <div id="block_button">
            <!-- Bouton ouvrant le modal contenant le formulaire d'ajout -->
            <form>
                <button type="button" class="button" data-toggle="modal" data-target="#ajoutAnimal" data-whatever="@mdo">Ajouter un animal</button>
            </form>
            <!-- Bouton permettant de trier par type d'animal -->
            <form action="{{ route('orderBy') }}">
                <input class="button" type="submit" value="Trier par type">
            </form>
            <!-- Bouton permettant d'annuler le tri par type d'animal -->
            <form action="{{ route('list') }}">
                <input class="button" type="submit" value="Retirer le trie">
            </form>
        </div>
        <!-- Popup contenant le formulaire d'ajout -->
        <div class="modal fade" id="ajoutAnimal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-content">
                <form action="{{ route('list') }}">
                    <input class="close" type="submit" value="X">
                </form>

                <div class="modal-header">
                    <h2>Remplissez le formulaire pour ajouter un animal.</h2>
                </div>
                <p></p>
                <!-- Formulaire d'ajout d'un animal -->
                <form action="{{ route('add') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form">
                        <div>
                            <p class="label">Selectionnez un type d'animal : </p>
                            <input type="radio" id="reptile" name="type" value="reptile" checked>
                            <label for="huey">Reptile</label>

                            <input type="radio" id="oiseau" name="type" value="oiseau">
                            <label for="dewey">Oiseau</label>

                            <input type="radio" id="mammifère" name="type" value="mammifère">
                            <label for="dewey">Mammifère</label>
                        </div>


                        <div>
                            <p class="label">Nom de l'animal (1 à 100 caractères) : </p>
                            <input type="text" name="name" placeholder="Entrez son nom" min="1" max="100">
                        </div>
                        <div>
                            <p class="label">Espèce (1 à 100 caractères) : </p>
                            <input type="text" name="espece" placeholder="Entrez son espèce" min="1" max="100">
                        </div>

                        <div>
                            <p class="label">Description de l'animal (1 à 100 caractères) : </p>
                            <input type="text" name="description" placeholder="Décrivez le" min="1" max="100">
                        </div>
                    </div>
                    <input class="button" type="submit" value="Ajouter">
                </form>
            </div>
        </div>
    </div>
    <!-- Vérification des entrées  -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="error">{{ $error }}</li>
            @endforeach
        </ul>
    </div>

    @endif
    <!-- Bloc contenant la légende du tableau  -->
    <div id="legende">
        <figure>
            <img class="imgLegende" src="img/reptile.PNG" alt="Couleur verte représentant les reptiles" title="Légende reptile" />
            <figcaption>Reptile</figcaption>
        </figure>
        <figure>
            <img class="imgLegende" src="img/oiseau.PNG" alt="Couleur bleu ciel représentant les oiseaux" title="Légende oiseau" />
            <figcaption>Oiseau</figcaption>
        </figure>
        <figure>
            <img class="imgLegende" src="img/mammifere.PNG" alt="Couleur beige représentant les mammifères" title="Légende mammifère" />
            <figcaption>Mammifère</figcaption>
        </figure>
    </div>
    <table id="petTable">
        <thead>
            <th scope="col">
                Nom
            </th>
            <th scope="col">
                Description
            </th>
            <th scope="col">
                Actions
            </th>
        </thead>
        <tbody>
            <?php foreach ($pets as $pet) : ?>
            {{csrf_field()}}
            <!-- Choisi en fonction du type la bonne couleur à afficher -->
            @if (($pet->type)=="reptile")
            <tr style='background-color:#A9A9A9'>
                @elseif (($pet->type)=="mammifère")
            <tr style='background-color:#FFFACD'>
                @else
            <tr style='background-color:#AFEEEE'>
                @endif
                <td class="name">
                    {{ $pet->name }}
                </td>
                <td>
                    <!-- Choisi en fonction du type la bonne phrase à afficher -->
                    je suis un(e) {{ $pet->espece }} et
                    @if (($pet->type)=="reptile")
                    mes écailles sont {{$pet->description}}
                    @elseif (($pet->type)=="mammifère")
                    ma fourrure est {{$pet->description}}
                    @else
                    mon plumage est {{$pet->description}}
                    @endif
                </td>
                <td>
                    <div>
                        <!-- Bouton Editer qui appel la fonction editer et qui envoie l'id -->
                        <form action="{{ route('edit', ['id' => $pet->id]) }}">
                            <input class="tableButton" type="submit" value="Editer">
                        </form>
                        <!-- Boutton Effacer qui demande une confirmation avant d'appeler la fonction delete -->
                        <form onclick="return confirm('Etes-vous sûr de vouloir supprimer cet animal ?')" action="{{ route('delete', ['id' => $pet->id]) }}">
                            <input class="tableButton" id="deleteButton" type="submit" value="Effacer ">
                        </form>
                    </div>

                </td>

            </tr>
            <?php endforeach;  ?>
        </tbody>

    </table>
    <!-- Bouton ouvrant le modal contenant le formulaire d'ajout -->
    <button type="button" class="buttonDuBas" data-toggle="modal" data-target="#ajoutAnimal" data-whatever="@mdo">Ajouter un animal</button>

</body>

</html>
