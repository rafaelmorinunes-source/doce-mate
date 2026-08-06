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

## Trocar as cores

Tudo sai de um bloco só, no topo de `docemate/style.css`:

```css
:root {
  --dm-brand:       #C86B7D;   /* cor principal */
  --dm-brand-dark:  #A85062;   /* hover */
  --dm-brand-soft:  #FBF0F2;   /* fundo suave */
  ...
}
```

Os valores atuais são **um ponto de partida, não a identidade da Doce Mate**.
Troque pelos tons reais da marca e o site inteiro acompanha: botões, links,
preços, rodapé.

Para pegar a cor exata de uma foto do Instagram: abra a imagem no Paint ou no
Preview e use o conta-gotas.

Depois de editar, rode `./tema/build.sh` de novo e reenvie.

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

PNG com fundo transparente, cerca de 400 px de largura. O tema limita a altura
em 76 px no computador e 56 px no celular, então um logo muito alto e estreito
fica pequeno — prefira um horizontal.

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
