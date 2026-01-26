document.addEventListener('DOMContentLoaded', function () {
    const sliderContainer = document.querySelector('.smc-hero-slider');
    if (!sliderContainer) return;

    const textItems = document.querySelectorAll('.hero-text-item');
    const imageItems = document.querySelectorAll('.hero-image-item');
    let currentIndex = 0;
    const totalSlides = textItems.length;
    const intervalTime = 5000; // 5 seconds per slide

    function nextSlide() {
        // Remove active classes
        textItems[currentIndex].classList.remove('active');
        textItems[currentIndex].classList.add('prev');

        imageItems[currentIndex].classList.remove('active');
        imageItems[currentIndex].classList.add('slide-out');

        // Calculate next index
        const nextIndex = (currentIndex + 1) % totalSlides;

        // Clean up "prev" class from the item that is now two steps behind
        // In a simple loop, "prev" just means "was just active". 
        // We can just clear all non-active, non-next classes or just rely on CSS overrides?
        // Better: Clear 'prev' from the *new* current index before adding active to it?
        // Actually, let's just loop all and reset, but that kills transitions.

        // Strategy: 
        // Current -> Prev (Slide UP out)
        // Next -> Active (Slide UP in)
        // Prev -> Reset (Ready at bottom)

        // Let's optimize the cycle:

        // Prepare next item
        textItems[nextIndex].classList.remove('prev');
        textItems[nextIndex].classList.add('active');

        imageItems[nextIndex].classList.remove('slide-out');
        imageItems[nextIndex].classList.add('active');

        // Cleanup: The item that BECAME 'prev' (currentIndex) stays 'prev' until it needs to show again?
        // We need to move the OLD 'prev' back to waiting position (bottom) without animation.
        const prevIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        if (prevIndex !== currentIndex) {
            textItems[prevIndex].classList.remove('prev');
            imageItems[prevIndex].classList.remove('slide-out');
        }

        currentIndex = nextIndex;
    }

    // Initialize
    textItems[0].classList.add('active');
    imageItems[0].classList.add('active');

    // Start Loop
    setInterval(nextSlide, intervalTime);
});
