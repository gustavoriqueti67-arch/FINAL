<!-- Cabeçalho e Navegação Melhorados -->
<style>
    /* Estilos específicos para botões da navbar */
    .nav-buttons .btn {
        padding: 0.75rem 1.75rem;
        font-size: 0.95rem;
        font-weight: 600;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .nav-buttons .btn-login {
        background: rgba(255, 255, 255, 0.08);
        color: #e8e8f0;
        border: 1.5px solid rgba(167, 139, 250, 0.3);
        backdrop-filter: blur(10px);
    }

    .nav-buttons .btn-login:hover {
        background: rgba(167, 139, 250, 0.15);
        border-color: #a78bfa;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(167, 139, 250, 0.3);
    }

    .nav-buttons .btn-login img {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        margin-right: 0.5rem;
        border: 2px solid #a78bfa;
        object-fit: cover;
    }

    .nav-buttons .btn-register {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        border: none;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        font-weight: 700;
    }

    .nav-buttons .btn-register:hover {
        background: linear-gradient(135deg, #8b5cf6, #a78bfa);
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.5);
    }

    /* Botão de cadastrar pet */
    .btn-cadastrar-pet {
        background: linear-gradient(135deg, #10b981, #059669) !important;
        border: none !important;
        padding: 0.75rem 1.5rem !important;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cadastrar-pet:hover {
        background: linear-gradient(135deg, #059669, #047857) !important;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-cadastrar-pet i {
        font-size: 1rem;
    }

    /* Container dos botões do usuário */
    .user-buttons-container {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Mobile menu button melhorado */
    .mobile-menu-button {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border: none;
        color: white;
        font-size: 1.35rem;
        cursor: pointer;
        padding: 0.75rem;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .mobile-menu-button:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
    }

    /* Responsividade aprimorada */
    @media (max-width: 768px) {
        .nav-buttons .btn {
            padding: 0.625rem 1.25rem;
            font-size: 0.9rem;
        }

        .btn-cadastrar-pet {
            padding: 0.625rem 1.25rem !important;
        }

        .user-buttons-container {
            flex-direction: column;
            gap: 0.5rem;
            width: 100%;
        }

        .user-buttons-container .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<header class="header">
    <nav class="container navbar">
        <a href="index.php" class="logo reveal animate-fade-in-left">
            <i class="fas fa-paw animate-float"></i> Adote um Amigo
        </a>

        <!-- Links Principais -->
        <ul class="nav-links reveal">
            <li><a href="index.php" <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'class="active"' : ''; ?>>Início</a></li>
            <li><a href="adote.php" <?php echo basename($_SERVER['PHP_SELF']) == 'adote.php' ? 'class="active"' : ''; ?>>Adote</a></li>
            <li><a href="blog.php" <?php echo basename($_SERVER['PHP_SELF']) == 'blog.php' ? 'class="active"' : ''; ?>>Blog</a></li>
            <li><a href="sobre.php" <?php echo basename($_SERVER['PHP_SELF']) == 'sobre.php' ? 'class="active"' : ''; ?>>Sobre Nós</a></li>
            <li><a href="contato.php" <?php echo basename($_SERVER['PHP_SELF']) == 'contato.php' ? 'class="active"' : ''; ?>>Contato</a></li>
        </ul>

        <!-- Botões de Ação -->
        <div class="nav-buttons reveal">
            <?php if (is_logged_in()): ?>
                <!-- Utilizador Autenticado -->
                <a href="cadastrar_animal.php" class="btn btn-cadastrar-pet">
                    <i class="fas fa-plus-circle"></i>
                    <span>Cadastrar Pet</span>
                </a>
                <div class="user-buttons-container">
                    <?php
                        $photo = isset($_SESSION['user_photo']) ? (string)$_SESSION['user_photo'] : '';
                        $isValidPhoto = preg_match('/^[A-Za-z0-9_.-]+$/', $photo) === 1 && $photo !== '' && file_exists(__DIR__ . '/perfil_foto/' . $photo);
                        $photoSrc = $isValidPhoto ? ('perfil_foto/' . htmlspecialchars($photo)) : 'perfil_foto/default-avatar.png'; // Caminho para foto padrão

                        // Pega apenas o primeiro nome
                        $userNameCompleto = isset($_SESSION['user_name']) ? (string)$_SESSION['user_name'] : 'Usuário';
                        $partesNome = explode(' ', trim($userNameCompleto));
                        $primeiroNome = htmlspecialchars($partesNome[0]);
                    ?>
                    <a href="perfil.php" class="btn btn-login">
                        <img src="<?php echo $photoSrc; ?>" alt="Foto de Perfil" loading="lazy" width="28" height="28">
                        <span><?php echo $primeiroNome; // Exibe apenas o primeiro nome ?></span>
                    </a>
                    <a href="logout.php" class="btn btn-register">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Sair</span>
                    </a>
                </div>
            <?php else: ?>
                <!-- Visitante -->
                <a href="login.php" class="btn btn-login">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Login</span>
                </a>
                <a href="register.php" class="btn btn-register">
                    <i class="fas fa-user-plus"></i>
                    <span>Cadastro</span>
                </a>
            <?php endif; ?>
        </div>

        <!-- Botão Mobile -->
        <button class="mobile-menu-button" aria-label="Abrir menu" onclick="(function(){
            var links = document.querySelector('.nav-links');
            var buttons = document.querySelector('.nav-buttons'); /* Seleciona os botões */
            if (!links || !buttons) return;

            // Container para o menu mobile
            var mobileMenuContainer = document.getElementById('mobile-menu-container');
            if (!mobileMenuContainer) {
                 mobileMenuContainer = document.createElement('div');
                 mobileMenuContainer.id = 'mobile-menu-container';
                 mobileMenuContainer.style.position = 'absolute';
                 mobileMenuContainer.style.top = '70px'; /* Ajuste conforme a altura da navbar */
                 mobileMenuContainer.style.right = '16px';
                 mobileMenuContainer.style.background = 'rgba(17, 24, 39, 0.98)'; /* Mais opaco */
                 mobileMenuContainer.style.padding = '1rem';
                 mobileMenuContainer.style.borderRadius = '12px';
                 mobileMenuContainer.style.boxShadow = '0 10px 30px rgba(0,0,0,0.35)';
                 mobileMenuContainer.style.display = 'none'; /* Começa escondido */
                 mobileMenuContainer.style.flexDirection = 'column';
                 mobileMenuContainer.style.gap = '1rem'; /* Espaço entre links e botões */
                 mobileMenuContainer.style.zIndex = '99'; /* Acima de outros elementos */
                 document.body.appendChild(mobileMenuContainer); // Adiciona ao body
            }


            if (mobileMenuContainer.style.display === 'flex') {
                mobileMenuContainer.style.display = 'none'; // Esconde
                // Retorna os elementos para seus lugares (opcional, dependendo do CSS)
                 links.style.display = '';
                 buttons.style.display = '';

            } else {
                 // Limpa o container e move os elementos para dentro dele
                 mobileMenuContainer.innerHTML = '';
                 // Clona os links e botões para não mover os originais (importante!)
                 var linksClone = links.cloneNode(true);
                 var buttonsClone = buttons.cloneNode(true);

                 // Ajusta estilos dos clones para mobile
                 linksClone.style.display = 'flex';
                 linksClone.style.flexDirection = 'column';
                 linksClone.style.gap = '1rem'; // Espaço entre links
                 linksClone.querySelectorAll('a').forEach(a => { a.style.padding = '0.5rem 0'; }); // Ajuste padding

                 buttonsClone.style.display = 'flex';
                 buttonsClone.style.flexDirection = 'column';
                 buttonsClone.style.gap = '0.75rem'; // Espaço entre botões
                 buttonsClone.style.marginTop = '1rem'; // Espaço acima dos botões
                 buttonsClone.querySelectorAll('.btn').forEach(b => { b.style.width = '100%'; b.style.justifyContent = 'center'; }); // Botões ocupam largura total

                 mobileMenuContainer.appendChild(linksClone);
                 mobileMenuContainer.appendChild(buttonsClone);

                 mobileMenuContainer.style.display = 'flex'; // Mostra

                 // Esconde os originais (importante para não duplicar visualmente)
                 links.style.display = 'none';
                 buttons.style.display = 'none';
            }
        })()">
            <i class="fas fa-bars"></i>
        </button>
        <script>
            // Script simples para garantir que o menu mobile feche se a tela for redimensionada para desktop
            window.addEventListener('resize', function() {
                var mobileMenuContainer = document.getElementById('mobile-menu-container');
                var links = document.querySelector('.nav-links');
                var buttons = document.querySelector('.nav-buttons');

                if (window.innerWidth > 768) { // Breakpoint do CSS
                    if (mobileMenuContainer) {
                        mobileMenuContainer.style.display = 'none'; // Esconde o menu mobile
                    }
                    // Mostra os originais no desktop
                     if(links) links.style.display = '';
                     if(buttons) buttons.style.display = '';
                } else {
                     // Em telas menores, garante que os originais estejam escondidos se o menu mobile estiver ativo
                     if (mobileMenuContainer && mobileMenuContainer.style.display === 'flex') {
                         if(links) links.style.display = 'none';
                         if(buttons) buttons.style.display = 'none';
                    }
                }
            });

            // Script para fechar o menu ao clicar fora dele
            document.addEventListener('click', function(event) {
                var mobileMenuContainer = document.getElementById('mobile-menu-container');
                var mobileButton = document.querySelector('.mobile-menu-button');

                // Verifica se o menu existe e está visível
                if (mobileMenuContainer && mobileMenuContainer.style.display === 'flex') {
                    // Verifica se o clique foi fora do menu E fora do botão que abre/fecha
                    if (!mobileMenuContainer.contains(event.target) && !mobileButton.contains(event.target)) {
                        mobileMenuContainer.style.display = 'none';
                        // Restaura a exibição dos elementos originais se necessário (depende do breakpoint)
                         if (window.innerWidth <= 768) { // Só restaura se estiver em modo mobile
                             var links = document.querySelector('.nav-links');
                             var buttons = document.querySelector('.nav-buttons');
                            // Não precisa restaurar display aqui, pois o botão cuidará disso na próxima abertura
                        }
                    }
                }
            });

             // Animação reveal (mantida)
            (function(){
                var observer = new IntersectionObserver(function(entries){
                    entries.forEach(function(entry){
                        if(entry.isIntersecting){ entry.target.classList.add('is-visible'); }
                    });
                }, { threshold: 0.1 });
                document.querySelectorAll('.reveal').forEach(function(el){ observer.observe(el); });
            })();
        </script>
    </nav>
</header>

