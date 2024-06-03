<x-mail::message>
    <div class="mail-container">
        <div class="logo-container">
            <img id="logo-top" src="https://projet-resources.fr/app/public/logo/logo-ressources-relationnelle.png" alt="logo de la ressources relationnelle" />
        </div>
        <h1 class="mainBanner">Réinitialisation de votre mot de passe</h1>
        <p class="mail-text">Bonjour,<br><br>Vous venez d'effectuer une demande de réinitialisation de votre mot
         de passe. Voici le lien opérationnelle pendant 30 minutes, qui vous redirigera sur la page prévue à cet effet :</p><br><br>
        <div class="btn-mail-box">
            <a href="{{$infos['resetLink']}}">
                <button class="mail-btn">Réinitialiser mon mot de passe</button>
            </a>
        </div>
        <p class="mail-text"><br>Si vous n'avez pas demandé cette réinitialisation, merci de contacter Ressources Relationnelle pour le signaler.
        </p>
        <p class="mail-text"><br>Si vous ne pouvez pas cliquer sur le bouton de réinitialisation, copiez simplement l'URL
            ci-dessous et collez-la dans la barre d'adresse de votre navigateur web pour accéder à la page souhaitée
            : @isset($infos['resetLink'])
                {{ $infos['resetLink'] }}
            @endisset
        </p>
        <p class="obligations"><br>Ce mail a été envoyé depuis l'application Ressources Relationnelle.</p>
    </div>
</x-mail::message>
