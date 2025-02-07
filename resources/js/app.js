import './bootstrap';
import 'preline';

document.addEventListener('livewire:navigated', () => {
    // inisialisasi semua komponen preline jika livewire mengalami event navigated (livewire:navigate)
    window.HSStaticMethods.autoInit();
});
