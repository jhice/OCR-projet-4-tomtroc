<?php if (Utils::isConnectedUser($user->getId())): ?>
    <!-- Infos -->
    <form class="bg-white rounded-3xl p-8" action="/?action=user_update" method="post">

        <h2 class="font-semibold mb-8">
            Vos informations personnelles
        </h2>

        <div class="space-y-6">

            <div>
                <label class="text-sm text-gray-400">
                    Adresse e-mail
                </label>

                <input type="email" name="email" id="email"
                    value="<?= $_SESSION["user"]->getEmail(); ?>"
                    class="w-full h-14 mt-2 bg-[#EEF2F5] rounded-md px-4">
            </div>

            <div>
                <label class="text-sm text-gray-400">
                    Mot de passe <i>(optionnel)</i>
                </label>

                <input type="password" name="password" id="password"
                    class="w-full h-14 mt-2 bg-[#EEF2F5] rounded-md px-4"
                    value="">
            </div>

            <div>
                <label class="text-sm text-gray-400">
                    Pseudo
                </label>

                <input type="text" name="nickname" id="nickname"
                    value="<?= $_SESSION["user"]->getNickname(); ?>"
                    class="w-full h-14 mt-2 bg-[#EEF2F5] rounded-md px-4">
            </div>

        </div>

        <button
            class="mt-8 h-14 px-10 border border-[#00AC66] rounded-xl text-[#00AC66] font-semibold">
            Enregistrer
        </button>

</form>

<?php endif; ?>