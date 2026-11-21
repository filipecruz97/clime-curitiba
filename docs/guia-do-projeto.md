# Clima Curitiba — Guia do projeto para quem está começando

A Clima Curitiba é uma empresa fictícia. Este projeto de portfólio demonstra como uma página comercial pode apresentar serviços de ar-condicionado e conduzir o visitante até um pedido de orçamento. O PHP valida uma solicitação de teste, e o botão de WhatsApp leva à prévia de uma mensagem.

## 1. O que decidimos antes de programar

Começamos pelo público e pela ação esperada. Um morador que procura instalação de split quer saber logo se o serviço atende ao que precisa, se está disponível em Curitiba e como pedir um orçamento. Isso explica a ordem do conteúdo.

1. A abertura identifica o serviço principal e a cidade, com os dois caminhos de orçamento.
2. A seção de serviços explica instalação, manutenção preventiva e higienização.
3. Os passos do orçamento e as perguntas frequentes esclarecem o que informar e o que pode afetar o valor.
4. A seção de orçamento reúne o formulário, a prévia do WhatsApp e o aviso de demonstração.

Essa é a estratégia de conversão do projeto. O WhatsApp tem maior destaque na abertura, enquanto o formulário recebe mais espaço quando a pessoa chega à seção de orçamento. Os campos obrigatórios são só nome, telefone com DDD e serviço. As informações sobre o processo ajudam a construir confiança sem depender de depoimentos ou avaliações inventadas.

| Documento | O que você encontra |
| --- | --- |
| [Briefing](briefing.md) | Necessidades do cliente simulado, público, identidade visual e critérios de aprovação. |
| [Planejamento](planejamento.md) | Textos principais, seções, posição dos botões e decisões de conversão. |
| [SEO](seo.md) | Palavra-chave local, metadados e instrução de indexação da demonstração. |
| [Checklist](checklist.md) | Verificações feitas e comandos para reproduzir os testes. |

## 2. Como rodar

Com PHP 8 ou superior, rode o comando abaixo na pasta do projeto.

```bash
php -S 127.0.0.1:8001 -t public
```

Abra `http://127.0.0.1:8001`. A porta 8001 permite usar a página enquanto outro projeto ocupa a 8000. A opção `-t public` define a pasta que o servidor entrega ao navegador, deixando os documentos em `docs/` fora dessa área. Interrompa o servidor com `Ctrl+C` no terminal em que o iniciou.

| Arquivo | Responsabilidade |
| --- | --- |
| [public/index.php](../public/index.php) | Recebe a requisição, valida o formulário e produz o HTML da página. |
| [public/assets/css/styles.css](../public/assets/css/styles.css) | Define cores, espaçamento, estados de foco e o layout em diferentes larguras. |
| [public/assets/js/main.js](../public/assets/js/main.js) | Controla o menu móvel e mostra mensagens de validação no navegador. |
| [public/assets/images/ar-condicionado.webp](../public/assets/images/ar-condicionado.webp) | Foto ilustrativa gerada para o projeto, otimizada para a web. |

Para seguir o código, abra primeiro o HTML em `index.php` e encontre o formulário pelo identificador `formulario`. Em seguida, procure esse identificador no JavaScript e leia o bloco PHP que começa com `if ($method === 'POST')`. Você verá a interface, as interações e o processamento na ordem em que o visitante os encontra.

## 3. HTML, CSS e navegação

O HTML usa elementos como `header`, `nav`, `main`, `section` e `footer` para indicar a função de cada parte. A FAQ usa `details` e `summary`, que o próprio navegador abre e fecha. Os botões de orçamento são links internos. Por exemplo, `href="#orcamento"` leva ao elemento com `id="orcamento"`.

No formulário, `for` no rótulo aponta para o `id` do campo. O `name` define a chave que será enviada ao servidor. Assim, o campo com `name="telefone"` chega ao PHP em `$_POST['telefone']`. O atributo `aria-describedby` associa o campo à mensagem de erro correspondente.

O CSS parte de uma coluna para telas pequenas e acrescenta colunas quando há espaço. A regra abaixo exibe os três serviços lado a lado a partir de `42rem`.

```css
@media (min-width: 42rem) {
    .services-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }
}
```

Cada coluna recebe uma parte igual do espaço disponível. As cores ficam em variáveis no bloco `:root`, permitindo ajustar a identidade visual em um só lugar. A imagem da abertura tem dimensões declaradas no HTML para o navegador poder reservar espaço antes de baixá-la. O texto alternativo descreve a cena, e a legenda informa que é ilustrativa.

