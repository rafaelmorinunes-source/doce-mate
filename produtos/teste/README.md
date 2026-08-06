# Produtos de teste

Cinco peças fictícias que, juntas, exercitam todos os componentes da loja.
Servem para validar o site **antes** de existir foto e catálogo real.

> ⚠️ **Estas peças não existem e não podem ser vendidas.** Todas começam com
> `[TESTE]` no nome e estão na categoria `TESTE`. Apague antes do lançamento —
> instruções no fim deste arquivo.

---

## Por que estas cinco

Cada uma cobre um componente diferente. Juntas, não sobra parte da loja sem
teste.

| Peça | O que exercita |
|------|----------------|
| **01 — Vestido Floral** | Produto variável com **dois atributos** (tamanho × cor), preço diferente por tamanho, estoque por variação, **uma variação esgotada**, produto em destaque |
| **02 — Body Manga Longa** | Produto variável com **um atributo só**, **preço promocional** com etiqueta e preço antigo riscado |
| **03 — Saída de Maternidade** | Produto **simples**, valor **acima da faixa de frete grátis** (R$ 259,90), peso e volume maiores, produto em destaque |
| **04 — Camiseta** | Produto simples **barato**, para conferir o frete cobrado **abaixo** da faixa de gratuidade |
| **05 — Conjunto Moletom** | Produto **totalmente esgotado** |

Também cobrem três categorias diferentes (Bebê, Menina, Menino), o que permite
testar a seção "Escolha por idade" da home.

---

## Importar

1. **Produtos → Todos os produtos → Importar**
2. Enviar `produtos-de-teste.csv`
3. Conferir o mapeamento das colunas (acerta sozinho) e rodar

Não haverá foto — o WooCommerce mostra o próprio marcador de imagem ausente.
Isso é útil: você vê como fica um produto sem foto e entende por que foto não
é opcional.

> Se aparecer erro de codificação nos acentos, o arquivo foi reaberto e salvo
> em ANSI por algum editor. Reimporte a versão original do repositório.

---

## Roteiro de testes

Siga na ordem. Cada item tem o que esperar.

### Página inicial

- [ ] A seção **"Escolha por idade"** aparece, com Bebê, Menina e Menino
- [ ] Surgiu a seção **"Nossos destaques"**, com Vestido Floral e Saída de Maternidade
- [ ] Surgiu a seção **"Chegou agora"**, com as cinco peças
- [ ] As seções entraram **entre** as categorias e o bloco "Uma loja de família"

Se as seções não apareceram, o cache está servindo a home antiga — limpe em
**LiteSpeed Cache → Painel → Limpar tudo**.

### Vitrine (página Loja)

- [ ] Quatro produtos por linha no computador
- [ ] Preços com os dígitos alinhados entre os cards
- [ ] O Body mostra **etiqueta de promoção** e o preço antigo riscado
- [ ] O Conjunto Moletom aparece marcado como esgotado
- [ ] No celular, dois por linha e imagens sem distorção

### Página do produto — Vestido Floral

- [ ] Aparecem **dois seletores**: Tamanho e Cor
- [ ] O link **"Consultar o guia de tamanhos"** aparece acima do seletor
      *(só funciona se a página existir com o slug `guia-de-tamanhos`)*
- [ ] Escolher **tamanho 6** muda o preço para R$ 94,90
- [ ] Escolher **6 + Azul** mostra indisponível e **não** deixa comprar
- [ ] Escolher **2 + Rosa** mostra "em estoque" e libera o botão

### Página do produto — Conjunto Moletom

- [ ] Mostra esgotado
- [ ] **Não existe** botão de adicionar ao carrinho

### Carrinho

- [ ] Adicionar Camiseta e Body, conferir se o subtotal soma certo
- [ ] Alterar a quantidade e atualizar — o total acompanha
- [ ] Remover um item e conferir se o total recalcula

### Frete — a parte mais importante

Teste com três CEPs diferentes, com a **Camiseta (R$ 49,90)** no carrinho:

| CEP | O que deve aparecer |
|-----|---------------------|
| Um de **Porto Alegre** | **Retirada na loja (R$ 0)**, além de PAC e SEDEX |
| Um do **interior do RS** | PAC e SEDEX, **com valor cobrado** |
| Um de **outro estado** | PAC e SEDEX, mais caro que o do RS |

Depois, teste a faixa de frete grátis:

- [ ] Só a **Saída de Maternidade (R$ 259,90)** + CEP do RS → **frete grátis** no PAC
- [ ] Só a **Camiseta (R$ 49,90)** + CEP do RS → frete **cobrado**

Se o frete vier R$ 0 em tudo ou não calcular, o problema está no peso e nas
dimensões, ou no CEP de origem do Melhor Envio.

### Checkout — onde mora o risco

Este é o teste que mais importa, porque é o que decide se dá para emitir nota
fiscal.

- [ ] Aparece o seletor **Pessoa Física / Pessoa Jurídica**
- [ ] Aparece o campo **CPF**
- [ ] Aparece o campo **Bairro**
- [ ] Digitar o CEP **preenche rua, bairro e cidade sozinho**

Faltou algum? Você ainda está no **checkout em blocos**. Volte à
[seção 3.0 do documento 03](../../docs/03-pagamentos-frete-nota-fiscal.md) e
troque para o clássico.

- [ ] Escolher **Retirada na loja** faz os campos de endereço sumirem ou
      deixarem de ser obrigatórios

### Pagamento

Só depois que a conta PJ do Mercado Pago for aprovada:

- [ ] PIX aparece como opção e aplica o **desconto de 5%**
- [ ] Cartão oferece **parcelamento em até 3x**
- [ ] Boleto aparece

Use as **credenciais de teste** do Mercado Pago nesta etapa. Só faça a compra
com dinheiro de verdade depois, com os produtos reais.

### Visitante anônimo

- [ ] Abrir o site numa **aba anônima**, deslogado
- [ ] O modo **"Loja em breve"** deve aparecer, e **nenhuma peça de teste**
      deve estar visível

Se um produto `[TESTE]` aparecer para visitante, o modo de pré-lançamento foi
desligado. Religue em **WooCommerce → Configurações → Geral**.

### Celular

Repita, pelo celular de verdade e não só reduzindo a janela:

- [ ] Home, vitrine, página de produto, carrinho e checkout
- [ ] Os botões são grandes o suficiente para o dedo
- [ ] Nada estoura a largura da tela nem exige rolar para o lado

---

## Apagar antes do lançamento

**Produtos → Todos os produtos**, filtrar pela categoria **TESTE**,
marcar todos, **Ações em massa → Mover para a lixeira**, aplicar.

Depois esvazie a lixeira: abra a aba **Lixeira** e clique em
**Esvaziar lixeira**. Produto na lixeira ainda ocupa o SKU.

Por fim, apague a categoria **TESTE** em **Produtos → Categorias**.

### Confira que não sobrou nada

Busque por `TESTE` na busca de produtos do painel. O resultado tem que vir
vazio.

> Deixe essa limpeza no checklist de lançamento. Peça fictícia visível numa
> loja aberta destrói confiança mais rápido que qualquer outro erro — e é o
> tipo de coisa que passa despercebida justamente por já estar acostumado a
> vê-la.
