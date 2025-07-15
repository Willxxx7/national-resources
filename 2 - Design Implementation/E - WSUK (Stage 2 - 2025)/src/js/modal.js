document.addEventListener('DOMContentLoaded', function () {
  const privacyModal = document.getElementById('privacy-modal');
  const termsModal = document.getElementById('terms-modal');
  const openPrivacyBtn = document.getElementById('open-privacy');
  const openTermsBtn = document.getElementById('open-terms');
  const closeButtons = document.querySelectorAll('.modal-close');

  openPrivacyBtn.addEventListener('click', (e) => {
    e.preventDefault();
    privacyModal.style.display = 'flex';
  });

  openTermsBtn.addEventListener('click', (e) => {
    e.preventDefault();
    termsModal.style.display = 'flex';
  });

  closeButtons.forEach((btn) => {
    btn.addEventListener('click', () => {
      btn.closest('.modal').style.display = 'none';
    });
  });

  window.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal')) {
      e.target.style.display = 'none';
    }
  });
});
