# Tema Doce Mate

Tema filho do Storefront. Deixa a loja com a cara da marca sem tocar no tema
original — quando o Storefront atualizar, nada do que está aqui se perde.

## Instalar

```bash
./tema/build.sh
```

Gera `tema/docemate.zip`. No WordPress:

**Aparência → Temas → Adicionar novo → Enviar tema** → escolher o zip →
Instalar → **Ativar**.

O Storefront precisa continuar instalado. Ele é o tema pai: não ative ele,
não apague ele.

> O build lê `juridico/dados-da-loja.conf`. Se ainda faltar algum dado, ele
> avisa quais e para — o rodapé precisa do CNPJ e do endereço, que o Decreto
> 7.962/2013 exige em todas as páginas.

## A paleta

Derivada do logo, num bloco só no topo de `docemate/style.css`.

O logo tem três cores fortes — roxo, rosa e verde-limão. Usar as três em força
total na interface deixaria o site berrante e faria a loja competir com as
fotos das peças. Então a paleta **deriva** do logo em vez de copiá-lo:

| Papel | Cor | Vem de |
|-------|-----|--------|
| Ação (botões, links) | `#71539B` | roxo do logo, escurecido |
| Faixas e fundos | `#8C6BB0` | o roxo do logo |
| Etiqueta de promoção | `#B0417A` | rosa do "Doce", escurecido |
| Frete grátis, em estoque | `#5C7320` | verde do "Mate", escurecido |
| Acentos claros | `#EFA9CB`, `#C6DF74` | rosa e verde do logo |

### Por que o roxo foi escurecido

O roxo do logo (`#8C6BB0`) tem contraste **4,3:1** contra texto branco —
abaixo do mínimo de 4,5:1. Botão com texto ilegível não é questão de gosto:
some para quem tem baixa visão e é lido no celular sob sol. O tom usado nos
botões tem **6,1:1** e continua sendo claramente o roxo da marca.

Os cinzas de texto puxam levemente para o violeta, para parecerem escolhidos
em vez de genéricos.

### Ajustar

As cores foram tiradas do logo a olho. Para exatidão, abra o PNG, use o
conta-gotas e ajuste as três primeiras linhas do `:root`. Depois rode
`./tema/build.sh` de novo e reenvie.

## O que o tema faz

**Visual**
- Tipografia, botões, formulários e avisos com a cara da marca
- Vitrine em 4 colunas no computador (o padrão do Storefront é 3, e fica com
  cara de vazio)
- Etiqueta de promoção e preços legíveis, com dígitos alinhados entre os cards
- Cabeçalho limpo, com espaço para o logo
- Alvos de toque grandes no celular, de onde vem quase todo o tráfego do
  Instagram
- Foco visível no teclado e respeito a `prefers-reduced-motion`

**Funcional**
- Rodapé com razão social, CNPJ, endereço e contato — exigência legal
- Links automáticos para as quatro páginas jurídicas, quando existirem
- Link para o guia de tamanhos dentro da página do produto, logo acima do
  seletor de tamanho
- Remove o crédito "Built with Storefront & WooCommerce"

## Logo

**Aparência → Personalizar → Identidade do site → Logo**.

### Corte as margens antes de subir

O arquivo do logo é quadrado, com bastante área transparente em volta. Se
subir assim, o WordPress escala o quadrado inteiro — incluindo o vazio — e a
faixa roxa aparece minúscula no cabeçalho.

Corte deixando só o desenho: a faixa roxa, o bebê que passa por cima dela e os
pés que passam por baixo. Fica algo perto de **1120 × 590 px**, quase 2:1.
Qualquer editor de imagem faz isso; no Paint é "Selecionar → Recortar".

Salve como **PNG com fundo transparente**. O tema limita a altura em 96 px no
computador e 64 px no celular.

### Ícone do site (favicon)

Ainda em **Identidade do site**. Use a **cabeça do bebê recortada em
quadrado** — o rosto com o chapéu. É o elemento mais reconhecível do logo e o
único que ainda se lê a 32 px. A faixa com "Doce Mate" inteira vira um borrão
nesse tamanho.

## Slugs que o tema procura

O rodapé e o link do guia de tamanhos só aparecem se as páginas existirem com
estes endereços:

| Página | Slug |
|--------|------|
| Trocas e devoluções | `trocas-e-devolucoes` |
| Política de frete | `politica-de-frete` |
| Política de privacidade | `politica-de-privacidade` |
| Termos de uso | `termos-de-uso` |
| Guia de tamanhos | `guia-de-tamanhos` |

O slug é o final do endereço da página, editável logo abaixo do título ao criar
a página. Se você usar outro, ajuste em `docemate/functions.php`.

## Trocar a fonte

O tema usa a fonte do sistema: carrega instantâneo e não faz requisição
externa. Numa hospedagem compartilhada isso vale mais que fonte bonita e lenta
— e evita a discussão de LGPD que vem com carregar fonte de CDN de terceiro.

Se quiser uma fonte própria depois, o caminho é **hospedar no próprio site**,
não linkar de fora:

1. Baixe os arquivos `.woff2`
2. Coloque em `docemate/fontes/`
3. Declare com `@font-face` no topo do `style.css`
4. Troque o valor de `--dm-font`

## Não faça

- **Não edite o tema Storefront.** A próxima atualização apaga tudo. É
  exatamente para isso que existe o tema filho.
- **Não edite `dados-loja.php`.** Ele é gerado. Edite o `.conf` e rode o build.
- **Não apague o bloco legal do rodapé.** É exigência do Decreto 7.962/2013.
