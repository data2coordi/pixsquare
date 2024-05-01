


// スマートフォン用のハンバーガーアイコン制御
const drawerInput = document.getElementById('drawer-check');
const navList = document.querySelector('.menu');
const drawerOpen = document.querySelector('.drawer-open');

drawerOpen.addEventListener('click', () => {
    navList.classList.toggle('active');
});