(function() {
  var STORAGE_KEY = 'whmcs_dark_mode';

  function getPreference() {
    var stored = localStorage.getItem(STORAGE_KEY);
    if (stored !== null) return stored === 'true';
    return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
  }

  function applyTheme(isDark) {
    var html = document.documentElement;
    if (isDark) {
      html.classList.add('dark');
    } else {
      html.classList.remove('dark');
    }
    updateToggleIcon(isDark);
  }

  function updateToggleIcon(isDark) {
    var toggle = document.getElementById('darkModeToggle');
    if (!toggle) return;
    if (isDark) {
      toggle.innerHTML = '<i class="fas fa-sun"></i>';
      toggle.setAttribute('title', 'Switch to Light Mode');
    } else {
      toggle.innerHTML = '<i class="fas fa-moon"></i>';
      toggle.setAttribute('title', 'Switch to Dark Mode');
    }
  }

  function toggleDarkMode() {
    var html = document.documentElement;
    var isDark = html.classList.contains('dark');
    var newState = !isDark;
    localStorage.setItem(STORAGE_KEY, newState);
    applyTheme(newState);
  }

  applyTheme(getPreference());

  function initSidebar() {
    var toggleBtn = document.getElementById('sidebarToggle');
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('sidebarOverlay');

    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('open');
        if (overlay) overlay.classList.toggle('active');
      });
    }

    if (overlay && sidebar) {
      overlay.addEventListener('click', function() {
        sidebar.classList.remove('open');
        overlay.classList.remove('active');
      });
    }

    var submenuToggles = document.querySelectorAll('.submenu-toggle');
    for (var i = 0; i < submenuToggles.length; i++) {
      submenuToggles[i].addEventListener('click', function(e) {
        e.preventDefault();
        var parent = this.parentElement;
        var wasOpen = parent.classList.contains('open');

        var siblings = parent.parentElement.querySelectorAll('.admin-sidebar-item.open');
        for (var j = 0; j < siblings.length; j++) {
          siblings[j].classList.remove('open');
        }

        if (!wasOpen) {
          parent.classList.add('open');
        }
      });
    }
  }

  function init() {
    updateToggleIcon(getPreference());

    var toggle = document.getElementById('darkModeToggle');
    if (toggle) {
      toggle.addEventListener('click', toggleDarkMode);
    }

    initSidebar();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  if (window.matchMedia) {
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
      if (localStorage.getItem(STORAGE_KEY) === null) {
        applyTheme(e.matches);
      }
    });
  }

  window.toggleDarkMode = toggleDarkMode;
})();
