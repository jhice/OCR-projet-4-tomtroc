  <!-- PAGE -->
  <main class="py-10 lg:py-16">

      <div class="container-custom mx-auto px-4 lg:px-8">

          <!-- TITLE -->
          <div class="mb-8 lg:mb-12">

              <h1 class="font-display text-3xl lg:text-4xl leading-none mb-8">
                  Nos livres à l’échange
              </h1>

              <!-- SEARCH -->
              <!-- <div class="relative max-w-xl"> -->
              <div class="relative">

                  <svg
                      xmlns="http://www.w3.org/2000/svg"
                      class="w-5 h-5 absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor">
                      <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                  </svg>

                  <input
                      type="text"
                      placeholder="Rechercher un livre"
                      class="w-full h-14 rounded-xl border border-black/5 bg-white pl-12 pr-4 outline-none focus:ring-2 focus:ring-[#00AC66]/20" />

              </div>

          </div>

          <!-- BOOKS GRID -->
          <section class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8">

              <?php foreach ($books as $book): ?>
                  <!-- CARD -->
                  <article class="bg-white rounded-b-lg overflow-hidden shadow-sm relative">

                      <?php if (!$book->getAvailable()): ?>
                          <span class="absolute top-3 right-3 z-10 bg-[#F26B4A] text-white text-[10px] px-2 py-1 rounded-full">
                              non disponible
                          </span>
                      <?php endif; ?>

                      <img
                          src="/assets/images/covers/<?= $book->getPhoto(); ?>"
                          alt=""
                          class="aspect-square w-full object-cover object-top" />

                      <div class="p-4 lg:p-5">

                          <h2 class="text-lg mb-1">
                              <a class="underline" href="/?action=livre&id=<?= $book->getId(); ?>"><?= $book->getTitle(); ?></a>
                          </h2>

                          <p class="text-gray-400 text-sm mb-4">
                              <?= $book->getAuthor(); ?>
                          </p>

                          <p class="text-[11px] italic text-gray-300">
                              Vendu par : <a class="underline" href="?action=user&id=<?= $book->getUser()->getId(); ?>"><?= $book->getUser()->getNickname(); ?></a>
                          </p>

                      </div>

                  </article>
              <?php endforeach; ?>

          </section>

      </div>

  </main>