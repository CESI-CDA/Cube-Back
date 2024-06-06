<x-mail::message>
    <div>
        <div>
            <img src="https://firebasestorage.googleapis.com/v0/b/cube-firebase-c82bf.appspot.com/o/logo%2Flogo-3.png?alt=media&token=9c07a319-d97e-49fd-ac14-8f27b7390a32" alt="logo de la ressources relationnelle" />
        </div>
        <br>
        <h1>Réinitialisation de votre mot de passe</h1>
        <p>Bonjour,<br><br>Vous venez d'effectuer une demande de réinitialisation de votre mot
         de passe. Voici le lien opérationnelle pendant 30 minutes, qui vous redirigera sur la page prévue à cet effet :</p><br><br>
        <div>
            <a href="{{$infos['resetLink']}}">
                <button>Réinitialiser mon mot de passe</button>
            </a>
        </div>
        <p><br>Si vous n'avez pas demandé cette réinitialisation, merci de contacter Ressources Relationnelle pour le signaler.
        </p>
        <p><br>Si vous ne pouvez pas cliquer sur le bouton de réinitialisation, copiez simplement l'URL
            ci-dessous et collez-la dans la barre d'adresse de votre navigateur web pour accéder à la page souhaitée
            : @isset($infos['resetLink'])
                {{ $infos['resetLink'] }}
            @endisset
        </p>
        <p><br>Ce mail a été envoyé depuis l'application Ressources Relationnelle.</p>
    </div>
</x-mail::message>
