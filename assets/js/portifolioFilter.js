jQuery(document).ready(function ($) {
  var portfolioContainer = $(".portfolio-items-container");
  var dropdownFilter = $(
    ".portifolio-header-client-filter .portifolio-header-client-filter-wrapper"
  );
  var loadingHtml = `
  <div class="loading-portfolio-items" role="status" aria-label="Carregando">
    <div class="spinner"></div>
  </div>
`;
  var initialSelectedSlug =
    $(".btn-portifolio-terms.active-term").first().data("term-slug") || "";

  // FUNÇÃO PRINCIPAL DE AJAX agora recebe também clientFilter
  function loadPortfolioPosts(termSlug, clientFilter, updateHistory) {
    if (typeof updateHistory === "undefined") updateHistory = true;

    portfolioContainer.html(loadingHtml);

    if (updateHistory) {
      var params = new URLSearchParams();
      if (termSlug) params.set("cat_slug", termSlug);
      if (clientFilter) params.set("client", clientFilter);
      var newUrl = window.location.pathname + "?" + params.toString();
      history.pushState(
        { term_slug: termSlug, client: clientFilter },
        "",
        newUrl
      );
    }

    $.ajax({
      url: my_ajax_object.ajax_url,
      type: "POST",
      dataType: "json",
      data: {
        action: "filter_portfolio_posts",
        term_slug: termSlug,
        client: clientFilter,
        current_lang: my_ajax_object.current_lang,
      },
      success: function (response) {
        if (response.success) {
          portfolioContainer.html(response.data.items);
          $("#portfolio-modals-container").html(response.data.modals);
          syncClientDropdown(response.data.selected_client);
        } else {
          portfolioContainer.html(
            "<p>Nenhum item de portfólio encontrado para este termo.</p>"
          );
          $("#portfolio-modals-container").empty();
        }
      },
      error: function () {
        portfolioContainer.html(
          "<p>Ocorreu um erro ao carregar os itens do portfólio.</p>"
        );
      },
    });
  }

  // SINCRONIZA o dropdown com o valor atual (chamada no AJAX e no popstate)
  function syncClientDropdown(clientValue) {
    var $items = dropdownFilter.find("li");
    var $match = $items.filter('[data-client="' + clientValue + '"]');
    if (!$match.length) $match = $items.filter('[data-client=""]');
    $match.addClass("active").siblings().removeClass("active");
    dropdownFilter.find(".client-filter-current").text($match.text());
  }

  // MODO DELEGAÇÃO: clique em botão de categoria
  $(document).on("click", ".btn-portifolio-terms", function (e) {
    e.preventDefault();
    var termSlug = $(this).data("term-slug") || "";
    $(".btn-portifolio-terms").removeClass("active-term");
    $('.btn-portifolio-terms[data-term-slug="' + termSlug + '"]').addClass(
      "active-term"
    );
    // pega cliente ativo
    var clientValue = dropdownFilter.find("li.active").data("client") || "";
    loadPortfolioPosts(termSlug, clientValue, true);
  });

  // POPSTATE: navegador volta/avança
  $(window).on("popstate", function (event) {
    var state = event.originalEvent.state || {};
    var termSlug =
      state.term_slug ||
      new URLSearchParams(window.location.search).get("cat_slug") ||
      "";
    var clientValue =
      state.client ||
      new URLSearchParams(window.location.search).get("client") ||
      "";
    // atualiza UI
    $(".btn-portifolio-terms").removeClass("active-term");
    $('.btn-portifolio-terms[data-term-slug="' + termSlug + '"]').addClass(
      "active-term"
    );
    syncClientDropdown(clientValue);
    loadPortfolioPosts(termSlug, clientValue, false);
  });

  // DROPDOWN CUSTOM: toggle open/close
  $(document).on("click", ".client-filter-toggle", function (e) {
    e.stopPropagation();
    dropdownFilter.toggleClass("open");
  });
  $(document).on("click", function () {
    dropdownFilter.removeClass("open");
  });

  // Seleção de cliente no dropdown
  $(document).on("click", ".client-filter-list li", function (e) {
    e.stopPropagation();
    var clientValue = $(this).data("client") || "";
    syncClientDropdown(clientValue);

    // mantém a categoria selecionada
    var termSlug =
      $(".btn-portifolio-terms.active-term").data("term-slug") || "";
    loadPortfolioPosts(termSlug, clientValue, true);
    dropdownFilter.removeClass("open");
  });

  // —— Funções de modal (delegação) ——
  // abrir
  $(document).on("click", ".portifolio-btn-modal button", function (e) {
    e.preventDefault();
    e.stopPropagation();
    var idx = $(this).closest(".portifolio-btn-modal").data("index");
    var $modal = $("#portifolio-modal-" + idx);
    if (!$modal.length) return;
    $modal.removeClass("close").addClass("open").show();
  });
  // fechar clicando fora
  $(document).on("click", function (e) {
    var $open = $(".portifolio-modal-component.open");
    if (!$open.length) return;
    var wrapper = $open.find(".portifolio-modal-wrapper")[0];
    var clickedIn = wrapper.contains(e.target);
    var clickedBtn = Boolean(
      $(e.target).closest(".portifolio-btn-modal button").length
    );
    if (!clickedIn && !clickedBtn) {
      $open.removeClass("open").addClass("close");
      setTimeout(function () {
        $open.hide().removeClass("close");
      }, 500);
    }
  });
  // navegar anterior/próximo
  function switchModal(targetIdx) {
    var $openModal = $(".portifolio-modal-component.open");
    if ($openModal.length) {
      // fechamento rápido
      $openModal.addClass("close-fast").removeClass("open").addClass("close");
      setTimeout(function () {
        $openModal.hide().removeClass("close close-fast");
        var $toOpen = $("#portifolio-modal-" + targetIdx);
        $toOpen.removeClass("close").addClass("open").show();
      }, 200);
    } else {
      $("#portifolio-modal-" + targetIdx)
        .removeClass("close")
        .addClass("open")
        .show();
    }
  }
  $(document).on("click", ".portifolio-modal-btn-previous", function (e) {
    e.preventDefault();
    switchModal($(this).data("prev"));
  });
  $(document).on("click", ".portifolio-modal-btn-next", function (e) {
    e.preventDefault();
    switchModal($(this).data("next"));
  });

  $(document).on("click", ".rotation-button", function (e) {
    e.preventDefault();
    const $wrapper = $(this).closest(".portifolio-modal-wrapper");
    const $imgWidth = $wrapper.width();
    const $imgHeight = $wrapper.height();
    const $imgWrapper = $wrapper.find(".portifolio-modal-img");
    const $imgHeader = $wrapper.find(".portifolio-modal-header");
    const $img = $imgWrapper.find("img");
    const $bodyWrapper = $wrapper.find(".portifolio-modal-body");
    const $controls = $wrapper.find(".floating-rotation-controls");

    $imgWrapper.toggleClass("rotated");

    if ($imgWrapper.hasClass("rotated")) {
      $bodyWrapper.hide()
      $img.width($imgHeight).height($imgWidth);
      $imgHeader.css({
        height: '100%',
      });
      $imgWrapper.css({
        height: '100%',
      });
      $img.css({
        maxWidth: 'unset',
      });
      $controls.css({
        display: 'flex',
      });
    } else {
      $img.css({
        width: '100%',
        height: 'auto',
      });
      $imgHeader.css({
        height: 'auto',
      });
      $imgWrapper.css({
        height: 'auto',
      });
      $controls.hide();
      $bodyWrapper.show();
    }
  });

  // — Carregamento inicial se vier com query params —
  (function initFromURL() {
    var urlParams = new URLSearchParams(window.location.search);
    var termSlug = urlParams.get("cat_slug") || initialSelectedSlug;
    var clientVal = urlParams.get("client") || "";
    // marca categoria ativa
    $('.btn-portifolio-terms[data-term-slug="' + termSlug + '"]').addClass(
      "active-term"
    );
    loadPortfolioPosts(termSlug, clientVal, false);
  })();
});
