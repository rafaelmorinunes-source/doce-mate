# Cadastro de produtos em massa

Cadastrar 100 produtos um a um pelo painel leva dias. Pela planilha leva uma
tarde.

O arquivo **`modelo-importacao-woocommerce.csv`** já vem com três exemplos
reais preenchidos — um vestido com tamanho e cor, um body de bebê e um kit de
saída de maternidade. Use-os como referência, apague e coloque os produtos da
Doce Mate.

---

## Como usar

1. Abra o CSV no **Excel** ou **Google Sheets**
2. Substitua os exemplos pelos produtos reais
3. Salve/exporte como **CSV (UTF-8)** — o encoding importa, senão acentos
   viram símbolos estranhos
4. No WordPress: **Produtos → Todos os produtos → Importar**
5. Suba o arquivo e confira o mapeamento de colunas (ele acerta sozinho quando
   os cabeçalhos estão iguais aos do modelo)
6. Rode a importação

> Importe primeiro **3 produtos de teste**. Confira se ficou tudo certo antes
> de subir o catálogo inteiro. Corrigir 3 produtos é rápido; corrigir 100 é
> uma tarde perdida.

---

## Produto variável — a regra mais importante

Uma peça com vários tamanhos é **um produto**, não vários.

No CSV isso vira:

- **1 linha `variable`** — o produto "pai", com foto, descrição, categoria e a
  lista de todos os tamanhos e cores **separados por vírgula**
- **1 linha `variation` para cada combinação** — com o próprio SKU, o próprio
  estoque e o próprio preço, apontando para o pai na coluna `Parent`

```
variable    DM-VEST-001         Tamanho: 2, 4, 6, 8    Cor: Rosa, Azul
  variation DM-VEST-001-2-RO    Tamanho: 2             Cor: Rosa    → 5 un.
  variation DM-VEST-001-4-RO    Tamanho: 4             Cor: Rosa    → 8 un.
  variation DM-VEST-001-2-AZ    Tamanho: 2             Cor: Azul    → 4 un.
  ...
```

> **O separador é vírgula, não barra vertical.** Muito tutorial na internet diz
> `2 | 4 | 6`, mas o importador do WooCommerce separa por vírgula — está no
> código, em `explode_values( $value, $separator = ',' )`. Com barra vertical
> ele cria **um único** tamanho chamado `2 | 4 | 6`, nenhuma variação casa com
> ele, e o seletor da página do produto aparece **vazio**.
>
> O campo inteiro precisa estar entre aspas: `"2, 4, 6, 8"`. Se algum valor
> tiver vírgula dentro, escape com barra invertida: `"Azul\, claro, Rosa"`.

A coluna `Parent` da variação recebe o **SKU do produto pai**.

Cadastrar cada tamanho como produto separado é o erro mais comum de loja nova
em moda — polui a vitrine, impede o controle de estoque por tamanho e é
trabalhoso demais para desfazer depois.

---

## As colunas

| Coluna | O que preencher |
|--------|-----------------|
| `Type` | `variable` (pai), `variation` (variação) ou `simple` (peça sem tamanho) |
| `SKU` | Código único. Sugestão: `DM-CATEGORIA-NUMERO` |
| `Name` | Tipo + característica + público. Nunca "Vestido 001" |
| `Published` | `1` para publicar, `0` para rascunho |
| `Is featured?` | `1` destaca na home. Use em 4 ou 5 peças, no máximo |
| `Visibility in catalog` | `visible` |
| `Short description` | 2–3 linhas ao lado do preço |
| `Description` | Descrição completa. Aceita HTML (`<p>`, `<ul>`, `<li>`, `<strong>`) |
| `In stock?` | `1` |
| `Stock` | Quantidade. Deixe vazio no pai variável — quem controla é a variação |
| `Regular price` | Preço normal, com ponto decimal: `89.90` |
| `Sale price` | Preço promocional. Vazio se não houver |
| `Categories` | Use `>` para hierarquia e `,` para múltiplas: `Menina > Vestido, Ocasioes > Passeio` |
| `Tags` | Palavras-chave separadas por vírgula |
| `Weight (kg)` | **Obrigatório.** Peso embalado: `0.25` |
| `Length/Width/Height (cm)` | **Obrigatórios.** Da embalagem, não da peça |
| `Images` | URLs separadas por vírgula. A primeira é a principal |
| `Parent` | Só nas variações: o SKU do produto pai |
| `Attribute 1 name` | `Tamanho` |
| `Attribute 1 value(s)` | No pai, entre aspas e separado por vírgula: `"2, 4, 6, 8"`. Na variação: só `4` |
| `Attribute 1 visible` | `1` |
| `Attribute 1 global` | `1` |
| `Attribute 2 ...` | Mesma lógica, para `Cor` |

---

## Peso e dimensões — não deixe vazio

Sem esses dados o frete é calculado errado, e a diferença sai do seu bolso em
todo pedido.

Valores de referência para vestuário infantil já embalado:

| Tipo de peça | Peso (kg) | C × L × A (cm) |
|--------------|-----------|----------------|
| Body / camiseta | 0.15 | 20 × 15 × 3 |
| Vestido | 0.25 | 25 × 20 × 4 |
| Conjunto | 0.35 | 30 × 22 × 5 |
| Casaco / moletom | 0.50 | 32 × 25 × 8 |
| Saída de maternidade | 0.60 | 35 × 28 × 10 |

Pese algumas peças reais numa balança de cozinha e ajuste.

---

## Imagens

A coluna `Images` aceita:

- **URL completa** de imagem já hospedada
- **Nome do arquivo** se a imagem já estiver na Biblioteca de Mídia do
  WordPress

O caminho mais prático: suba todas as fotos primeiro em **Mídia → Adicionar
nova**, depois use os nomes dos arquivos no CSV.

Antes de subir, comprima tudo em `tinypng.com` — foto acima de 200 KB deixa a
loja lenta no plano Premium.

---

## Erros comuns

| Sintoma | Causa |
|---------|-------|
| Acentos viraram `Ã§` e `Ã£` | Salvou em ANSI. Exporte como **CSV UTF-8** |
| Preço virou zero ou sumiu | Usou vírgula decimal. Use ponto: `89.90` |
| Variação não vinculou ao pai | `Parent` não bate com o SKU do pai, ou o pai não está na mesma importação |
| Seletor de tamanho aparece **vazio** | Os valores do pai foram separados por `\|` em vez de vírgula |
| Frete saiu errado | Peso ou dimensões em branco |
| Produto duplicou | Reimportou com SKU repetido sem marcar "atualizar existentes" |

---

## Sobre acentos no modelo

Os exemplos deste CSV estão **sem acentos de propósito**, para garantir que
abram corretamente em qualquer editor. Ao preencher com os produtos reais,
**use acentuação normal** — só lembre de exportar em UTF-8.
