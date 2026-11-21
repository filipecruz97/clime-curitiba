<?php
declare(strict_types=1);

header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-store');

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

$services = [
    'instalacao' => 'Instalação de split',
    'manutencao' => 'Manutenção preventiva',
    'higienizacao' => 'Higienização',
];

$values = ['nome' => '', 'telefone' => '', 'servico' => '', 'detalhes' => ''];
$errors = [];
$submitted = false;
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'POST') {
    foreach (array_keys($values) as $name) {
        $value = $_POST[$name] ?? '';
        $values[$name] = is_string($value) ? trim($value) : '';
        if (!is_string($value)) {
            $errors[$name] = 'Preencha este campo com um único valor.';
        }
    }
    // O navegador pode enviar quebras de linha como CRLF.
    $values['detalhes'] = str_replace("\r\n", "\n", $values['detalhes']);

    if (!preg_match('/\A.{2,80}\z/u', $values['nome'])) {
        $errors['nome'] ??= 'Informe um nome de 2 a 80 caracteres.';
    }
    if (!preg_match('/\A(?:\([1-9][0-9]\)|[1-9][0-9]) ?[0-9]{4,5}-?[0-9]{4}\z/', $values['telefone'])) {
        $errors['telefone'] ??= 'Informe um telefone com DDD, como (41) 90000-0000.';
    }
    if (!isset($services[$values['servico']])) {
        $errors['servico'] ??= 'Selecione um dos serviços da lista.';
    }
    if (!preg_match('/\A.{0,500}\z/us', $values['detalhes'])) {
        $errors['detalhes'] ??= 'Informe até 500 caracteres nos detalhes.';
    }

    $submitted = $errors === [];
    if ($submitted) {
        $values = array_fill_keys(array_keys($values), '');
    } else {
        http_response_code(422);
        // Preserve apenas os campos válidos para que o visitante possa tentar novamente.
        foreach (array_keys($errors) as $name) {
            $values[$name] = '';
        }
    }
} elseif ($method !== 'GET' && $method !== 'HEAD') {
    header('Allow: GET, HEAD, POST');
    http_response_code(405);
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Conheça os serviços de instalação de split, manutenção preventiva e higienização em Curitiba. Veja como pedir orçamento neste projeto demonstrativo.">
    <meta name="robots" content="noindex">
    <title>Instalação de ar-condicionado split em Curitiba | Clima Curitiba</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body>
    <a class="skip-link" href="#conteudo">Pular para o conteúdo</a>

    <header class="site-header">
        <div class="container header-content">
            <a class="brand" href="#inicio">
                <span class="brand-mark" aria-hidden="true">✳</span>
                Clima <span>Curitiba</span>
            </a>
            <button class="menu-toggle" type="button" aria-controls="menu-principal" aria-expanded="false" hidden>Menu</button>
            <nav id="menu-principal" aria-label="Navegação principal">
                <ul class="nav-list">
                    <li><a href="#servicos">Serviços</a></li>
                    <li><a href="#duvidas">Dúvidas</a></li>
                    <li><a href="#orcamento">Orçamento</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="conteudo" tabindex="-1">
        <section class="hero" id="inicio" aria-labelledby="titulo-principal">
            <div class="container hero-layout">
                <div class="hero-copy">
                    <h1 id="titulo-principal">Instalação de ar-condicionado <span>split em Curitiba</span></h1>
                    <p>Instalação, manutenção preventiva e higienização para residências e pequenos comércios. Saiba o que informar para pedir seu orçamento.</p>
                    <div class="hero-actions">
                        <a class="button button-primary" href="#whatsapp">Solicitar orçamento pelo WhatsApp</a>
                        <a class="button button-outline" href="#orcamento">Solicitar orçamento pelo formulário</a>
                    </div>
                </div>
                <figure class="hero-image">
                    <img src="assets/images/ar-condicionado.webp" width="1050" height="700" alt="Ar-condicionado split branco instalado na parede de uma sala">
                    <figcaption>Imagem ilustrativa</figcaption>
                </figure>
            </div>
        </section>

        <section class="section" id="servicos" tabindex="-1" aria-labelledby="titulo-servicos">
            <div class="container">
                <h2 id="titulo-servicos">Serviços de climatização em Curitiba</h2>
                <div class="services-grid">
                    <article class="service service-featured">
                        <h3>Instalação de split</h3>
                        <p>Para quem vai colocar um aparelho novo em casa ou no comércio. O modelo e a infraestrutura do local ajudam a definir o que será necessário para a instalação.</p>
                    </article>
                    <article class="service">
                        <h3>Manutenção preventiva</h3>
                        <p>Revisão das condições de funcionamento para identificar sinais de desgaste antes que afetem o uso do aparelho.</p>
                    </article>
                    <article class="service">
                        <h3>Higienização</h3>
                        <p>Limpeza de filtros e componentes acessíveis conforme o modelo, para remover a sujeira acumulada no equipamento.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section process" aria-labelledby="titulo-processo">
            <div class="container process-layout">
                <div>
                    <h2 id="titulo-processo">Como funciona o orçamento</h2>
                    <p>Alguns detalhes sobre o ambiente ajudam a entender o que o serviço precisa incluir.</p>
                </div>
                <ol class="process-list">
                    <li><strong>Escolha o serviço.</strong> Informe se precisa de instalação, manutenção preventiva ou higienização.</li>
                    <li><strong>Descreva o local.</strong> Diga se é casa, apartamento ou comércio e indique o modelo do aparelho, se souber.</li>
                    <li><strong>Confira o escopo.</strong> Em um atendimento real, essas informações ajudam a explicar o que entra no orçamento e como preparar o ambiente.</li>
                </ol>
            </div>
        </section>

        <section class="section" id="duvidas" tabindex="-1" aria-labelledby="titulo-duvidas">
            <div class="container faq-layout">
                <h2 id="titulo-duvidas">Dúvidas frequentes</h2>
                <div class="faq">
                    <details>
                        <summary>Quanto custa instalar um split?</summary>
                        <p>O valor depende do aparelho, do local e da infraestrutura disponível. Informe o modelo e o tipo de imóvel para iniciar o orçamento.</p>
                    </details>
                    <details>
                        <summary>Posso pedir orçamento para apartamento?</summary>
                        <p>Sim. Informe onde pretende instalar o aparelho e verifique as regras do condomínio para a unidade externa.</p>
                    </details>
                    <details>
                        <summary>Qual a diferença entre manutenção e higienização?</summary>
                        <p>A manutenção preventiva revisa as condições de funcionamento. A higienização é voltada à limpeza do equipamento.</p>
                    </details>
                    <details>
                        <summary>Preciso ter o aparelho para solicitar orçamento?</summary>
                        <p>Você pode descrever o ambiente antes de comprar o aparelho. Se já souber o modelo, inclua essa informação.</p>
                    </details>
                </div>
            </div>
        </section>

        <section class="section contact" id="orcamento" tabindex="-1" aria-labelledby="titulo-orcamento">
            <div class="container contact-layout">
                <div class="contact-copy">
                    <h2 id="titulo-orcamento">Solicite seu orçamento</h2>
                    <p>Conte qual serviço você precisa e deixe um telefone para retorno.</p>
                    <p class="demo-note">A Clima Curitiba é uma empresa fictícia criada para estudo. Use dados de exemplo para explorar o formulário.</p>
                    <a class="contact-link" href="#whatsapp">Solicitar orçamento pelo WhatsApp</a>
                    <div class="whatsapp-preview" id="whatsapp" tabindex="-1">
                        <h3>Mensagem de exemplo</h3>
                        <p>Olá! Gostaria de um orçamento para instalação de ar-condicionado split em Curitiba.</p>
                        <p class="demo-note">Prévia demonstrativa. Nenhuma conversa foi iniciada.</p>
                    </div>
                </div>

                <form class="quote-form" id="formulario" method="post" action="#resultado-orcamento" aria-describedby="form-info">
                    <p id="form-info">Use dados fictícios. Todos os campos são obrigatórios, exceto os detalhes.</p>
                    <?php if ($submitted): ?>
                        <p class="form-result form-success" id="resultado-orcamento" tabindex="-1">Solicitação validada na simulação. Nenhuma mensagem foi enviada e os dados não foram armazenados.</p>
                    <?php elseif ($errors !== []): ?>
                        <p class="form-result form-failure" id="resultado-orcamento" tabindex="-1">Confira os campos indicados e tente novamente.</p>
                    <?php endif; ?>
                    <div class="form-fields">
                        <div>
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" autocomplete="name" minlength="2" maxlength="80" value="<?= escape($values['nome']) ?>" aria-describedby="nome-erro"<?= isset($errors['nome']) ? ' aria-invalid="true"' : '' ?> required>
                            <p class="field-error" id="nome-erro"<?= isset($errors['nome']) ? '' : ' hidden' ?>><?= escape($errors['nome'] ?? '') ?></p>
                        </div>
                        <div>
                            <label for="telefone">Telefone com DDD</label>
                            <input id="telefone" type="tel" name="telefone" autocomplete="tel-national" maxlength="20" placeholder="(41) 90000-0000" value="<?= escape($values['telefone']) ?>" aria-describedby="telefone-erro"<?= isset($errors['telefone']) ? ' aria-invalid="true"' : '' ?> required>
                            <p class="field-error" id="telefone-erro"<?= isset($errors['telefone']) ? '' : ' hidden' ?>><?= escape($errors['telefone'] ?? '') ?></p>
                        </div>
                    </div>
                    <div>
                        <label for="servico">Serviço</label>
                        <select id="servico" name="servico" aria-describedby="servico-erro"<?= isset($errors['servico']) ? ' aria-invalid="true"' : '' ?> required>
                            <option value="">Selecione um serviço</option>
                            <?php foreach ($services as $value => $label): ?>
                                <option value="<?= escape($value) ?>"<?= $values['servico'] === $value ? ' selected' : '' ?>><?= escape($label) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="field-error" id="servico-erro"<?= isset($errors['servico']) ? '' : ' hidden' ?>><?= escape($errors['servico'] ?? '') ?></p>
                    </div>
                    <div>
                        <label for="detalhes">Detalhes <span class="optional">(opcional)</span></label>
                        <textarea id="detalhes" name="detalhes" rows="3" maxlength="500" placeholder="Ex.: apartamento com um split de 9.000 BTU" aria-describedby="detalhes-erro"<?= isset($errors['detalhes']) ? ' aria-invalid="true"' : '' ?>><?= escape($values['detalhes']) ?></textarea>
                        <p class="field-error" id="detalhes-erro"<?= isset($errors['detalhes']) ? '' : ' hidden' ?>><?= escape($errors['detalhes'] ?? '') ?></p>
                    </div>
                    <button class="button button-primary" type="submit">Enviar solicitação de teste</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container footer-content">
            <strong>Clima Curitiba</strong>
            <p>Empresa fictícia criada para estudo e portfólio.</p>
        </div>
    </footer>
</body>
</html>
