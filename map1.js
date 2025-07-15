document.addEventListener('DOMContentLoaded', function () {
    for (let i = 1; i <= 8; i++) {
        const image = document.getElementById(`zoomable-image-${i}`);
        const zoomInButton = document.getElementById(`zoom-in-${i}`);
        const zoomOutButton = document.getElementById(`zoom-out-${i}`);

        let scale = 1;
        let startX = 0;
        let startY = 0;
        let currentX = 0;
        let currentY = 0;
        let isDragging = false;

        let startDistance = 0;
        let startScale = 1;
        let zoomInterval;

        function updateTransform() {
            image.style.transform = `scale(${scale}) translate(${currentX}px, ${currentY}px)`;
        }

        function handleTouchStart(e) {
            if (e.touches.length === 1) {
                e.preventDefault(); // Prevent scrolling while dragging
                isDragging = true;
                startX = e.touches[0].clientX - currentX;
                startY = e.touches[0].clientY - currentY;
            } else if (e.touches.length === 2) {
                e.preventDefault(); // Prevent scrolling during pinch zoom
                startDistance = Math.hypot(
                    e.touches[0].clientX - e.touches[1].clientX,
                    e.touches[0].clientY - e.touches[1].clientY
                );
                startScale = scale;
            }
        }

        function handleTouchMove(e) {
            if (e.touches.length === 1 && isDragging) {
                e.preventDefault(); // Prevent scrolling while dragging
                currentX = e.touches[0].clientX - startX;
                currentY = e.touches[0].clientY - startY;
                updateTransform();
            } else if (e.touches.length === 2) {
                e.preventDefault(); // Prevent scrolling during pinch zoom
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

        // Continuous zoom-in functionality
        function startZoomIn() {
            stopZooming(); // Ensure any other zoom action is stopped
            zoomInterval = setInterval(() => {
                scale *= 1.05; // Gradually increase the scale
                updateTransform();
            }, 50); // Adjust the interval for zooming speed
        }

        // Continuous zoom-out functionality
        function startZoomOut() {
            stopZooming(); // Ensure any other zoom action is stopped
            zoomInterval = setInterval(() => {
                scale = Math.max(1, scale / 1.05); // Gradually decrease the scale (not below 1)
                updateTransform();
            }, 50); // Adjust the interval for zooming speed
        }

        // Stop zooming when button is released
        function stopZooming() {
            clearInterval(zoomInterval);
        }

        // Add event listeners for zoom buttons and touch gestures
        zoomInButton.addEventListener('mousedown', startZoomIn);
        zoomOutButton.addEventListener('mousedown', startZoomOut);

        // Stop zooming when the mouse button is released
        zoomInButton.addEventListener('mouseup', stopZooming);
        zoomOutButton.addEventListener('mouseup', stopZooming);

        // Handle touch-based zooming as well
        zoomInButton.addEventListener('touchstart', startZoomIn);
        zoomOutButton.addEventListener('touchstart', startZoomOut);
        zoomInButton.addEventListener('touchend', stopZooming);
        zoomOutButton.addEventListener('touchend', stopZooming);

        image.addEventListener('touchstart', handleTouchStart, { passive: false });
        image.addEventListener('touchmove', handleTouchMove, { passive: false });
        image.addEventListener('touchend', handleTouchEnd);
    }
});
