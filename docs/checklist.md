# Checklist do MVP

Marcar cada item após conferir seu resultado. Executar os testes de contato com informações fictícias.

## Preparação

- [x] Registrar o briefing comercial e os critérios de aprovação.
- [x] Escrever o planejamento de conteúdo, conversão e tecnologia.
- [x] Definir os textos e as verificações de SEO.
- [x] Conferir a raiz do Git local e o endereço de `origin`.
- [x] Receber a aprovação do planejamento antes de implementar.

## Conteúdo e navegação

- [x] Conferir se o serviço principal e Curitiba aparecem na primeira tela.
- [x] Revisar os três serviços, os passos do orçamento e as perguntas frequentes.
- [x] Confirmar que a página identifica a empresa como fictícia perto dos canais de contato e no rodapé.
- [x] Conferir que a imagem foi gerada para o projeto e está identificada como ilustrativa.
- [x] Conferir a página em 320, 390, 768 e 1280 px e verificar a ausência de rolagem horizontal.
- [x] Usar apenas teclado para abrir o menu, navegar até Orçamento, preencher o formulário e chegar à confirmação. Observar a ordem da navegação e o foco visível.
- [x] Desativar o JavaScript e testar os atalhos de seção e o formulário.

## Ambiente local e orçamento

- [x] Executar `php -v` e confirmar PHP 8 ou superior. Versão usada nos testes: 8.3.6.
- [x] Verificar a sintaxe com `php -l public/index.php` e `node --check public/assets/js/main.js`.
- [x] Abrir a página no servidor PHP local. Para reproduzir, executar `php -S 127.0.0.1:8000 -t public` e abrir `http://127.0.0.1:8000`.
- [x] Clicar em “Solicitar orçamento pelo formulário” e verificar se o link leva à seção certa.
- [x] Enviar “Pessoa Exemplo”, `(41) 90000-0000` e “Instalação de split”. Conferir a confirmação da simulação.
- [x] Testar campos vazios e telefone inválido, inclusive com POST direto e com JavaScript desativado.
- [x] Acionar “Solicitar orçamento pelo WhatsApp” e conferir a prévia da mensagem e o aviso de demonstração.

## Revisão final

- [x] Conferir título, descrição, `lang="pt-BR"` e `noindex` no HTML.
- [x] Verificar no Chrome que CSS, JavaScript e imagem retornam HTTP 200 e que o teste não registrou exceções de JavaScript.
- [x] Revisar `git status --short` e conferir que apenas os arquivos do projeto entram no versionamento.

Em uma eventual publicação, confirmar que a hospedagem executa PHP e repetir os testes em HTTPS. A abertura de uma conversa no WhatsApp depende de um número de teste autorizado.
