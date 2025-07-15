const image = document.getElementById('zoomable-image');
const zoomInButton = document.getElementById('zoom-in');
const zoomOutButton = document.getElementById('zoom-out');

let scale = 1;
let startX = 0;
let startY = 0;
let currentX = 0;
let currentY = 0;
let isDragging = false;

let startDistance = 0;
let startScale = 1;

function updateTransform() {
    image.style.transform = `scale(${scale}) translate(${currentX}px, ${currentY}px)`;
}

function handleTouchStart(e) {
    if (e.touches.length === 1) {
        // Single touch for dragging
        isDragging = true;
        startX = e.touches[0].clientX - currentX;
        startY = e.touches[0].clientY - currentY;
    } else if (e.touches.length === 2) {
        // Two touches for pinch zoom
        startDistance = Math.hypot(
            e.touches[0].clientX - e.touches[1].clientX,
            e.touches[0].clientY - e.touches[1].clientY
        );
        startScale = scale;
    }
}

function handleTouchMove(e) {
    if (e.touches.length === 1 && isDragging) {
        // Handle dragging
        currentX = e.touches[0].clientX - startX;
        currentY = e.touches[0].clientY - startY;
        updateTransform();
    } else if (e.touches.length === 2) {
        // Handle pinch zoom
        const newDistance = Math.hypot(
            e.touches[0].clientX - e.touches[1].clientX,
            e.touches[0].clientY - e.touches[1].clientY
        );
        const newScale = (newDistance / startDistance) * startScale;
        scale = Math.max(1, newScale); // Prevent scaling below the original size
        updateTransform();
    }
}

function handleTouchEnd() {
    isDragging = false;
}

function zoomIn() {
    scale *= 1.1; // Increase scale by 10%
    updateTransform();
}

function zoomOut() {
    scale /= 1.1; // Decrease scale by 10%
    updateTransform();
}

zoomInButton.addEventListener('click', zoomIn);
zoomOutButton.addEventListener('click', zoomOut);

image.addEventListener('touchstart', handleTouchStart);
image.addEventListener('touchmove', handleTouchMove);
image.addEventListener('touchend', handleTouchEnd);