O JavaScript usa o mesmo limite de `42rem` para alternar entre o menu compacto e a navegação de desktop. `setMenuOpen()` atualiza `hidden` e `aria-expanded`. O primeiro controla a visibilidade da navegação. O segundo comunica o estado do botão a tecnologias assistivas. Ao pressionar `Esc`, o menu fecha e o foco volta ao botão. Com o JavaScript desativado, os links continuam visíveis.

## 4. O que acontece ao enviar o formulário

1. Ao abrir a página, o navegador faz uma requisição `GET`. O PHP entrega o HTML, e o navegador carrega o CSS, o JavaScript e a imagem.
2. Ao clicar em **Enviar solicitação de teste**, o JavaScript verifica os campos e mostra mensagens junto aos valores inválidos. Quando existe um erro, o trecho abaixo cancela o envio e leva o foco ao primeiro campo a corrigir.

   ```js
   if (firstInvalidField) {
       event.preventDefault();
       firstInvalidField.focus();
   }
   ```

3. Quando a validação no navegador passa, o formulário faz uma requisição `POST` para a própria página. O corpo da requisição contém os valores identificados pelos atributos `name`. Com o JavaScript desativado, as regras nativas do HTML, como `required`, continuam ativas.
4. O PHP lê `$_POST`, aceita valores de texto e verifica nome, formato do telefone, serviço e comprimento dos detalhes. A lista `$services` serve tanto para montar as opções do formulário quanto para validar o serviço recebido.
5. Se houver erros, o PHP responde com status HTTP `422`, mostra as mensagens e preserva os campos válidos. Se os dados passarem, devolve a confirmação e limpa os campos. O fragmento `#resultado-orcamento` leva o navegador à mensagem renderizada na resposta, que recebe o foco por ter `tabindex="-1"`.

O navegador oferece feedback rápido. O servidor é responsável pela validação definitiva, porque também pode receber requisições feitas diretamente. O trecho abaixo verifica se o serviço recebido consta na lista.

```php
if (!isset($services[$values['servico']])) {
    $errors['servico'] ??= 'Selecione um dos serviços da lista.';
}
```

O operador `??=` guarda a mensagem se o campo ainda estiver sem erro registrado. Assim, uma mensagem anterior e mais específica pode ser preservada.

Outra distinção importante é entre **validar a entrada** e **preparar a saída**. Validar significa decidir se o dado é aceito. Antes de reexibir um texto no HTML, `escape()` chama `htmlspecialchars()` para que caracteres como `<` e aspas sejam tratados como texto no contexto em que aparecem.

```php
function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
```

O processamento termina na resposta da página. A aplicação trabalha com dados de teste, sem banco de dados ou serviço de envio. O formato de telefone é verificado, e a página deixa claro que o resultado é uma simulação.

## 5. SEO e alcance da demonstração

O título da aba, a descrição e o título principal falam de instalação de ar-condicionado split em Curitiba. A manutenção e a higienização aparecem em suas próprias seções. O atributo `lang="pt-BR"` indica o idioma da página, inclusive para leitores de tela.

O meta robots com `noindex` pede aos buscadores compatíveis que deixem esta demonstração fora dos resultados. Ele não é um controle de acesso. A marca fictícia é identificada perto do formulário e no rodapé.

## 6. Como verificar e versionar

- No celular ou no modo responsivo do navegador, abra o menu, clique nas seções e confira se os dois caminhos de orçamento são fáceis de encontrar. A revisão incluiu 320, 390, 768 e 1280 px.
- Use `Tab`, `Enter` e `Esc` para navegar. Envie o formulário com telefone inválido e depois com `Pessoa Exemplo`, `(41) 90000-0000` e `Instalação de split`.
- Desative o JavaScript e repita o teste. Observe que o PHP ainda rejeita o telefone inválido e confirma o envio válido. Clique também no botão do WhatsApp para conferir a prévia.
- Rode `php -l public/index.php` para verificar a sintaxe do PHP. Se tiver Node.js instalado, `node --check public/assets/js/main.js` verifica a sintaxe do JavaScript. O Node.js é opcional e não é usado para rodar a página.

O Git registra versões na branch `main`. Um commit guarda uma versão local dos arquivos que foram selecionados. O push envia os commits ao repositório remoto. Hospedar a página exige um servidor que execute PHP, uma etapa diferente de enviar o código ao GitHub.

```bash
git status --short --branch
git log --oneline -5
git remote -v
```

Como exercício, localize o campo Detalhes e siga o seu valor do `textarea` até `$_POST`. Encontre o limite de tamanho em HTML, JavaScript e PHP e observe qual camada dá a resposta quando o JavaScript está desativado.
