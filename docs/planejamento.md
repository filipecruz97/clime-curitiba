# Planejamento da Landing Page

## 1. Objetivo

Ajudar quem procura instalação ou manutenção de ar-condicionado em Curitiba a entender os serviços e solicitar um orçamento. O MVP demonstra esse fluxo para portfólio usando dados de teste.

## 2. Público-alvo

Moradores, proprietários de imóveis e responsáveis por pequenos comércios em Curitiba. A página deve responder às primeiras dúvidas de quem já comprou um aparelho, ainda está escolhendo um modelo ou precisa cuidar de um equipamento em uso.

## 3. Proposta de valor

Instalação de split e cuidados com o ar-condicionado em Curitiba, com explicação do que entra no orçamento e do que o cliente pode informar para começar. O texto vai mostrar os diferenciais propostos pelo briefing por meio do processo de atendimento, dos detalhes de cada serviço e das respostas às dúvidas frequentes.

## 4. Estrutura das seções

| Seção | Função |
| --- | --- |
| Cabeçalho | Identificar a marca e levar a Serviços, Dúvidas e Orçamento. |
| Abertura | Mostrar serviço, cidade, foto ilustrativa e os dois caminhos de orçamento. |
| Serviços | Destacar instalação de split e explicar quando buscar manutenção preventiva ou higienização. |
| Como funciona | Orientar o visitante a informar o serviço, descrever o local e entender como o orçamento seria preparado. |
| Dúvidas frequentes | Explicar o que influencia o preço e responder dúvidas sobre apartamentos, equipamento e serviços. |
| Orçamento | Mostrar o formulário, a opção de WhatsApp e o aviso de demonstração antes de qualquer envio. |
| Rodapé | Identificar a Clima Curitiba como empresa fictícia criada para estudo. |

## 5. Headline e subtítulo

**Headline** — Instalação de ar-condicionado split em Curitiba

**Subtítulo** — Instalação, manutenção preventiva e higienização para residências e pequenos comércios. Saiba o que informar para pedir seu orçamento.

## 6. Chamadas para ação

- **Solicitar orçamento pelo WhatsApp.** Ação de maior destaque na abertura. Na demonstração, exibe uma mensagem pronta e informa que nenhum contato foi iniciado. Com um número de teste autorizado, pode abrir a conversa com a mensagem preenchida para revisão.
- **Solicitar orçamento pelo formulário.** Ação secundária na abertura que leva diretamente à seção Orçamento. Dentro da seção, o botão de envio usa o texto “Enviar solicitação de teste”.
- Na seção Orçamento, o formulário recebe o destaque e o WhatsApp aparece como link. Os blocos de serviço usam a navegação da página, sem repetir os botões em cada cartão.

## 7. Jornada do visitante

1. Confirma que a página cobre o serviço e a cidade que procurou.
2. Escolhe um canal de orçamento ali mesmo ou lê sobre os serviços e tira dúvidas.
3. Entende quais dados ajudam a estimar o serviço e vê que está em uma demonstração.
4. Visualiza a mensagem de WhatsApp ou envia dados fictícios pelo formulário.
5. Recebe uma resposta clara sobre o resultado da simulação.

## 8. Estratégia de conversão

- Mostrar serviço e região no primeiro bloco para que o visitante identifique rapidamente se a oferta corresponde à busca.
- Dar uma hierarquia visual aos dois canais e limitar sua repetição às seções de abertura e orçamento.
- Pedir apenas nome, telefone e serviço. Manter os detalhes opcionais e mostrar erros junto aos campos para facilitar a correção.
- Explicar o que afeta o orçamento e como seria o atendimento. Usar a foto como referência ilustrativa, com indicação de que a empresa é fictícia perto do contato e no rodapé.
- No MVP, testar se é possível completar os dois caminhos e corrigir dados inválidos. Em uma operação real, medir solicitações recebidas por canal, proporção de visitas com solicitação e erros de envio. Contar cliques no WhatsApp como intenção, pois a mensagem ainda depende de envio.

## 9. Tecnologias e organização

| Tecnologia | Responsabilidade |
| --- | --- |
| HTML5 | Conteúdo, navegação e formulário com marcação semântica. |
| CSS3 | Layout responsivo, contraste e estados de foco. |
| JavaScript puro | Menu móvel e apoio à validação no navegador. |
| PHP 8+ | Servir a página, receber o formulário via POST, validar os campos e responder com o resultado da simulação. |
| Git e GitHub | Histórico local e repositório remoto do projeto. |

Organização proposta com `public/index.php` como entrada, `public/assets/css/styles.css` para estilos e `public/assets/js/main.js` para interações. A pasta `docs/` fica fora da raiz servida.

## 10. Funcionalidades front-end

- Menu compacto no celular, com botão identificado e estado aberto ou fechado disponível para tecnologias assistivas. Os links continuam acessíveis com JavaScript desativado.
- Links internos para as seções, foco visível e FAQ com elementos HTML nativos.
- Formulário com rótulos visíveis, tipos de campo adequados e indicação de obrigatoriedade. O HTML oferece validação básica e o JavaScript ajuda a apresentar mensagens claras.
- Confirmação de simulação após o PHP validar o envio. Em caso de erro, mostrar quais dados precisam de correção e preservar os valores válidos.

## Processamento demonstrativo

O PHP verifica o método, os campos obrigatórios, os limites de tamanho, o formato do telefone e se o serviço está entre as opções. Valores exibidos novamente na página passam por escape HTML. O formulário retorna uma confirmação de teste sem gravar dados em banco ou enviar mensagens. A página orienta o visitante a usar informações fictícias.

## Distribuição dos 60 minutos

| Etapa | Tempo de trabalho |
| --- | --- |
| Briefing | 8 min |
| Planejamento, SEO e checklist | 10 min |
| Estrutura, conteúdo e estilos responsivos | 20 min |
| Interatividade e formulário em PHP | 15 min |
| Testes e revisão | 7 min |

Os tempos são estimativas. Revisar cada entrega e aguardar a confirmação antes da etapa seguinte.
