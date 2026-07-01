<main class="bg-[#F5F3EF] flex flex-col">
    <!-- CONTENU -->
    <section class="flex-1 lg:grid lg:grid-cols-2">
        <!-- FORMULAIRE -->
        <div class="flex items-center justify-center px-6 py-12 lg:px-20">
            <div class="w-full max-w-md">
                <h1 class="font-display text-4xl mb-16">Inscription</h1>
                <form action="/?action=register_post" method="post" class="space-y-8" novalidate>
                    <div>
                        <label for="nickname" class="block text-sm text-gray-400 mb-3">Pseudo</label>
                        <input type="text" name="nickname" id="nickname" class="w-full h-14 rounded-md border border-black/5 bg-white px-4 outline-none focus:border-[#00AC66]">
                    </div>
                    <div>
                        <label for="email" class="block text-sm text-gray-400 mb-3">Adresse e-mail</label>
                        <input type="email" name="email" id="email" class="w-full h-14 rounded-md border border-black/5 bg-white px-4 outline-none focus:border-[#00AC66]">
                    </div>
                    <div>
                        <label for="password" class="block text-sm text-gray-400 mb-3">Mot de passe</label>
                        <input type="password" name="password" id="password" class="w-full h-14 rounded-md border border-black/5 bg-white px-4 outline-none focus:border-[#00AC66]">
                    </div>
                    <button type="submit" class="w-full h-14 rounded-xl bg-[#00AC66] hover:bg-[#00985B] text-white font-semibold transition mt-4">S'inscrire</button>
                </form>
                <p class="mt-8 text-sm text-[#555]">Déjà inscrit ? <a href="/?action=login" class="underline">Connectez-vous</a></p>
            </div>
        </div>
        <!-- IMAGE -->
        <div class="order-last lg:order-none">
            <img
                src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?q=80&w=1600&auto=format&fit=crop"
                alt="Bibliothèque"
                class="w-full h-[420px] lg:h-full object-cover"
            >
        </div>
    </section>
</main>