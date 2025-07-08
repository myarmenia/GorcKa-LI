

// GLightbox Popup

// var lightbox = GLightbox({
//     selector: '.image-popup'
//   });


import GLightbox from 'glightbox';
import 'glightbox/dist/css/glightbox.min.css';

export function initLightbox() {
  return GLightbox({
    selector: '.image-popup'
  });
}
