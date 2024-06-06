<x-mail::message>
    <div>
        <br>
        <div>
            <img src="https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/logo%2Flogo-3.png?alt=media&token=9c07a319-d97e-49fd-ac14-8f27b7390a32" alt="logo de la ressources relationnelle" />
        </div>
        <br>
        <h1>Activation de votre compte</h1>
        <p>Bonjour,<br><br>Un compte associé à cette adresse e-mail a été créé. Pour accéder à votre
            espace, vous devez vous connecter sur notre site avec le bouton ci-après en utilisant cette adresse e-mail est le mot de passe suivant :</p>
        @isset($infos['password'])<div style="align-items: center;">
            <p>Mot de passe : <span>{{ $infos['password'] }}</span></p>
        </div> @endisset
        @isset($infos['url'])
        <div>
            <a href="{{ $infos['url'] }}">
                <button>Accèder au site</button>
            </a>
        </div>
        @endisset
        <p>Une fois votre connecté, nous vous invitons à changer votre mot de passe pour plus de sécurité.</p>
        <p><br>Si vous ne pouvez pas cliquer sur le bouton pour accèder à l'application, copiez simplement l'URL
            ci-dessous et collez-la dans la barre d'adresse de votre navigateur web pour accéder à la page souhaitée
            : @isset($infos['url'])<span>{{ $infos['url'] }}</span>@endisset
        </p>
        <p><br>Ce mail a été envoyé depuis Ressources relationnelle.</p>
    </div>
</x-mail::message>

