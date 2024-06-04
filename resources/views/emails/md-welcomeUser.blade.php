<x-mail::message>
    <div class="mail-container">
        <div class="logo-container">
            <img id="logo-top" src="https://projet-resources.fr/app/public/logo/logo-ressources-relationnelle.png" alt="logo de la ressources relationnelle" />
        </div>
        <h1 class="mainBanner">Activation de votre compte</h1>
        <p class="mail-text">Bonjour,<br><br>Un compte associé à cette adresse e-mail a été créé. Pour accéder à votre
            espace, vous devez vous connecter sur notre site avec le bouton ci-après en utilisant cette adresse e-mail est le mot de passe suivant :</p>
        @isset($infos['password'])<div class="verify-password-box" style="align-items: center;">
            <p>Mot de passe : <span>{{ $infos['password'] }}</span></p>
        </div> @endisset
        @isset($infos['url'])
        <div class="btn-mail-box">
            <a href="{{ $infos['url'] }}">
                <button class="mail-btn">Accèder au site</button>
            </a>
        </div>
        @endisset
        <p class="mail-text">Une fois votre connecté, nous vous invitons à changer votre mot de passe pour plus de sécurité.</p>
        <p class="mail-text"><br>Si vous ne pouvez pas cliquer sur le bouton pour accèder à l'application, copiez simplement l'URL
            ci-dessous et collez-la dans la barre d'adresse de votre navigateur web pour accéder à la page souhaitée
            : @isset($infos['url'])<span>{{ $infos['url'] }}</span>@endisset
        </p>
        <p class="obligations"><br>Ce mail a été envoyé depuis Ressources relationnelle.</p>
    </div>
</x-mail::message>

