jQuery(document).ready(function ($) {
  var portfolioContainer = $(".portfolio-items-container"); // Certifique-se que este seletor corresponde ao seu contêiner de posts
  var initialSelectedSlug = $("a.btn-portifolio-terms.active-term")
    .first()
    .data("term-slug");
  if (typeof initialSelectedSlug === "undefined") {
    initialSelectedSlug = ""; // Default to "all" if no term is pre-selected
  }

  // Função para carregar posts via AJAX
  function loadPortfolioPosts(termSlug, updateHistory) {
    if (typeof updateHistory === "undefined") {
      updateHistory = true; // Atualizar histórico por padrão
    }

    // Adiciona um indicador de carregamento (opcional, mas bom para UX)
    portfolioContainer.html(
      '<div class="loading-portfolio-items" style="text-align:center; padding:20px;">Carregando portfólio...</div>'
    );

    // Opcional: Atualizar URL no navegador sem recarregar a página
    if (updateHistory) {
      var currentPath = window.location.pathname;
      var newUrl = currentPath;
      if (termSlug && termSlug !== "") {
        newUrl = currentPath + "?cat_slug=" + termSlug;
      }
      // O terceiro parâmetro (title) é ignorado pela maioria dos navegadores
      history.pushState({ term_slug: termSlug }, "", newUrl);
    }

    $.ajax({
      url: my_ajax_object.ajax_url, // Definido via wp_localize_script
      type: "POST",
      dataType: "json",
      data: {
        action: "filter_portfolio_posts", // Nome da nossa ação AJAX no PHP
        term_slug: termSlug,
        current_lang: my_ajax_object.current_lang, // Passa o idioma atual
        // security: my_ajax_object.nonce // Se você implementar nonces
      },
      success: function (response) {
        if (response) {
          $(".portfolio-items-container").html(response.data.items);
          $("#portfolio-modals-container").html(response.data.modals);
        } else {
          $(".portfolio-items-container").html(
            "<p>Nenhum item de portfólio encontrado para este termo.</p>"
          );
          $("#portfolio-modals-container").empty();
        }
      },
      error: function (errorThrown) {
        console.error("Erro ao buscar itens do portfólio:", errorThrown);
        portfolioContainer.html(
          "<p>Ocorreu um erro ao carregar os itens do portfólio.</p>"
        );
      },
      complete: function () {
        // Remover indicador de carregamento aqui, se necessário,
        // mas a substituição do HTML já o remove.
      },
    });
  }

  // Evento de clique nos botões de termo
  // Use delegação de evento se os botões estiverem dentro do Owl Carousel que se reinicializa
  $(document).on("click", ".btn-portifolio-terms", function (e) {
    e.preventDefault();

    var $thisButton = $(this);
    var termSlug = $thisButton.data("term-slug");

    // Atualizar estado ativo dos botões
    $(".btn-portifolio-terms").removeClass("active-term");
    $thisButton.addClass("active-term");

    // Sincronizar botões desktop e mobile se tiverem o mesmo data-term-slug
    $('.btn-portifolio-terms[data-term-slug="' + termSlug + '"]')
      .not($thisButton)
      .addClass("active-term");

    loadPortfolioPosts(termSlug, true); // true para atualizar o histórico
  });

  // Lidar com botões de voltar/avançar do navegador
  $(window).on("popstate", function (event) {
    var state = event.originalEvent.state;
    var termSlugToLoad = ""; // Padrão para "todos"

    if (state && typeof state.term_slug !== "undefined") {
      termSlugToLoad = state.term_slug;
    } else {
      // Se não houver estado, pode ser o estado inicial.
      // Tenta ler da URL caso o usuário tenha chegado diretamente com um ?cat_slug=
      var urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has("cat_slug")) {
        termSlugToLoad = urlParams.get("cat_slug");
      }
    }

    // Atualizar classe ativa dos botões
    $(".btn-portifolio-terms").removeClass("active-term");
    if (termSlugToLoad === "") {
      $('.btn-portifolio-terms[data-term-slug=""]').addClass("active-term"); // Botão "Todos"
    } else {
      $(
        '.btn-portifolio-terms[data-term-slug="' + termSlugToLoad + '"]'
      ).addClass("active-term");
    }

    loadPortfolioPosts(termSlugToLoad, false); // false para não adicionar ao histórico novamente
  });

  jQuery(function ($) {
    // abrir modal por delegação
    $(document).on("click", ".portifolio-btn-modal button", function (e) {
      e.preventDefault();
      const idx = $(this).closest(".portifolio-btn-modal").data("index");
      const modal = document.getElementById(`portifolio-modal-${idx}`);
      if (!modal) return;
      modal.classList.remove("close");
      modal.classList.add("open");
      modal.style.display = "block";
    });

    // fechar modal clicando fora
    $(document).on("click", function (e) {
      console.log("Click event triggered:", e.target);
      const $open = $(".portifolio-modal-component.open");
      console.log($open);
      if (!$open.length) return;
      console.log("ta aqui");

      const wrapper = $open.find(".portifolio-modal-wrapper")[0];
      const clickedInside = wrapper.contains(e.target);
      const clickedBtn = Boolean(
        $(e.target).closest(".portifolio-btn-modal button").length
      );

      console.log("Clicked inside:", clickedInside);
      console.log("Clicked button:", clickedBtn);

      if (!clickedInside && !clickedBtn) {
        $open.removeClass("open").addClass("close");
        setTimeout(() => {
          $open.hide().removeClass("close");
        }, 500);
      }
    });
  });
});
