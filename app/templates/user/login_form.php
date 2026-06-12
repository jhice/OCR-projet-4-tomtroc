<?php
    /**
     * Template pour afficher le formulaire de connexion.
     */
?>

<div>
    <form action="index.php?action=connect" method="post">
        <h2>Connexion</h2>
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="login" required>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <button class="submit">Se connecter</button>
        </div>
    </form>
</div>