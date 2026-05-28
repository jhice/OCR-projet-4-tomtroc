/**
 * burger menu
 */

// élément du DOM concernés
// le bouton
const burgerBtn = document.getElementById('burger-btn');
// la navigation mobile
const mobileMenu = document.getElementById('mobile-menu');

// toggle menu
burgerBtn.addEventListener('click', () => {
    // toggle menu mobile
    mobileMenu.classList.toggle('hidden');
    // ajout d'une classe pour cibler les span du menu, une fois ouverts (ci-dessous)
    burgerBtn.classList.toggle('open');
    // sélectionne les 3 "traits" du menu
    const spans = burgerBtn.querySelectorAll('span');
    // toggle (selon si "open" est présent sur le parent)
    if (burgerBtn.classList.contains('open')) {
        // trait du haut
        spans[0].classList.add('rotate-45', 'translate-y-[8px]');
        // trait du milieu
        spans[1].classList.add('opacity-0');
        // trait du bas
        spans[2].classList.add('-rotate-45', '-translate-y-[8px]');
    } else {
        // trait du haut
        spans[0].classList.remove('rotate-45', 'translate-y-[8px]');
        // trait du milieu
        spans[1].classList.remove('opacity-0');
        // trait du bas
        spans[2].classList.remove('-rotate-45', '-translate-y-[8px]');
    }
});