<?php


// Para depurar os argumentos recebidos (opcional):
if (isset($args) && !empty($args)) {
    // echo $args['whatsapp_text'];
}
?>

<div class="whatsapp-btn-container">
    <button id="whatsapp-btn" class="btn">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/whatsapp.svg" alt="" srcset="">
    </button>
    <div id="group" class="group whatsapp-btn-group">
        <div class="whatsapp-btn-link">
            <a class="link" href="<?php echo esc_url($args['whatsapp_link']); ?>" target="_blank"
                rel="noopener noreferrer">
                <span class="link-text">WHATSAPP</span>
            </a>
        </div>
        <div class="whatsapp-btn-text">
            <p class="text"><?php echo esc_html($args['whatsapp_text']); ?></p>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>


<script>
    const btn = document.querySelector('.btn');
    const group = document.querySelector('.group');
    const link = document.querySelector('.whatsapp-btn-link .link-text');
    const text = document.querySelector('.whatsapp-btn-text .text');

    let isOpen = false;

    btn.addEventListener('click', () => {
        if (!isOpen) {
            group.classList.add('visible');

            anime({
                targets: group,
                scale: [0, 1],
                opacity: [0, 1],
                duration: 300,
                easing: 'easeOutQuad'
            });

            anime({
                targets: link,
                translateX: [-40, 0],
                opacity: [0, 1],
                delay: 150,
                duration: 400,
                easing: 'easeOutQuad'
            });

            anime({
                targets: text,
                translateX: [-40, 0],
                opacity: [0, 1],
                delay: 250,
                duration: 400,
                easing: 'easeOutQuad'
            });

            isOpen = true;
        } else {
            anime({
                targets: [link, text],
                translateX: [0, -40],
                opacity: [1, 0],
                duration: 200,
                easing: 'easeInQuad'
            });

            anime({
                targets: group,
                scale: [1, 0],
                opacity: [1, 0],
                delay: 150,
                duration: 300,
                easing: 'easeInQuad',
                complete: () => {
                    group.classList.remove('visible');
                }
            });

            isOpen = false;
        }
    });

    // Hover animado tipo mola no botão
    btn.addEventListener('mouseenter', () => {
        anime({
            targets: btn,
            scale: 1.1,
            duration: 500,
            easing: 'spring(1, 100, 15, 0)'
        });
    });

    btn.addEventListener('mouseleave', () => {
        anime({
            targets: btn,
            scale: 1,
            duration: 500,
            easing: 'spring(1, 100, 15, 0)'
        });
    });

</script>