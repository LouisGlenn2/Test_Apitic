<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Collection animaux</title>

    <!-- Librairies et font -->
    <link rel="stylesheet" type="text/css" href="{{ URL::to('css/style.css') }}">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<?php foreach ($pets as $pet) : ?>
<header>
    <h1>Modification de l'animal : <?php echo $pet->name ?></h1>
</header>

<body>

    <form action="{{ route('update', ['id' => $pet->id]) }}" method="PUT">
        {{ csrf_field() }}
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
        <div class="form">
            <div>
                <p class="label">Type de l'animal : </p>
                <input type="radio" id="reptile" name="type" value="reptile" <?php echo ($pet->type=='reptile')?'checked':'' ?> >
                <label for="huey">Reptile</label>
                
                <input type="radio" id="oiseau" name="type" value="oiseau" <?php echo ($pet->type=='oiseau')?'checked':'' ?>>
                <label for="dewey">Oiseau</label>
                
                <input type="radio" id="mammifère" name="type" value="mammifère" <?php echo ($pet->type=='mammifère')?'checked':'' ?>>
                <label for="dewey">Mammifère</label> 
            </div>


            <div>
                <p class="label">Nom de l'animal (1 à 100 caractères) : </p>
                <input type="text" name="name" value="<?php echo $pet->name ?>">
            </div>
            <div>
                <p class="label">Espèce (1 à 100 caractères) : </p>
                <input type="text" name="espece" value="<?php echo $pet->espece ?>">
            </div>

            <div>
                <p class="label">Description de l'animal (1 à 100 caractères) : </p>
                <input type="text" name="description" value="<?php echo $pet->description ?>">
            </div>
        </div>
            <!-- Bouton Modifier qui appel la fonction update et qui envoie l'id et les entrées du formulaire -->
            <input onclick="return confirm('Etes-vous sûr de vouloir modifier cet animal ?')" class="buttonDuBas" type="submit" value="Modifier">

    </form>
        <!-- Bouton Annuler permet d'annuler la modification -->
        <form onclick="return confirm('Etes-vous sûr de vouloir annuler les modifications?')" action="{{ route('list') }}">
            <input class="buttonDuBas" id="cancelButton" type="submit" value="Annuler ">
        </form>

</body>
<?php endforeach;  ?>

</html>
