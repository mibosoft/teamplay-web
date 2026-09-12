(function () {
  document.querySelectorAll('[data-ui="dropdown"]').forEach(function (trigger) {
    var menu = trigger.nextElementSibling;
    if (menu) {
      menu.hidden = true;
      menu.style.display = 'none';
    }
  });

  function closeDropdowns(except) {
    document.querySelectorAll('[data-ui="dropdown"]').forEach(function (trigger) {
      var menu = trigger.nextElementSibling;
      if (menu && trigger !== except) {
        menu.classList.remove('is-open');
        menu.hidden = true;
        menu.style.display = 'none';
        trigger.setAttribute('aria-expanded', 'false');
      }
    });
  }

  document.addEventListener('click', function (event) {
    var dropdown = event.target.closest('[data-ui="dropdown"]');
    if (dropdown) {
      event.preventDefault();
      var menu = dropdown.nextElementSibling;
      if (!menu) return;
      var isOpen = menu.classList.toggle('is-open');
      closeDropdowns(dropdown);
      menu.hidden = !isOpen;
      menu.style.display = isOpen ? 'block' : 'none';
      dropdown.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      return;
    }

    closeDropdowns(null);
  });

  document.addEventListener('click', function (event) {
    var tab = event.target.closest('[data-ui="tab"]');
    if (tab) {
      event.preventDefault();
      var targetSelector = tab.getAttribute('href');
      var target = document.querySelector(targetSelector);
      var navigation = tab.closest('.nav');
      if (!target || !navigation) return;

      navigation.querySelectorAll('li').forEach(function (item) {
        item.classList.remove('active');
      });
      tab.closest('li').classList.add('active');

      var content = target.parentElement;
      content.querySelectorAll('.tab-pane').forEach(function (pane) {
        pane.classList.remove('active');
      });
      target.classList.add('active');
    }

    var button = event.target.closest('[data-ui="button"]');
    if (button) {
      var pressed = button.getAttribute('aria-pressed') === 'true';
      button.setAttribute('aria-pressed', pressed ? 'false' : 'true');
      button.classList.toggle('active', !pressed);
    }
  });
})();
