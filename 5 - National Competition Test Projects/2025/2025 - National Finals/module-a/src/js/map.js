/* File path: /js/map.js */
// ============================================
// INTERACTIVE MAP FUNCTIONALITY
// ============================================
document.addEventListener('DOMContentLoaded', function () {
  const mapImage = document.getElementById('mapImage');
  const mapContainer = document.getElementById('mapContainer');
  const zoomInBtn = document.getElementById('zoomIn');
  const zoomOutBtn = document.getElementById('zoomOut');
  const resetBtn = document.getElementById('resetView');

  if (!mapImage || !mapContainer) return;

  // Map state
  let zoom = 1;
  let panX = 0;
  let panY = 0;
  let isPanning = false;
  let startX = 0;
  let startY = 0;

  // Update transform and button states
  function updateMap() {
    mapImage.style.transform = `translate(${panX}px, ${panY}px) scale(${zoom})`;

    if (zoomOutBtn) zoomOutBtn.disabled = zoom <= 1;
    if (zoomInBtn) zoomInBtn.disabled = zoom >= 5;
  }

  // Constrain panning within bounds
  function constrainPan() {
    const rect = mapContainer.getBoundingClientRect();
    const imageWidth = rect.width * zoom;
    const imageHeight = rect.height * zoom;

    const maxPanX = Math.max(0, (imageWidth - rect.width) / 2);
    const maxPanY = Math.max(0, (imageHeight - rect.height) / 2);

    panX = Math.max(-maxPanX, Math.min(maxPanX, panX));
    panY = Math.max(-maxPanY, Math.min(maxPanY, panY));
  }

  // Zoom functionality
  function zoomMap(factor) {
    const newZoom = zoom * factor;
    if (newZoom >= 1 && newZoom <= 5) {
      zoom = newZoom;
      constrainPan();
      updateMap();
    }
  }

  // Reset to default view
  function resetView() {
    zoom = 1;
    panX = 0;
    panY = 0;
    updateMap();
  }

  // Button controls
  zoomInBtn?.addEventListener('click', () => zoomMap(1.3));
  zoomOutBtn?.addEventListener('click', () => zoomMap(1 / 1.3));
  resetBtn?.addEventListener('click', resetView);

  // Mouse wheel zoom
  mapContainer.addEventListener(
    'wheel',
    (e) => {
      e.preventDefault();
      const delta = e.deltaY > 0 ? 0.9 : 1.1;
      const newZoom = zoom * delta;

      if (newZoom >= 1 && newZoom <= 5) {
        const rect = mapContainer.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;

        panX = x - (x - panX) * delta;
        panY = y - (y - panY) * delta;
        zoom = newZoom;

        constrainPan();
        updateMap();
      }
    },
    { passive: false }
  );

  // Pan functionality
  function startPan(e) {
    isPanning = true;
    const clientX = e.clientX || e.touches?.[0]?.clientX;
    const clientY = e.clientY || e.touches?.[0]?.clientY;

    startX = clientX - panX;
    startY = clientY - panY;
    mapContainer.style.cursor = 'grabbing';

    e.preventDefault();
  }

  function pan(e) {
    if (!isPanning) return;

    const clientX = e.clientX || e.touches?.[0]?.clientX;
    const clientY = e.clientY || e.touches?.[0]?.clientY;

    panX = clientX - startX;
    panY = clientY - startY;

    constrainPan();
    updateMap();
    e.preventDefault();
  }

  function endPan() {
    isPanning = false;
    mapContainer.style.cursor = 'grab';
  }

  // Mouse events
  mapContainer.addEventListener('mousedown', startPan);
  mapContainer.addEventListener('mousemove', pan);
  mapContainer.addEventListener('mouseup', endPan);
  mapContainer.addEventListener('mouseleave', endPan);

  // Touch events
  mapContainer.addEventListener('touchstart', startPan, { passive: false });
  mapContainer.addEventListener('touchmove', pan, { passive: false });
  mapContainer.addEventListener('touchend', endPan);

  // Handle image error
  mapImage.addEventListener('error', () => {
    mapImage.style.display = 'none';
    mapContainer.insertAdjacentHTML(
      'beforeend',
      `
      <div class="map-image-error">
        <div class="map-fallback-icon"><i class="fas fa-map-marker-alt"></i></div>
        <div class="map-fallback-title">Cardiff Map</div>
        <div class="map-fallback-subtitle">img/map.png not found</div>
      </div>
    `
    );
  });

  // Initialize
  updateMap();
});
